<script setup>
import InputLabel from "@/Components/InputLabel.vue";
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

const customers = ref([
    {
        customer_id: "1",
        customer_name: "Alice Johnson",
        email_address: "alice.johnson@example.com",
        total_orders: 15,
        total_spend: 850.75,
        last_order_date: "2024-08-15",
        account_status: "active",
    },
    {
        customer_id: "2",
        customer_name: "Bob Smith",
        email_address: "bob.smith@example.com",
        total_orders: 22,
        total_spend: 1230.6,
        last_order_date: "2024-08-12",
        account_status: "active",
    },
    {
        customer_id: "3",
        customer_name: "Carla Davis",
        email_address: "carla.davis@example.com",
        total_orders: 8,
        total_spend: 410.4,
        last_order_date: "2024-08-10",
        account_status: "inactive",
    },
    {
        customer_id: "4",
        customer_name: "David Wilson",
        email_address: "david.wilson@example.com",
        total_orders: 30,
        total_spend: 2200.95,
        last_order_date: "2024-08-09",
        account_status: "active",
    },
    {
        customer_id: "5",
        customer_name: "Emily Clark",
        email_address: "emily.clark@example.com",
        total_orders: 12,
        total_spend: 760.25,
        last_order_date: "2024-08-07",
        account_status: "active",
    },
    {
        customer_id: "6",
        customer_name: "Franklin Wright",
        email_address: "franklin.wright@example.com",
        total_orders: 5,
        total_spend: 275.85,
        last_order_date: "2024-08-05",
        account_status: "inactive",
    },
    {
        customer_id: "7",
        customer_name: "Grace Miller",
        email_address: "grace.miller@example.com",
        total_orders: 18,
        total_spend: 940.15,
        last_order_date: "2024-08-03",
        account_status: "active",
    },
    {
        customer_id: "8",
        customer_name: "Henry Lewis",
        email_address: "henry.lewis@example.com",
        total_orders: 9,
        total_spend: 500.0,
        last_order_date: "2024-08-01",
        account_status: "active",
    },
    {
        customer_id: "9",
        customer_name: "Isabella Martinez",
        email_address: "isabella.martinez@example.com",
        total_orders: 20,
        total_spend: 1100.5,
        last_order_date: "2024-08-15",
        account_status: "active",
    },
    {
        customer_id: "10",
        customer_name: "John Lee",
        email_address: "john.lee@example.com",
        total_orders: 7,
        total_spend: 350.75,
        last_order_date: "2024-08-13",
        account_status: "inactive",
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
        label: "Customer Insights",
        href: null,
    },
]);
</script>

<template>
    <Head title="Customers" />
    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                CUSTOMER INSIGHTS
            </h1>
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
                        sortKey="email_adress"
                    >
                        Email Address
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="total_orders"
                    >
                        Total Orders
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="total_spend"
                    >
                        Total Spend
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="last_order_date"
                    >
                        Last Order Date
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="status"
                    >
                        Account Status
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row }">
                    <RowColumn>{{ row.customer_id }}</RowColumn>
                    <RowColumn>{{ row.customer_name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.email_address }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.total_orders }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.total_spend }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.last_order_date }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <span
                            :class="[
                                colorStatus[row.account_status],
                                'text-xs rounded-2xl py-1 px-2',
                            ]"
                        >
                            {{ capitalizeFirstLetter(row.account_status) }}
                        </span>
                    </RowColumn>
                </Row>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>
