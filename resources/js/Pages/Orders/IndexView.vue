<script setup>
import DateRangePicker from "@/Components/DateRangePicker.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import ColumnHeader from "@/Components/Table/ColumnHeader.vue";
import Row from "@/Components/Table/Row.vue";
import RowColumn from "@/Components/Table/RowColumn.vue";
import Table from "@/Components/Table/Table.vue";
import TextInput from "@/Components/TextInput.vue";
import { moneyFormat } from "@/helpers/MoneyHelper";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    order_number: null,
    customer: null,
    tracking_number: null,
    date_range: [],
    payment: null,
});

const updateStatus = useForm({
    status: null,
});
const updateModalShow = ref(false);

const orders = ref([
    {
        order_number: "20240813251001",
        order_date: "2024-08-12",
        customer: "Ethan James Harris",
        total: "24",
        items: "3",
        status: "Shipped",
        tracking_number: "TN240814001",
        payment_method: "Cash On Delivery",
    },
    {
        order_number: "20240813251002",
        order_date: "2024-08-13",
        customer: "Jordan Lee",
        total: "40",
        items: "3",
        status: "Pending",
        tracking_number: null,
        payment_method: "Cash On Delivery",
    },
    {
        order_number: "20240813251003",
        order_date: "2024-08-14",
        customer: "James William Smith",
        total: "230",
        items: "4",
        status: "Delivered",
        tracking_number: "TN240814002",
        payment_method: "Payment Center",
    },
    {
        order_number: "20240813251004",
        order_date: "2024-08-15",
        customer: "Riley Davis",
        total: "434",
        items: "3",
        status: "Shipped",
        tracking_number: "TN240814003",
        payment_method: "E-wallet",
    },
    {
        order_number: "20240813251005",
        order_date: "2024-08-16",
        customer: "Lucas Alexander White",
        total: "879",
        items: "1",
        status: "Cancelled",
        tracking_number: null,
        payment_method: "Cash On Delivery",
    },
    {
        order_number: "20240813251006",
        order_date: "2024-08-17",
        customer: "Jamie Taylor",
        total: "629",
        items: "2",
        status: "Pending",
        tracking_number: null,
        payment_method: "Credit / Debit Card",
    },
    {
        order_number: "20240813251007",
        order_date: "2024-08-18",
        customer: "Avery Brown",
        total: "170",
        items: "1",
        status: "Shipped",
        tracking_number: "TN24081404",
        payment_method: "Payment Center",
    },
    {
        order_number: "20240813251008",
        order_date: "2024-08-19",
        customer: "Michael David Brown",
        total: "390",
        items: "4",
        status: "Delivered",
        tracking_number: "TN24081405",
        payment_method: "Cash On Delivery",
    },
    {
        order_number: "20240813251009",
        order_date: "2024-08-20",
        customer: "Quinn Taylor",
        total: "800",
        items: "2",
        status: "Pending",
        tracking_number: null,
        payment_method: "E-wallet",
    },
    {
        order_number: "20240813251010",
        order_date: "2024-08-21",
        customer: "Olivia Kate Nelson",
        total: "670",
        items: "2",
        status: "Shipped",
        tracking_number: "TN240814006",
        payment_method: "Credit / Debit Card",
    },
]);

const pagination = ref({
    total: 70,
    count: 10,
    per_page: 10,
    current_page: 1,
    total_pages: 7,
});

const colorStatus = ref({
    Pending: "bg-gray-500 text-white",
    Preparing: "bg-custom-blue text-white",
    Shipped: "bg-custom-blue text-white",
    Delivered: "bg-black dark:bg-slate-800 text-white",
    Cancelled: "bg-red-500 text-white",
});

const statusOptions = [
    { label: "Preparing", value: "preparing" },
    { label: "Cancel", value: "cancel" },
];

const paymentOptions = [
    { label: "All", value: null },
    { label: "Cash On Delivery", value: "cod" },
    { label: "Credit / Debit Card", value: "credit_debit" },
    { label: "E-wallet", value: "e-wallet" },
    { label: "Payment Center", value: "payment_center" },
];

const navigateToOrderDetails = () => {
    window.location.href = "orders/view-order";
};

const updateModal = () => {
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Orders",
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
                    :options="statusOptions"
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
    <Head title="Orders" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold dark:text-white text-lg mb-3">ORDERS</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="orderNumber"
                        value="Order Number"
                    />
                    <TextInput
                        id="orderNumber"
                        type="text"
                        v-model="form.order_number"
                        placeholder="Enter order number..."
                    />
                </div>
                <div>
                    <InputLabel
                        for="orderDate"
                        value="Order Date"
                    />
                    <DateRangePicker
                        v-model="form.date_range"
                        :enable-time-picker="true"
                        placeholder="Select order date"
                    ></DateRangePicker>
                </div>
                <div>
                    <InputLabel
                        for="trackingNumber"
                        value="Tracking Number"
                    />
                    <TextInput
                        id="trackingNumber"
                        type="text"
                        v-model="form.tracking_number"
                        placeholder="Enter tracking number"
                    />
                </div>
                <div>
                    <InputLabel
                        for="customer"
                        value="Customer"
                    />
                    <TextInput
                        id="customer"
                        type="text"
                        v-model="form.customer"
                        placeholder="Enter customer"
                    />
                </div>
                <div>
                    <InputLabel
                        for="payment"
                        value="Payment Method"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-900 text-xs !p-0 mt-1"
                        v-model="form.payment"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="paymentOptions"
                        id="payment"
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
            <div
                class="flex flex-wrap justify-center items-center mb-5 sm:justify-center md:justify-center lg:justify-between xl:justify-between"
            >
                <div
                    class="bg-gray-100 dark:bg-gray-900 rounded-full mr-2 gap-4 p-1"
                >
                    <button
                        class="bg-gray-200 dark:bg-black text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        All Orders
                    </button>
                    <button
                        class="bg-gray-100 dark:bg-gray-900 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Pending
                    </button>
                    <button
                        class="bg-gray-100 dark:bg-gray-900 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Preparing
                    </button>
                    <button
                        class="bg-gray-100 dark:bg-gray-900 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Shipped
                    </button>
                    <button
                        class="bg-gray-100 dark:bg-gray-900 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Delivered
                    </button>
                    <button
                        class="bg-gray-100 dark:bg-gray-900 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Cancelled
                    </button>
                </div>
            </div>
            <Table
                :data="orders"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="order_number">
                        Order Number
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="customer"
                    >
                        Customer
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="order_date"
                    >
                        Order Date
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="total"
                    >
                        Total
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="items"
                    >
                        Items
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="payment_method"
                    >
                        Payment Method
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="status"
                    >
                        Status
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="tracking_number"
                    >
                        Tracking Number
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row, index }">
                    <RowColumn>{{ index + 1 }}</RowColumn>
                    <RowColumn>{{ row.order_number }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.customer }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.order_date }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.total) }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.items }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.payment_method }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <span
                            :class="[
                                colorStatus[row.status],
                                'text-xs rounded-2xl py-1 px-2',
                            ]"
                        >
                            {{ row.status }}
                        </span>
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.tracking_number ?? "--" }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <div class="flex justify-center gap-x-5">
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="navigateToOrderDetails"
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
                                    icon="mynaui:edit-one"
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
