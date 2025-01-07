<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import ColumnHeader from "@/Components/Table/ColumnHeader.vue";
import Row from "@/Components/Table/Row.vue";
import RowColumn from "@/Components/Table/RowColumn.vue";
import Table from "@/Components/Table/Table.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    customer_name: null,
    email_address: null,
    status: null,
});

const updateForm = useForm({
    status: "active",
});

const bannedModalShow = ref(false);
const updateModalShow = ref(false);

const customers = ref([
    {
        customer_id: 1,
        name: "Alice Johnson",
        contact_number: "+1-555-123-4567",
        email_address: "alice.johnson@example.com",
        registration_date: "2024-01-15 08:30",
        last_login: "2024-08-15 10:45",
        status: "active",
    },
    {
        customer_id: 2,
        name: "Bob Smith",
        contact_number: "+1-555-234-5678",
        email_address: "bob.smith@example.com",
        registration_date: "2023-11-22 09:15",
        last_login: "2024-08-10 14:30",
        status: "deactivated",
    },
    {
        customer_id: 3,
        name: "Carol Williams",
        contact_number: "+1-555-345-6789",
        email_address: "carol.williams@example.com",
        registration_date: "2024-03-02 10:00",
        last_login: "2024-08-14 11:20",
        status: "inactive",
    },
    {
        customer_id: 4,
        name: "David Brown",
        contact_number: "+1-555-456-7890",
        email_address: "david.brown@example.com",
        registration_date: "2024-02-18 07:45",
        last_login: "2024-08-12 09:50",
        status: "active",
    },
    {
        customer_id: 5,
        name: "Emma Davis",
        contact_number: "+1-555-567-8901",
        email_address: "emma.davis@example.com",
        registration_date: "2023-12-01 13:30",
        last_login: "2024-08-16 16:00",
        status: "active",
    },
    {
        customer_id: 6,
        name: "Frank Miller",
        contact_number: "+1-555-678-9012",
        email_address: "frank.miller@example.com",
        registration_date: "2024-04-05 08:00",
        last_login: "2024-08-09 18:25",
        status: "banned",
    },
    {
        customer_id: 7,
        name: "Grace Wilson",
        contact_number: "+1-555-789-0123",
        email_address: "grace.wilson@example.com",
        registration_date: "2024-01-10 09:00",
        last_login: "2024-08-07 12:30",
        status: "inactive",
    },
    {
        customer_id: 8,
        name: "Henry Moore",
        contact_number: "+1-555-890-1234",
        email_address: "henry.moore@example.com",
        registration_date: "2024-05-20 15:00",
        last_login: "2024-08-12 10:00",
        status: "deactivated",
    },
    {
        customer_id: 9,
        name: "Ivy Taylor",
        contact_number: "+1-555-901-2345",
        email_address: "ivy.taylor@example.com",
        registration_date: "2023-10-25 16:30",
        last_login: "2024-08-11 08:45",
        status: "active",
    },
    {
        customer_id: 10,
        name: "Jack Anderson",
        contact_number: "+1-555-012-3456",
        email_address: "jack.anderson@example.com",
        registration_date: "2024-06-30 17:15",
        last_login: "2024-08-1 13:00",
        status: "deactivated",
    },
]);
const pagination = ref({
    total: 70,
    count: 10,
    per_page: 10,
    current_page: 1,
    total_pages: 7,
});

const statusOptions = ref([
    { label: "All", value: null },
    { label: "Active", value: "active" },
    { label: "Banned", value: "banned" },
    { label: "Inactive", value: "inactive" },
    { label: "Deactivated", value: "deactivated" },
]);

const updateStatusOptions = ref([
    { label: "Active", value: "active" },
    { label: "Banned", value: "banned" },
    { label: "Inactive", value: "inactive" },
    { label: "Deactivated", value: "deactivated" },
]);

const bannedModal = () => {
    bannedModalShow.value = true;
};

const updateModal = () => {
    updateModalShow.value = true;
};

const colorStatus = ref({
    active: "bg-black text-white",
    banned: "bg-red-500 text-white",
    inactive: "bg-gray-200 text-black",
    deactivated: "bg-gray-500 text-white",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const nav = ref([
    {
        label: "Customers",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Confirmation"
        maxWidth="lg"
        :show="bannedModalShow"
        @close="bannedModalShow = false"
    >
        <div class="modal-body mb-5">
            <p class="text-sm dark:text-white">
                Are you sure you want to ban this customer?
            </p>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <button
                class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="bannedModalShow = false"
            >
                NO
            </button>
            <button
                class="bg-black dark:bg-custom-blue text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="bannedModalShow = false"
            >
                YES
            </button>
        </div>
    </Modal>
    <Modal
        title="Update Status"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div class="modal-body mb-5">
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
                    :options="updateStatusOptions"
                />
            </div>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <button
                class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="updateModalShow = false"
            >
                CANCEL
            </button>
            <button
                class="bg-black dark:bg-custom-blue text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="updateModalShow = false"
            >
                SAVE
            </button>
        </div>
    </Modal>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">CUSTOMERS</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="customerName"
                        value="Customer Name"
                    />
                    <TextInput
                        id="customerName"
                        type="text"
                        v-model="form.customer_name"
                        placeholder="Enter customer name"
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
                <button
                    class="bg-black dark:bg-custom-blue text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                >
                    SEARCH
                    <Icon
                        icon="iconoir:search"
                        class="ml-2"
                    />
                </button>
                <button
                    class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-between"
                >
                    EXPORT
                    <Icon
                        icon="solar:export-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="customers"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>ID</ColumnHeader>
                    <ColumnHeader sortKey="name">Customer Name</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="email_address"
                    >
                        Email Address
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="contact_number"
                    >
                        Contact Number
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="registration_date"
                    >
                        Registration Date
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="last_login"
                    >
                        Last Login
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
                    <RowColumn>{{ row.customer_id }}</RowColumn>
                    <RowColumn>{{ row.name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.email_address }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.contact_number }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.registration_date }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.last_login }}
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
                                @click="updateModal"
                            >
                                <Icon
                                    icon="mynaui:edit-one"
                                    class="text-xs"
                                />
                            </button>
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="bannedModal"
                            >
                                <Icon
                                    icon="ion:ban-outline"
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
