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
const createModalShow = ref(false);
const updateModalShow = ref(false);
const updateCategoryID = ref(null);
const orderBy = ref({});
orderBy.value = props.query.order_by ?? {};

const statusOptions = [
    { label: "All", value: null },
    { label: "Active", value: "active" },
    { label: "Inactive", value: "inactive" },
];

const collectionOptions = ref([{ label: "All", value: null }]);
collectionOptions.value = [
    ...collectionOptions.value,
    ...props.collection.map((item) => ({
        value: item["id"],
        label: item["name"],
    })),
];

const form = useForm({
    collection: props.query.collection
        ? parseInt(props.query.collection)
        : null,
    category_name: props.query.category_name,
    status: props.query.status ?? null,
    per_page: perPage.value,
    page: 1,
    order_by: props.query.order_by ?? {},
});

const createForm = useForm({
    category_name: null,
    collection: [],
    status: null,
});

const updateForm = useForm({
    category_name: null,
    collection: null,
    status: null,
});

const search = (page = 1) => {
    form.page = page;
    form.per_page = perPage.value;
    form.order_by = orderBy.value;
    form.get(route("products.category"), {
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
    form.collection = null;
    form.category_name = null;
    form.status = null;
    search(1);
};

const create = () => {
    createForm.post(route("products.category.create"), {
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
                title: "Category has been successfully created",
            });
            createForm.collection = null;
            createForm.category_name = null;
            createForm.status = null;
        },
    });
};

const update = () => {
    updateForm.put(
        route("products.category.update", { id: updateCategoryID.value }),
        {
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
                    title: "Category has been successfully updated.",
                });
                updateModalShow.value = false;
                updateForm.collection = null;
                updateForm.category_name = null;
                updateForm.status = null;
            },
        }
    );
};

const createModal = () => {
    createModalShow.value = true;
};

const updateModal = (data) => {
    updateCategoryID.value = data.id;
    updateForm.collection = data.collections.map((collection) => collection.id);
    updateForm.category_name = data.name;
    updateForm.status = data.status;
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Category",
        href: null,
    },
]);

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const concatenatedNames = (collections) => {
    return collections.map((collection) => collection.name).join(", ");
};
</script>

<template>
    <Modal
        title="Create Category"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div :class="createForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="category"
                        value="Category"
                        :required="true"
                    />
                    <TextInput
                        id="category"
                        type="text"
                        v-model="createForm.category_name"
                        placeholder="Enter category name"
                    />
                    <InputError :message="createForm.errors.category_name" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="collection"
                        value="Collection"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="createForm.collection"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            collectionOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                        multiple
                    />
                    <InputError :message="createForm.errors.collection" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="status"
                        value="Status"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="createForm.status"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            statusOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                        id="status"
                    />
                    <InputError :message="createForm.errors.status" />
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
        title="Update Category"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div :class="updateForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="categoryName"
                        value="Category Name"
                        :required="true"
                    />
                    <TextInput
                        id="categoryName"
                        type="text"
                        v-model="updateForm.category_name"
                        placeholder="Enter category name"
                    />
                    <InputError :message="updateForm.errors.category_name" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="collection"
                        value="Collection"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="updateForm.collection"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            collectionOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                        multiple
                    />
                    <InputError :message="updateForm.errors.collection" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="status"
                        value="Status"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="updateForm.status"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            statusOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                        id="status"
                    />
                    <InputError :message="updateForm.errors.status" />
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
    <Head title="Category" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">CATEGORY</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="categoryName"
                        value="Category Name"
                    />
                    <TextInput
                        id="categoryName"
                        type="text"
                        v-model="form.category_name"
                        placeholder="Enter category name"
                    />
                </div>
                <div>
                    <InputLabel
                        for="collection"
                        value="Collection"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.collection"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="collectionOptions"
                    />
                </div>
                <div>
                    <InputLabel
                        for="status"
                        value="Status"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.status"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="statusOptions"
                        id="status"
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
                <SecondaryButton @click="reset">
                    EXPORT
                    <Icon
                        icon="solar:export-linear"
                        class="ml-2"
                    />
                </SecondaryButton>
                <SecondaryButton @click="createModal">
                    CREATE CATEGORY
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
                    <ColumnHeader sortKey="name">Category</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="slug"
                    >
                        Slug
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Collection
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="created_at"
                    >
                        Date Created
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="status"
                    >
                        Status
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row }">
                    <RowColumn>{{ row.id }}</RowColumn>
                    <RowColumn>{{ row.name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.slug }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{
                            row.collections.length > 0
                                ? concatenatedNames(row.collections)
                                : "--"
                        }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.created_at }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <span
                            :class="[
                                row.status == 'active'
                                    ? 'bg-black dark:bg-slate-800 text-white'
                                    : 'bg-gray-500 text-white',
                                'text-xs rounded-2xl py-1 px-2',
                            ]"
                        >
                            {{ capitalizeFirstLetter(row.status) }}
                        </span>
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
