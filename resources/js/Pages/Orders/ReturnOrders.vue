<script setup>
import DateRangePicker from "@/Components/DateRangePicker.vue";
import InputLabel from "@/Components/InputLabel.vue";
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
    return_number: null,
    customer: null,
    tracking_number: null,
    date_range: [],
    payment: null,
});

const orders = ref([
    {
        return_number: "R20240813251001",
        order_number: "20240813251001",
        date_requested: "2024-08-12",
        customer: "Ethan James Harris",
        total: "24",
        items: "3",
        status: "shipped",
        tracking_number: "TN240814001",
    },
    {
        return_number: "R20240813251002",
        order_number: "20240813251002",
        date_requested: "2024-08-13",
        customer: "Jordan Lee",
        total: "40",
        items: "3",
        status: "pending",
        tracking_number: null,
    },
    {
        return_number: "R20240813251003",
        order_number: "20240813251003",
        date_requested: "2024-08-14",
        customer: "James William Smith",
        total: "230",
        items: "4",
        status: "completed",
        tracking_number: "TN240814002",
    },
    {
        return_number: "R20240813251004",
        order_number: "20240813251004",
        date_requested: "2024-08-15",
        customer: "Riley Davis",
        total: "434",
        items: "3",
        status: "shipped",
        tracking_number: "TN240814003",
    },
    {
        return_number: "R20240813251005",
        order_number: "20240813251005",
        date_requested: "2024-08-16",
        customer: "Lucas Alexander White",
        total: "879",
        items: "1",
        status: "cancelled",
        tracking_number: null,
    },
    {
        return_number: "R20240813251006",
        order_number: "20240813251006",
        date_requested: "2024-08-17",
        customer: "Jamie Taylor",
        total: "629",
        items: "2",
        status: "pending",
        tracking_number: null,
    },
    {
        return_number: "R20240813251007",
        order_number: "20240813251007",
        date_requested: "2024-08-18",
        customer: "Avery Brown",
        total: "170",
        items: "1",
        status: "shipped",
        tracking_number: "TN240814004",
    },
    {
        return_number: "R20240813251008",
        order_number: "20240813251008",
        date_requested: "2024-08-19",
        customer: "Michael David Brown",
        total: "390",
        items: "4",
        status: "completed",
        tracking_number: "TN240814005",
    },
    {
        return_number: "R20240813251009",
        order_number: "20240813251009",
        date_requested: "2024-08-20",
        customer: "Quinn Taylor",
        total: "800",
        items: "2",
        status: "pending",
        tracking_number: null,
    },
    {
        return_number: "R20240813251010",
        order_number: "20240813251010",
        date_requested: "2024-08-21",
        customer: "Olivia Kate Nelson",
        total: "670",
        items: "2",
        status: "shipped",
        tracking_number: "TN240814006",
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
    pending: "bg-gray-500 text-white",
    approved: "bg-custom-blue text-white",
    shipped: "bg-custom-blue text-white",
    completed: "bg-black dark:bg-slate-800 text-white",
    cancelled: "bg-red-500 text-white",
});

const navigateToOrderDetails = () => {
    window.location.href = "orders/view-order";
};

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const nav = ref([
    {
        label: "Return Orders",
        href: null,
    },
]);
</script>

<template>
    <Head title="Orders" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg dark:text-white mb-3">
                RETURN ORDERS
            </h1>
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
                        placeholder="Enter order number"
                    />
                </div>
                <div>
                    <InputLabel
                        for="returnNumber"
                        value="Return Number"
                    />
                    <TextInput
                        id="returnNumber"
                        type="text"
                        v-model="form.return_number"
                        placeholder="Enter return number"
                    />
                </div>
                <div>
                    <InputLabel
                        for="dateRequested"
                        value="Date Requested"
                    />
                    <DateRangePicker
                        v-model="form.date_range"
                        :enable-time-picker="true"
                        placeholder="Select date requested"
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
                <div class="bg-gray-100 rounded-full mr-2 gap-4">
                    <button
                        class="bg-gray-200 text-black px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        All Returns
                    </button>
                    <button
                        class="bg-gray-100 text-black px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Pending
                    </button>
                    <button
                        class="bg-gray-100 text-black px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Approved
                    </button>
                    <button
                        class="bg-gray-100 text-black px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                    >
                        Delivered
                    </button>
                    <button
                        class="bg-gray-100 text-black px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
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
                        Return Number
                    </ColumnHeader>
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
                        Date Requested
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
                        sortKey="status"
                    >
                        Status
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="traking_number"
                    >
                        Tracking Number
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row, index }">
                    <RowColumn>{{ index + 1 }}</RowColumn>
                    <RowColumn>{{ row.return_number }}</RowColumn>
                    <RowColumn>{{ row.order_number }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.customer }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.date_requested }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.total) }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.items }}
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
