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
    roles: Object,
    query: Object,
    user: Array,
});

const settingStore = useSettingStore();
const { perPage } = storeToRefs(settingStore);
const toastStore = useToastStore();
const createModalShow = ref(false);
const resetModalShow = ref(false);
const updateModalShow = ref(false);
const credentialModalShow = ref(false);
const resetPasswordModalShow = ref(false);
const updateUserID = ref(null);
const orderBy = ref({});
orderBy.value = props.query.order_by ?? {};

const form = useForm({
    username: null,
    full_name: null,
    email_address: null,
    role: null,
    status: null,
    per_page: perPage.value,
    page: 1,
    order_by: props.query.order_by ?? {},
});

const createForm = useForm({
    username: null,
    full_name: null,
    email_address: null,
    role: null,
});

const updateForm = useForm({
    username: null,
    full_name: null,
    email_address: null,
    role: null,
    status: null,
});

const resetForm = useForm({});

const statusOptions = ref([
    { label: "All", value: null },
    { label: "Active", value: "active" },
    { label: "Deactivated", value: "deactivated" },
]);

const roleOptions = ref([{ label: "All", value: null }]);

roleOptions.value = [
    ...roleOptions.value,
    ...props.roles.map((item) => ({
        value: item["id"],
        label: item["role_name"],
    })),
];

const search = (page = 1) => {
    form.page = page;
    form.per_page = perPage.value;
    form.order_by = orderBy.value;
    form.get(route("users"), {
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

const reset = () => {
    form.username = null;
    form.full_name = null;
    form.email_address = null;
    form.role = null;
    form.status = null;
    search(1);
};

const create = () => {
    createForm.post(route("users.create"), {
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
            credentialModalShow.value = true;
            createForm.username = null;
            createForm.full_name = null;
            createForm.email_address = null;
            createForm.role = null;
        },
    });
};

const update = () => {
    updateForm.put(route("users.update", { id: updateUserID.value }), {
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
                title: "User information has been successfully updated.",
            });
            updateModalShow.value = false;
            updateForm.username = null;
            updateForm.full_name = null;
            updateForm.email_address = null;
            updateForm.role = null;
            updateForm.status = null;
        },
    });
};

const resetPassword = () => {
    resetForm.put(route("users.reset", { id: updateUserID.value }), {
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
            resetModalShow.value = false;
            resetPasswordModalShow.value = true;
        },
    });
};

const updateOrderBy = (order_by) => {
    orderBy.value = order_by;
    search(1);
};

const createModal = () => {
    createModalShow.value = true;
};

const resetModal = (id) => {
    updateUserID.value = id;
    resetModalShow.value = true;
};

const updateModal = (data) => {
    updateUserID.value = data.id;
    updateForm.username = data.username;
    updateForm.full_name = data.full_name;
    updateForm.email_address = data.email_address;
    updateForm.role = data.role_id;
    updateForm.status = data.status;
    updateModalShow.value = true;
};

const colorStatus = ref({
    deactivated: "bg-gray-500 text-white",
    active: "bg-black text-white dark:bg-slate-800",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const nav = ref([
    {
        label: "Users",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Create User"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div :class="createForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="username"
                        value="Username"
                        :required="true"
                    />
                    <TextInput
                        id="username"
                        type="text"
                        v-model="createForm.username"
                        placeholder="Enter username"
                    />
                    <InputError :message="createForm.errors.username" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="fullname"
                        value="Full Name"
                        :required="true"
                    />
                    <TextInput
                        id="fullname"
                        type="text"
                        v-model="createForm.full_name"
                        placeholder="Enter full name"
                    />
                    <InputError :message="createForm.errors.full_name" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="emailAddress"
                        value="Email Address"
                        :required="true"
                    />
                    <TextInput
                        id="emailAddress"
                        type="text"
                        v-model="createForm.email_address"
                        placeholder="Enter email address"
                    />
                    <InputError :message="createForm.errors.email_address" />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="role"
                        value="Role"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="createForm.role"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            roleOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                    />
                    <InputError :message="createForm.errors.role" />
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
        title="Success"
        maxWidth="lg"
        :show="credentialModalShow"
        @close="credentialModalShow = false"
    >
        <div class="modal-body mb-5">
            <p class="text-sm dark:text-white mb-3 font-semibold">
                User account has been successfully created. Here are the
                credentials:
            </p>
            <div class="mb-3">
                <InputLabel
                    for="username"
                    value="Username"
                />
                <TextInput
                    id="username"
                    type="text"
                    v-model="props.user.username"
                    readonly
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="password"
                    value="Password"
                />
                <TextInput
                    id="password"
                    type="text"
                    v-model="props.user.password"
                    readonly
                />
            </div>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <SecondaryButton @click="credentialModalShow = false">
                CLOSE
            </SecondaryButton>
        </div>
    </Modal>
    <Modal
        title="Success"
        maxWidth="lg"
        :show="resetPasswordModalShow"
        @close="resetPasswordModalShow = false"
    >
        <div class="modal-body mb-5">
            <p class="text-sm dark:text-white mb-3 font-semibold">
                User password has been successfully reset. Here is the new
                password:
            </p>
            <div class="mb-3">
                <InputLabel
                    for="password"
                    value="Password"
                />
                <TextInput
                    id="password"
                    type="text"
                    v-model="props.user.password"
                    readonly
                />
            </div>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <SecondaryButton @click="resetPasswordModalShow = false">
                CLOSE
            </SecondaryButton>
        </div>
    </Modal>
    <Modal
        title="Confirmation"
        maxWidth="lg"
        :show="resetModalShow"
        @close="resetModalShow = false"
    >
        <div class="modal-body mb-5">
            <p class="text-sm dark:text-white">
                Are you sure you want to reset user's password?
            </p>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <button
                class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="resetModalShow = false"
            >
                NO
            </button>
            <button
                class="bg-black dark:bg-slate-900 text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="resetPassword"
            >
                YES
            </button>
        </div>
    </Modal>
    <Modal
        title="Update User"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div :class="updateForm.processing ? 'opacity-50' : ''">
            <div class="modal-body mb-5">
                <div class="mb-3">
                    <InputLabel
                        for="username"
                        value="Username"
                        :required="true"
                    />
                    <TextInput
                        id="username"
                        type="text"
                        v-model="updateForm.username"
                        placeholder="Enter username"
                    />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="fullname"
                        value="Full Name"
                        :required="true"
                    />
                    <TextInput
                        id="fullname"
                        type="text"
                        v-model="updateForm.full_name"
                        placeholder="Enter full name"
                    />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="emailAddress"
                        value="Email Address"
                        :required="true"
                    />
                    <TextInput
                        id="emailAddress"
                        type="text"
                        v-model="updateForm.email_address"
                        placeholder="Enter email address"
                    />
                </div>
                <div class="mb-3">
                    <InputLabel
                        for="role"
                        value="Role"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="updateForm.role"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            roleOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                    />
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
                    />
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
    <Head title="Users" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">USERS</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="username"
                        value="Username"
                    />
                    <TextInput
                        id="username"
                        type="text"
                        v-model="form.username"
                        placeholder="Enter username"
                    />
                </div>
                <div>
                    <InputLabel
                        for="fullname"
                        value="Full Name"
                    />
                    <TextInput
                        id="fullname"
                        type="text"
                        v-model="form.full_name"
                        placeholder="Enter full name"
                    />
                </div>
                <div>
                    <InputLabel
                        for="emailAddress"
                        value="Email Address"
                    />
                    <TextInput
                        id="emailAddress"
                        type="text"
                        v-model="form.email_address"
                        placeholder="Enter email address"
                    />
                </div>
                <div>
                    <InputLabel
                        for="role"
                        value="Role"
                    />
                    <v-select
                        id="role"
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.role"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="roleOptions"
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
                    CREATE USER
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
                    <ColumnHeader sortKey="username">Username</ColumnHeader>
                    <ColumnHeader sortKey="full_name">Full Name</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="email_address"
                    >
                        Email Address
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="role_name"
                    >
                        Role
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="status"
                    >
                        Status
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="created_at"
                    >
                        Date Created
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="last_login_at"
                    >
                        Last Login
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
                    <RowColumn>{{ row.username }}</RowColumn>
                    <RowColumn>{{ row.full_name }}</RowColumn>
                    <RowColumn>{{ row.email_address }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.role }}
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
                        {{ row.created_at }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.last_login_at ?? "--" }}
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
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="resetModal(row.id)"
                            >
                                <Icon
                                    icon="fluent:key-reset-24-regular"
                                    class="text-xs"
                                />
                            </button>
                        </div>
                    </RowColumn>
                </Row>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>
