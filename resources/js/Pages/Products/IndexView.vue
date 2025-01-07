<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ColumnHeader from "@/Components/Table/ColumnHeader.vue";
import Row from "@/Components/Table/Row.vue";
import RowColumn from "@/Components/Table/RowColumn.vue";
import Table from "@/Components/Table/Table.vue";
import TextInput from "@/Components/TextInput.vue";
import { moneyFormat } from "@/helpers/MoneyHelper";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { useSettingStore } from "@/Stores/settings";
import { useToastStore } from "@/Stores/toast";
import { Icon } from "@iconify/vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";
import { defineAsyncComponent, ref } from "vue";

const props = defineProps({
    result: Object,
    categories: Object,
    collections: Object,
    sub_categories: Object,
    query: Object,
});

const settingStore = useSettingStore();
const { perPage } = storeToRefs(settingStore);
const toastStore = useToastStore();
const orderBy = ref({});
orderBy.value = props.query.order_by ?? {};

const stockOptions = [
    { label: "All", value: null },
    { label: "In Stock", value: "in_stock" },
    { label: "Low Stock", value: "low_stock" },
    { label: "No Stock", value: "no_stock" },
];

const productStatus = [
    { label: "All", value: null },
    { label: "Draft", value: "draft" },
    { label: "Pending", value: "pending" },
    { label: "Published", value: "published" },
    { label: "Unpublished", value: "unpublished" },
];

const collectionOptions = ref([{ label: "All", value: null }]);
collectionOptions.value = [
    ...collectionOptions.value,
    ...props.collections.map((item) => ({
        value: item["id"],
        label: item["name"],
    })),
];

const categoryOptions = ref([{ label: "All", value: null }]);
categoryOptions.value = [
    ...categoryOptions.value,
    ...props.categories.map((item) => ({
        value: item["id"],
        label: item["name"],
    })),
];

const subCategoryOptions = ref([{ label: "All", value: null }]);
subCategoryOptions.value = [
    ...subCategoryOptions.value,
    ...props.sub_categories.map((item) => ({
        value: item["id"],
        label: item["name"],
    })),
];

const form = useForm({
    product_name: props.query.product_name ?? null,
    product_code: props.query.product_code ?? null,
    status: props.query.status ?? null,
    stock_status: props.query.stock_status ?? null,
    product_status: props.query.product_status ?? null,
    collection: props.query.collection ?? null,
    category: props.query.category ?? null,
    sub_category: props.query.sub_category ?? null,
    per_page: perPage.value,
    page: 1,
    order_by: props.query.order_by ?? {},
});

const search = (page = 1) => {
    form.page = page;
    form.per_page = perPage.value;
    form.order_by = orderBy.value;
    form.get(route("products"), {
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
    form.product_name = null;
    form.product_code = null;
    form.stock_status = null;
    form.product_status = null;
    form.collection = null;
    form.category = null;
    form.sub_category = null;
    search(1);
};

const updateOrderBy = (order_by) => {
    orderBy.value = order_by;
    search(1);
};

const tableComponent = ref(null);
const activeComponent = ref("grid");

const loadComponent = async () => {
    activeComponent.value = "table";

    const module = await import("./ProductTable.vue");
    tableComponent.value = defineAsyncComponent(() =>
        Promise.resolve(module.default)
    );
};

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

const nav = ref([
    {
        label: "Products",
        href: null,
    },
]);
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg dark:text-white mb-3">PRODUCTS</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
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
                <div>
                    <InputLabel
                        for="stockFilter"
                        value="Stock Status"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.stock_status"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="stockOptions"
                        id="stockFilter"
                    />
                </div>
                <div>
                    <InputLabel
                        for="statusFilter"
                        value="Product Status"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.status"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="productStatus"
                        id="statusFilter"
                    />
                </div>
                <div>
                    <InputLabel
                        for="collection"
                        value="Collection"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.collection"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="collectionOptions"
                        id="collection"
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
                        id="category"
                    />
                </div>
                <div>
                    <InputLabel
                        for="subCategory"
                        value="Sub Category"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.sub_category"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="subCategoryOptions"
                        id="subCategory"
                    />
                </div>
            </div>
            <div class="flex justify-between items-center gap-x-2 mb-10">
                <div class="filter-action flex flex-wrap items-center gap-x-2">
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
                    <Link
                        :href="route('products.create')"
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white text-black px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-between"
                    >
                        CREATE PRODUCT
                        <Icon
                            icon="solar:add-circle-linear"
                            class="ml-2"
                        />
                    </Link>
                </div>
                <div class="flex flex-wrap items-center gap-x-2">
                    <button
                        :class="[
                            activeComponent == 'grid'
                                ? 'bg-black text-white dark:bg-slate-800 dark:text-white'
                                : 'bg-gray-100 text-black dark:bg-slate-900 dark:text-white',
                            ' shadow px-2 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white',
                        ]"
                        @click="activeComponent = 'grid'"
                    >
                        <Icon
                            icon="mynaui:grid"
                            class="text-md"
                        />
                    </button>
                    <button
                        :class="[
                            activeComponent == 'table'
                                ? 'bg-black text-white dark:bg-slate-800 dark:text-white'
                                : 'bg-gray-100 text-black dark:bg-slate-900 dark:text-white',
                            ' shadow px-2 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white',
                        ]"
                        @click="loadComponent"
                    >
                        <Icon
                            icon="fa6-solid:list"
                            class="text-md"
                        />
                    </button>
                </div>
            </div>
            <div class="product-container">
                <Table
                    :data="result.data"
                    :pagination="result.pagination"
                    :orderBy="orderBy"
                    @change="search"
                    @order-by="updateOrderBy"
                >
                    <template #columnHeader>
                        <ColumnHeader>#</ColumnHeader>
                        <ColumnHeader sortKey="order_number">
                            Product Name
                        </ColumnHeader>
                        <ColumnHeader
                            customClass="flex justify-center"
                            sortKey="collection"
                        >
                            Collection
                        </ColumnHeader>
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
                        <RowColumn>{{ row.name }}</RowColumn>
                        <RowColumn customClass="text-center">
                            {{ row.collection.name }}
                        </RowColumn>
                        <RowColumn customClass="text-center">
                            {{ row.category.name }}
                        </RowColumn>
                        <RowColumn customClass="text-center">
                            {{ row.sub_category.name }}
                        </RowColumn>
                        <RowColumn customClass="text-center">
                            <template v-if="row.has_variant == 1">
                                <template v-if="row.min_price == row.max_price">
                                    ${{ row.min_price }}
                                </template>
                                <template v-else>
                                    ${{ row.min_price }} - ${{ row.max_price }}
                                </template>
                            </template>
                            <template v-else>
                                ${{ moneyFormat(row.price) }}
                            </template>
                        </RowColumn>
                        <RowColumn customClass="text-center">
                            {{ row.stock ?? 0 }}
                        </RowColumn>
                        <RowColumn customClass="text-center">
                            {{ row.sold ?? 0 }}
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
                            <div class="flex justify-center gap-x-5">
                                <Link
                                    :href="
                                        route('products.view-product', {
                                            id: row.id,
                                        })
                                    "
                                    class="border-none bg-none"
                                >
                                    <Icon
                                        icon="solar:eye-linear"
                                        class="text-xs"
                                    />
                                </Link>
                                <Link
                                    :href="
                                        route('products.view-update', {
                                            id: row.id,
                                        })
                                    "
                                    class="border-none bg-none"
                                >
                                    <Icon
                                        icon="mynaui:edit-one"
                                        class="text-xs"
                                    />
                                </Link>
                            </div>
                        </RowColumn>
                    </Row>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
