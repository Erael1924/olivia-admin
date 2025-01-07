<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ColumnHeader from "@/Components/Table/ColumnHeader.vue";
import Row from "@/Components/Table/Row.vue";
import RowColumn from "@/Components/Table/RowColumn.vue";
import Table from "@/Components/Table/Table.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { useSettingStore } from "@/Stores/settings";
import { useToastStore } from "@/Stores/toast";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";
import { ref } from "vue";

const props = defineProps({
    result: Object,
    collection: Object,
    query: Array,
});

const settingStore = useSettingStore();
const { perPage } = storeToRefs(settingStore);
const toastStore = useToastStore();
const updateTagID = ref(null);
const createModalShow = ref(false);
const updateModalShow = ref(false);
const orderBy = ref({});
orderBy.value = props.query.order_by ?? {};

const form = useForm({
    tag_name: props.query.category_name ?? null,
    per_page: perPage.value,
    page: 1,
    order_by: props.query.order_by ?? {},
});

const createForm = useForm({
    tag_name: null,
    status: "active",
});

const updateForm = useForm({
    tag_name: null,
    status: null,
});

const search = (page = 1) => {
    form.page = page;
    form.per_page = perPage.value;
    form.order_by = orderBy.value;
    form.get(route("products.tags"), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "An error occured. Please try again.",
            });
        },
    });
};

const updateOrderBy = (order_by) => {
    orderBy.value = order_by;
    search(1);
};

const reset = () => {
    form.tag_name = null;
    search(1);
};

const create = () => {
    createForm.post(route("products.tags.create"), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            createModalShow.value = false;
            toastStore.addToast({
                type: "success",
                title: "Tag has been successfully created",
            });
            createForm.tag_name = null;
        },
    });
};

const update = () => {
    updateForm.put(route("products.tags.update", { id: updateTagID.value }), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            toastStore.addToast({
                type: "success",
                title: "Tag has been successfully updated.",
            });
            updateModalShow.value = false;
            updateForm.tag_name = null;
        },
    });
};

const statusOptions = [
    { label: "Active", value: "active" },
    { label: "Inactive", value: "inactive" },
];

const createModal = () => {
    createModalShow.value = true;
};

const updateModal = (data) => {
    updateTagID.value = data.id;
    updateForm.tag_name = data.name;
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Tag",
        href: null,
    },
]);

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};
</script>

<template>
    <Modal
        title="Create Tag"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div :class="createForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="tags"
                        value="Tag"
                        :required="true"
                    />
                    <TextInput
                        id="tags"
                        type="text"
                        v-model="createForm.tag_name"
                        placeholder="Enter tag name"
                    />
                    <InputError :message="createForm.errors.tag_name" />
                </div>
            </div>
            <div class="modal-footer flex flex-wrap gap-x-2">
                <SecondaryButton
                    @click="(createModalShow = false), createForm.reset()"
                >
                    CANCEL
                </SecondaryButton>
                <PrimaryButton @click="create">SAVE</PrimaryButton>
            </div>
        </div>
    </Modal>
    <Modal
        title="Update Tag"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div :class="updateForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="tags"
                        value="Tag"
                        :required="true"
                    />
                    <TextInput
                        id="tags"
                        type="text"
                        v-model="updateForm.tag_name"
                        placeholder="Enter tag name"
                    />
                    <InputError :message="updateForm.errors.tag_name" />
                </div>
            </div>
            <div class="modal-footer flex flex-wrap gap-x-2">
                <SecondaryButton
                    @click="(updateModalShow = false), updateForm.reset()"
                >
                    CANCEL
                </SecondaryButton>
                <PrimaryButton @click="update">SAVE</PrimaryButton>
            </div>
        </div>
    </Modal>
    <Head title="Tag" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">TAG</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="tagName"
                        value="Tag Name"
                    />
                    <TextInput
                        id="tagName"
                        type="text"
                        v-model="form.tag_name"
                        placeholder="Enter tag"
                    />
                </div>
            </div>
            <div
                class="filter-action mb-10 flex flex-wrap items-center gap-x-2"
            >
                <PrimaryButton @click="search">
                    SEARCH
                    <Icon
                        icon="iconoir:search"
                        class="ml-2"
                    />
                </PrimaryButton>
                <SecondaryButton @click="reset">
                    RESET
                    <Icon
                        icon="system-uicons:reset"
                        class="ml-2"
                    />
                </SecondaryButton>
                <SecondaryButton @click="createModal">
                    CREATE TAG
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </SecondaryButton>
            </div>
            <Table
                :data="result.data"
                :pagination="result.pagination"
                :orderBy="orderBy"
                @change="search"
                @order-by="updateOrderBy"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="name">Tag Name</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="created_at"
                    >
                        Date Created
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row }">
                    <RowColumn>{{ row.id }}</RowColumn>
                    <RowColumn>{{ row.name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.created_at }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <button
                            type="button"
                            class="border-none bg-none"
                            @click="updateModal(row)"
                        >
                            <Icon
                                icon="mynaui:edit-one"
                                class="text-xs"
                            />
                        </button>
                    </RowColumn>
                </Row>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>
