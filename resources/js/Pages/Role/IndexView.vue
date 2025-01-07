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
import { Head, Link, useForm } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";
import { ref } from "vue";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

const settingStore = useSettingStore();
const { perPage } = storeToRefs(settingStore);
const props = defineProps({
    result: Object,
    query: Object,
});

const toastStore = useToastStore();
const createModalShow = ref(false);
const updateModalShow = ref(false);
const updateRoleID = ref(null);
const orderBy = ref({});

const form = useForm({
    role_name: props.query.role_name ?? null,
    status: props.query.status ?? null,
    per_page: perPage.value,
    page: 1,
    order_by: props.query.order_by ?? {},
});

orderBy.value = props.query.order_by ?? {};

const createForm = useForm({
    role_name: null,
    description: null,
});

const updateForm = useForm({
    role_name: null,
    description: null,
    status: null,
});

const statusOptions = ref([
    { label: "All", value: null },
    { label: "Active", value: "active" },
    { label: "Inactive", value: "inactive" },
]);

const createModal = () => {
    createModalShow.value = true;
};

const updateModal = (data) => {
    updateRoleID.value = data.id;
    updateForm.role_name = data.role_name;
    updateForm.description = data.description;
    updateForm.status = data.status;
    updateModalShow.value = true;
};

const colorStatus = ref({
    active: "bg-black text-white",
    inactive: "bg-gray-500 text-white",
});

const nav = ref([
    {
        label: "Role Settings",
        href: null,
    },
]);

const searchPage = (page) => {
    form.page = page;
    form.per_page = perPage.value;
    form.order_by = orderBy.value;
    form.get(route("roles"), {
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
    searchPage(1);
};

const search = () => {
    form.page = page;
    form.per_page = perPage.value;
    form.order_by = orderBy.value;
    form.get(route("roles"), {
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

const create = () => {
    createForm.post(route("roles.create"), {
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
                title: "Role has been successfully created.",
            });
            createModalShow.value = false;
            createForm.role_name = null;
            createForm.description = null;
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
                updateForm.category_name = null;
                updateForm.collection = null;
                updateForm.status = null;
            },
        }
    );
};

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};
</script>

<template>
    <Modal
        title="Create Role"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div :class="createForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="roleName"
                        value="Role Name"
                        :required="true"
                    />
                    <TextInput
                        id="roleName"
                        type="text"
                        v-model="createForm.role_name"
                        placeholder="Enter role name"
                    />
                    <InputError :message="createForm.errors.role_name" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="description"
                        value="Description"
                        :required="true"
                    />
                    <textarea
                        class="w-full mt-1 bg-gray-100 dark:bg-slate-700 dark:text-white border-none px-4 py-2 text-xs rounded-2xl"
                        id="description"
                        type="text"
                        v-model="createForm.description"
                        placeholder="Enter product description"
                        rows="3"
                    ></textarea>
                    <InputError :message="createForm.errors.description" />
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
        title="Update Role"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div :class="updateForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="roleName"
                        value="Role Name"
                        :required="true"
                    />
                    <TextInput
                        id="roleName"
                        type="text"
                        v-model="updateForm.role_name"
                        placeholder="Enter role name"
                    />
                    <InputError :message="updateForm.errors.role_name" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="description"
                        value="Description"
                        :required="true"
                    />
                    <textarea
                        class="w-full mt-1 bg-gray-100 dark:bg-slate-700 dark:text-white border-none px-4 py-2 text-xs rounded-2xl"
                        id="description"
                        type="text"
                        v-model="updateForm.description"
                        placeholder="Enter product description"
                        rows="3"
                    ></textarea>
                    <InputError :message="updateForm.errors.description" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="status"
                        value="Status"
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
                    />
                    <InputError :message="updateForm.errors.status" />
                </div>
            </div>
            <div class="modal-footer flex flex-wrap gap-x-2">
                <SecondaryButton @click="updateModalShow = false">
                    CANCEL
                </SecondaryButton>
                <PrimaryButton @click="update">SAVE</PrimaryButton>
            </div>
        </div>
    </Modal>
    <Head title="Role Settings" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                ROLE SETTINGS
            </h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="roleName"
                        value="Role Name"
                    />
                    <TextInput
                        id="roleName"
                        type="text"
                        v-model="form.role_name"
                        placeholder="Enter role name"
                    />
                </div>
                <div>
                    <InputLabel
                        for="status"
                        value="Status"
                    />
                    <v-select
                        id="status"
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.status"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="statusOptions"
                    />
                </div>
            </div>
            <div class="filter-action mb-5 flex flex-wrap items-center gap-x-2">
                <PrimaryButton @click="search">
                    SEARCH
                    <Icon
                        icon="iconoir:search"
                        class="ml-2"
                    />
                </PrimaryButton>
                <SecondaryButton @click="form.reset()">
                    RESET
                    <Icon
                        icon="system-uicons:reset"
                        class="ml-2"
                    />
                </SecondaryButton>
                <SecondaryButton @click="createModal">
                    CREATE ROLE
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
                @change="searchPage"
                @order-by="updateOrderBy"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="role_name">Role Name</ColumnHeader>
                    <ColumnHeader sortKey="description">
                        Description
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="slug"
                    >
                        Slug
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
                <Row v-slot="{ row, index }">
                    <RowColumn>
                        {{
                            10 * (result.pagination.current_page - 1) +
                            index +
                            1
                        }}
                    </RowColumn>
                    <RowColumn>{{ row.role_name }}</RowColumn>
                    <RowColumn>{{ row.description }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.slug }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <span
                            :class="[
                                colorStatus[row.status],
                                'text-xs rounded-2xl py-1 px-2',
                            ]"
                        >
                            {{ capitalizeFirstLetter(row.status) }}
                        </span>
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <div class="flex justify-center gap-x-4">
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
                            <Link
                                :href="
                                    route('permissions.update', {
                                        role: row.id,
                                    })
                                "
                                class="border-none bg-none"
                            >
                                <Icon
                                    icon="hugeicons:access"
                                    class="text-xs"
                                />
                            </Link>
                        </div>
                    </RowColumn>
                </Row>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.accordion-header {
    @apply w-full text-left px-4 py-2 border-b border-gray-200;
}
.accordion-content {
    @apply px-4 py-2 bg-gray-100;
}
.accordion-transition-enter-active,
.accordion-transition-leave-active {
    transition:
        opacity 0.5s ease,
        max-height 0.5s ease;
}
.accordion-transition-enter, .accordion-transition-leave-to /* .accordion-transition-leave-active in <2.1.8 */ {
    opacity: 0;
    max-height: 0;
}
</style>
