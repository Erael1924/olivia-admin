<script setup>
import DateRangePicker from "@/Components/DateRangePicker.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ColumnHeader from "@/Components/Table/ColumnHeader.vue";
import Row from "@/Components/Table/Row.vue";
import RowColumn from "@/Components/Table/RowColumn.vue";
import Table from "@/Components/Table/Table.vue";
import { moneyFormat } from "@/helpers/MoneyHelper";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    date_range: [],
    collection: null,
});

const sales = ref([
    {
        date: "2024-08-01",
        collection: "Women",
        total_orders: 50,
        sales_amount: 2000,
        quantity_sold: 100,
        discounts_applied: 80,
        total_shipping_cost: 50,
        net_sales_amount: 1870,
    },
    {
        date: "2024-08-01",
        collection: "Men",
        total_orders: 60,
        sales_amount: 1500,
        quantity_sold: 90,
        discounts_applied: 70,
        total_shipping_cost: 40,
        net_sales_amount: 1390,
    },
    {
        date: "2024-08-01",
        collection: "Kids",
        total_orders: 20,
        sales_amount: 800,
        quantity_sold: 50,
        discounts_applied: 30,
        total_shipping_cost: 30,
        net_sales_amount: 740,
    },
    {
        date: "2024-08-01",
        collection: "Home & Lifestyle",
        total_orders: 20,
        sales_amount: 700,
        quantity_sold: 60,
        discounts_applied: 20,
        total_shipping_cost: 30,
        net_sales_amount: 650,
    },
    {
        date: "2024-08-02",
        collection: "Women",
        total_orders: 40,
        sales_amount: 1800,
        quantity_sold: 80,
        discounts_applied: 60,
        total_shipping_cost: 40,
        net_sales_amount: 1740,
    },
    {
        date: "2024-08-02",
        collection: "Men",
        total_orders: 45,
        sales_amount: 1500,
        quantity_sold: 75,
        discounts_applied: 50,
        total_shipping_cost: 35,
        net_sales_amount: 1415,
    },
    {
        date: "2024-08-02",
        collection: "Kids",
        total_orders: 20,
        sales_amount: 600,
        quantity_sold: 45,
        discounts_applied: 20,
        total_shipping_cost: 20,
        net_sales_amount: 560,
    },
    {
        date: "2024-08-02",
        collection: "Home & Lifestyle",
        total_orders: 15,
        sales_amount: 1000,
        quantity_sold: 50,
        discounts_applied: 20,
        total_shipping_cost: 35,
        net_sales_amount: 945,
    },
    {
        date: "2024-08-03",
        collection: "Women",
        total_orders: 70,
        sales_amount: 2200,
        quantity_sold: 120,
        discounts_applied: 100,
        total_shipping_cost: 60,
        net_sales_amount: 2040,
    },
    {
        date: "2024-08-03",
        collection: "Men",
        total_orders: 80,
        sales_amount: 2000,
        quantity_sold: 110,
        discounts_applied: 120,
        total_shipping_cost: 70,
        net_sales_amount: 1810,
    },
]);

const pagination = ref({
    total: 70,
    count: 10,
    per_page: 10,
    current_page: 1,
    total_pages: 7,
});

const collectionOptions = [
    { label: "All", value: null },
    { label: "Women", value: "women" },
    { label: "Men", value: "men" },
    { label: "Kids", value: "kids" },
    { label: "Home & Lifestyle", value: "home_lifestyle" },
];

const nav = ref([
    {
        label: "Sales Report",
        href: null,
    },
]);
</script>

<template>
    <Head title="Sales Report" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">SALES REPORT</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel value="Sales Date" />
                    <DateRangePicker
                        v-model="form.date_range"
                        :enable-time-picker="true"
                        placeholder="Select sales date"
                    ></DateRangePicker>
                </div>
                <div>
                    <InputLabel value="Collection" />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.collection"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="collectionOptions"
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
                :data="sales"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="date">Date</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="collection"
                    >
                        Collection
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="total_orders"
                    >
                        Total Orders
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="sales_amount"
                    >
                        Sales Amount
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="quantity_sold"
                    >
                        Quantity Sold
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="discounts_applied"
                    >
                        Discounts Applied
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="shipping_cost"
                    >
                        Shipping Cost
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="shipping_cost"
                    >
                        Net Sales Amount
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row, index }">
                    <RowColumn>{{ index + 1 }}</RowColumn>
                    <RowColumn>{{ row.date }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.collection }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.total_orders }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.sales_amount) }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.quantity_sold }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.discounts_applied) }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.total_shipping_cost) }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.net_sales_amount) }}
                    </RowColumn>
                </Row>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>
