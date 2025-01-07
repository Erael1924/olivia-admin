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
    ticket_id: null,
    category: null,
    priority: null,
    status: null,
});

const updateStatus = useForm({
    status: "open",
});
const updateModalShow = ref(false);

const supportTickets = ref([
    {
        ticket_id: 1,
        customer_name: "Alice Johnson",
        email_address: "alice.johnson@example.com",
        subject: "Order Not Received",
        category: "Shipping and Delivery",
        priority: "Urgent",
        status: "ongoing",
        date_submitted: "2024-08-01 10:00:00",
    },
    {
        ticket_id: 2,
        customer_name: "Bob Smith",
        email_address: "bob.smith@example.com",
        subject: "Refund Request for Order #456",
        category: "Payment and Billing",
        priority: "Medium",
        status: "ongoing",
        date_submitted: "2024-08-02 11:30:00",
    },
    {
        ticket_id: 3,
        customer_name: "Charlie Davis",
        email_address: "charlie.davis@example.com",
        subject: "Product Defect",
        category: "Product",
        priority: "High",
        status: "closed",
        date_submitted: "2024-08-03 14:00:00",
    },
    {
        ticket_id: 4,
        customer_name: "Diana Martinez",
        email_address: "diana.martinez@example.com",
        subject: "Website Login Issue",
        category: "Technical and Support",
        priority: "Urgent",
        status: "open",
        date_submitted: "2024-08-04 09:15:00",
    },
    {
        ticket_id: 5,
        customer_name: "Eve Lewis",
        email_address: "eve.lewis@example.com",
        subject: "Question about Product Size",
        category: "Product",
        priority: "Low",
        status: "on-hold",
        date_submitted: "2024-08-05 16:45:00",
    },
    {
        ticket_id: 6,
        customer_name: "Frank Wilson",
        email_address: "frank.wilson@example.com",
        subject: "Order Cancellation",
        category: "Order",
        priority: "Medium",
        status: "ongoing",
        date_submitted: "2024-08-06 10:30:00",
    },
    {
        ticket_id: 7,
        customer_name: "Grace Lee",
        email_address: "grace.lee@example.com",
        subject: "Payment Not Processed",
        category: "Payment and Billing",
        priority: "High",
        status: "open",
        date_submitted: "2024-08-07 14:00:00",
    },
    {
        ticket_id: 8,
        customer_name: "Hannah Young",
        email_address: "hannah.young@example.com",
        subject: "Technical Support Needed",
        category: "Technical and Support",
        priority: "Urgent",
        status: "closed",
        date_submitted: "2024-08-08 11:00:00",
    },
    {
        ticket_id: 9,
        customer_name: "Ian Thompson",
        email_address: "ian.thompson@example.com",
        subject: "Incorrect Item Received",
        category: "Shipping and Delivery",
        priority: "Medium",
        status: "on-hold",
        date_submitted: "2024-08-09 09:45:00",
    },
    {
        ticket_id: 10,
        customer_name: "Judy Adams",
        email_address: "judy.adams@example.com",
        subject: "Subscription Issue",
        category: "Account",
        priority: "Low",
        status: "closed",
        date_submitted: "2024-08-10 13:30:00",
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
    { label: "Open", value: "open" },
    { label: "Ongoing", value: "ongoing" },
    { label: "On-Hold", value: "on-hold" },
    { label: "Closed", value: "closed" },
]);

const priorityOptions = ref([
    { label: "All", value: null },
    { label: "Low", value: "low" },
    { label: "Medium", value: "medium" },
    { label: "High", value: "high" },
    { label: "Urgent", value: "urgent" },
]);

const categoryOptions = ref([
    { label: "All", value: null },
    { label: "Account and Login", value: "account-and-login" },
    { label: "Customer Service", value: "customer-service" },
    { label: "Order", value: "order" },
    { label: "Payment and Billing", value: "payment-and-billing" },
    { label: "Product", value: "product" },
    { label: "Promotion and Discount", value: "promotion-and-discount" },
    { label: "Returns Policies", value: "returns-policies" },
    { label: "Shipping and Delivery", value: "shipping-delivery" },
    { label: "Technical Support", value: "technical-support" },
]);

const colorStatus = ref({
    open: "bg-gray-200 text-black",
    ongoing: "bg-black dark:bg-slate-800 text-white",
    "on-hold": "bg-gray-500 text-white",
    closed: "bg-custom-blue text-white",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const navigateToViewTicketPage = () => {
    window.location.href = "/help-center/support-tickets/ticket-information";
};

const updateModal = () => {
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Support Tickets",
        href: null,
    },
]);
</script>

<template>
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
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="updateStatus.status"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        statusOptions.filter((option) => option.value !== null)
                    "
                    id="status"
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
    <Head title="Support Tickets" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                SUPPORT TICKETS
            </h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="ticketId"
                        value="Enter ticket ID"
                    />
                    <TextInput
                        id="ticketId"
                        type="text"
                        v-model="form.ticket_id"
                        placeholder="Ticket ID"
                    />
                </div>
                <div>
                    <InputLabel
                        for="category"
                        value="Category"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.category"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="categoryOptions"
                    />
                </div>
                <div>
                    <InputLabel
                        for="priority"
                        value="Priority Level"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.priority"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="priorityOptions"
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
            </div>
            <Table
                :data="supportTickets"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader sortKey="ticket_id">Ticket ID</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="customer_name"
                    >
                        Customer Name
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="subject"
                    >
                        Subject
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="category"
                    >
                        Category
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="priority_level"
                    >
                        Priority Level
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="status"
                    >
                        Status
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="date_submitted"
                    >
                        Date Submitted
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row }">
                    <RowColumn>{{ row.ticket_id }}</RowColumn>
                    <RowColumn>{{ row.customer_name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.subject }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.category }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.priority }}
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
                        {{ row.date_submitted }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <div class="flex justify-center gap-x-4">
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="navigateToViewTicketPage"
                            >
                                <Icon
                                    icon="solar:eye-linear"
                                    class="text-xs"
                                />
                            </button>
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="updateModal"
                            >
                                <Icon
                                    icon="mdi:check"
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
