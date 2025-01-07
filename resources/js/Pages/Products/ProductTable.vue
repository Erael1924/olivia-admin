<script setup>
import ColumnHeader from "@/Components/Table/ColumnHeader.vue";
import Row from "@/Components/Table/Row.vue";
import RowColumn from "@/Components/Table/RowColumn.vue";
import Table from "@/Components/Table/Table.vue";
import { moneyFormat } from "@/helpers/MoneyHelper";
import { Icon } from "@iconify/vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    product_name: null,
    product_code: null,
    stock_status: null,
    product_status: null,
});

const { url } = usePage();

const products = ref([
    {
        product_name: "Wireless Mouse",
        price: 29.99,
        category: "Home & Lifestyle",
        sub_category: "Peripherals",
        sold: 150,
        stock: 50,
        status: "published",
    },
    {
        product_name: "Bluetooth Headphones",
        price: 79.99,
        category: "Home & Lifestyle",
        sub_category: "Audio",
        sold: 200,
        stock: 30,
        status: "published",
    },
    {
        product_name: "Laptop Stand",
        price: 19.99,
        category: "Home & Lifestyle",
        sub_category: "Accessories",
        sold: 120,
        stock: 70,
        status: "published",
    },
    {
        product_name: "4K Monitor",
        price: 299.99,
        category: "Home & Lifestyle",
        sub_category: "Displays",
        sold: 85,
        stock: 40,
        status: "published",
    },
    {
        product_name: "Office Chair",
        price: 149.99,
        category: "Home & Lifestyle",
        sub_category: "Furniture",
        sold: 60,
        stock: 20,
        status: "pending",
    },
    {
        product_name: "Ergonomic Desk",
        price: 299.99,
        category: "Home & Lifestyle",
        sub_category: "Furniture",
        sold: 40,
        stock: 25,
        status: "published",
    },
    {
        product_name: "Running Shoes",
        price: 89.99,
        category: "Men",
        sub_category: "Footwear",
        sold: 300,
        stock: 100,
        status: "published",
    },
    {
        product_name: "Winter Jacket",
        price: 129.99,
        category: "Women",
        sub_category: "Outerwear",
        sold: 150,
        stock: 60,
        status: "draft",
    },
    {
        product_name: "Stainless Steel Water Bottle",
        price: 24.99,
        category: "Kids",
        sub_category: "Drinkware",
        sold: 250,
        stock: 90,
        status: "published",
    },
    {
        product_name: "Portable Charger",
        price: 39.99,
        category: "Home & Lifestyle",
        sub_category: "Power",
        sold: 180,
        stock: 80,
        status: "unpublished",
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
    draft: "bg-gray-300 text-black",
    pending: "bg-gray-500 text-white",
    published: "bg-black dark:bg-slate-800 text-white",
    unpublished: "bg-red-500 text-white",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};
</script>

<template>
    <Table
        :data="products"
        :pagination="pagination"
    >
        <template #columnHeader>
            <ColumnHeader>#</ColumnHeader>
            <ColumnHeader sortKey="order_number">Product Name</ColumnHeader>
            <ColumnHeader
                customClass="flex justify-center"
                sortKey="category"
            >
                Category
            </ColumnHeader>
            <ColumnHeader
                customClass="flex justify-center"
                sortKey="sub_category"
            >
                Sub-Category
            </ColumnHeader>
            <ColumnHeader
                customClass="flex justify-center"
                sortKey="price"
            >
                Price
            </ColumnHeader>
            <ColumnHeader
                customClass="flex justify-center"
                sortKey="stock"
            >
                Stock
            </ColumnHeader>
            <ColumnHeader
                customClass="flex justify-center"
                sortKey="sold"
            >
                Sold
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
            <RowColumn>{{ index + 1 }}</RowColumn>
            <RowColumn>{{ row.product_name }}</RowColumn>
            <RowColumn customClass="text-center">{{ row.category }}</RowColumn>
            <RowColumn customClass="text-center">
                {{ row.sub_category }}
            </RowColumn>
            <RowColumn customClass="text-center">
                ${{ moneyFormat(row.price) }}
            </RowColumn>
            <RowColumn customClass="text-center">{{ row.stock }}</RowColumn>
            <RowColumn customClass="text-center">{{ row.sold }}</RowColumn>
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
</template>
