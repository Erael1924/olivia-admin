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
    date_range: [],
    collection: null,
});

const productSales = ref([
    {
        product_id: "1",
        product_code: "TC-2024",
        product_name: "Essential Crew Neck T-Shirt",
        category: "Clothing",
        units_sold: 800,
        revenue: 32000,
        gross_profit: 16000,
        return_rate: 2.8,
        sales_channel: "Desktop",
        ratings: 4.3,
    },
    {
        product_id: "2",
        product_code: "HD-2024",
        product_name: "Classic Pullover Hoodie",
        category: "Clothing",
        units_sold: 650,
        revenue: 65000,
        gross_profit: 32500,
        return_rate: 3.0,
        sales_channel: "Mobile",
        ratings: 4.4,
    },
    {
        product_id: "3",
        product_code: "JD-2024",
        product_name: "Slim Fit Denim Jeans",
        category: "Clothing",
        units_sold: 550,
        revenue: 55000,
        gross_profit: 22000,
        return_rate: 3.2,
        sales_channel: "Desktop",
        ratings: 4.2,
    },
    {
        product_id: "4",
        product_code: "SW-2024",
        product_name: "Cozy Knit Sweater",
        category: "Clothing",
        units_sold: 700,
        revenue: 49000,
        gross_profit: 19600,
        return_rate: 2.9,
        sales_channel: "Mobile",
        ratings: 4.5,
    },
    {
        product_id: "5",
        product_code: "SH-2024",
        product_name: "Summer Chino Shorts",
        category: "Clothing",
        units_sold: 900,
        revenue: 36000,
        gross_profit: 14400,
        return_rate: 3.1,
        sales_channel: "Desktop",
        ratings: 4.0,
    },
    {
        product_id: "6",
        product_code: "JK-2024",
        product_name: "Lightweight Bomber Jacket",
        category: "Clothing",
        units_sold: 400,
        revenue: 80000,
        gross_profit: 32000,
        return_rate: 2.5,
        sales_channel: "Mobile",
        ratings: 4.7,
    },
    {
        product_id: "7",
        product_code: "SK-2024",
        product_name: "A-Line Midi Skirt",
        category: "Clothing",
        units_sold: 600,
        revenue: 30000,
        gross_profit: 12000,
        return_rate: 2.7,
        sales_channel: "Desktop",
        ratings: 4.1,
    },
    {
        product_id: "8",
        product_code: "BL-2024",
        product_name: "Tailored Blazer",
        category: "Clothing",
        units_sold: 350,
        revenue: 70000,
        gross_profit: 28000,
        return_rate: 3.3,
        sales_channel: "Mobile",
        ratings: 4.4,
    },
    {
        product_id: "9",
        product_code: "LT-2024",
        product_name: "High-Waist Leggings",
        category: "Clothing",
        units_sold: 800,
        revenue: 32000,
        gross_profit: 16000,
        return_rate: 2.6,
        sales_channel: "Desktop",
        ratings: 4.3,
    },
    {
        product_id: "10",
        product_code: "SC-2024",
        product_name: "Soft Cashmere Scarf",
        category: "Clothing",
        units_sold: 550,
        revenue: 22000,
        gross_profit: 11000,
        return_rate: 3.0,
        sales_channel: "Mobile",
        ratings: 4.2,
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
        label: "Product Performace",
        href: null,
    },
]);
</script>

<template>
    <Head title="Product Performance" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                Product Performance
            </h1>
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
                <div>
                    <InputLabel
                        for="productName"
                        value="Product Name"
                    />
                    <TextInput
                        id="productName"
                        type="text"
                        v-model="form.product_name"
                        placeholder="Enter product name"
                    />
                </div>
                <div>
                    <InputLabel
                        for="productCode"
                        value="Product Code"
                    />
                    <TextInput
                        id="productCode"
                        type="text"
                        v-model="form.product_code"
                        placeholder="Enter product code"
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
                :data="productSales"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="product_name">
                        Product Name
                    </ColumnHeader>

                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="product_code"
                    >
                        Product Code
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="collection"
                    >
                        Category
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="units_sold"
                    >
                        Units Sold
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="revenue"
                    >
                        Revenue
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="gross_profit"
                    >
                        Gross Profit
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="return_rate"
                    >
                        Return Rate
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="sales_channel"
                    >
                        Sales Channel
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="ratings"
                    >
                        Ratings
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row, index }">
                    <RowColumn>{{ index + 1 }}</RowColumn>
                    <RowColumn>{{ row.product_name }}</RowColumn>
                    <RowColumn>{{ row.product_code }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.category }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.units_sold }} pc
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.revenue) }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        ${{ moneyFormat(row.gross_profit) }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.return_rate }}%
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.sales_channel }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.ratings }}
                    </RowColumn>
                </Row>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>
