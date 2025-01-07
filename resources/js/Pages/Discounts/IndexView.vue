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
    discount_code: null,
    discount_type: null,
    applies_to: null,
    status: null,
});

const createForm = useForm({
    discount_code: null,
    description: null,
    discount_type: null,
    amount: null,
    minimum_spend: null,
    capped: null,
    applies_to: null,
    start_date: null,
    end_date: null,
    selected_category: null,
    selected_product: null,
});

const updateForm = useForm({
    discount_code: "SUMMER15",
    description: "15% off on all products during summer",
    discount_type: "percentage",
    amount: 15,
    minimum_spend: 200,
    capped: 150,
    start_date: "2024-08-16",
    end_date: "2024-08-20",
    applies_to: "all_products",
    selected_category: null,
    selected_product: null,
});

const createModalShow = ref(false);
const viewModalShow = ref(false);
const deleteModalShow = ref(false);
const updateModalShow = ref(false);

const discounts = ref([
    {
        discount_id: 1,
        discount_code: "SUMMER10",
        description: "10% off on all products during summer",
        type: "Percentage",
        amount: 10.0,
        min_spend: 0.0,
        capping: 50.0,
        start_date: "2024-06-01 00:00",
        end_date: "2024-08-31 23:59",
        status: "ongoing",
        applies_to: "All Products",
        created_at: "2024-05-15 10:00",
    },
    {
        discount_id: 2,
        discount_code: "WELCOME15",
        description: "$15 off on your first purchase",
        type: "Fixed Amount",
        amount: 15.0,
        min_spend: 50.0,
        capping: null,
        start_date: "2024-01-01 00:00",
        end_date: "2024-12-31 23:59",
        status: "ongoing",
        applies_to: "All Products",
        created_at: "2024-01-01 00:00",
    },
    {
        discount_id: 3,
        discount_code: "HOLIDAY20",
        description: "20% off on holiday items",
        type: "Percentage",
        amount: 20.0,
        min_spend: 30.0,
        capping: 100.0,
        start_date: "2024-11-01 00:00",
        end_date: "2024-12-31 23:59",
        status: "pending",
        applies_to: "Selected Category",
        created_at: "2024-10-15 09:30",
    },
    {
        discount_id: 4,
        discount_code: "FREESHIP",
        description: "Free shipping on orders over $75",
        type: "Fixed Amount",
        amount: 0.0,
        min_spend: 75.0,
        capping: null,
        start_date: "2024-01-01 00:00",
        end_date: "2024-12-31 23:59",
        status: "ongoing",
        applies_to: "All Products",
        created_at: "2024-01-01 00:00",
    },
    {
        discount_id: 5,
        discount_code: "VIP25",
        description: "$25 off for VIP members",
        type: "Fixed Amount",
        amount: 25.0,
        min_spend: 100.0,
        capping: null,
        start_date: "2024-03-01 00:00",
        end_date: "2024-08-31 23:59",
        status: "ongoing",
        applies_to: "All Products",
        created_at: "2024-02-20 11:00",
    },
    {
        discount_id: 6,
        discount_code: "SPRING30",
        description: "30% off on spring collection",
        type: "Percentage",
        amount: 30.0,
        min_spend: 0.0,
        capping: 75.0,
        start_date: "2024-03-01 00:00",
        end_date: "2024-05-31 23:59",
        status: "expired",
        applies_to: "Selected Category",
        created_at: "2024-02-01 12:00",
    },
    {
        discount_id: 7,
        discount_code: "NEWYEAR50",
        description: "$50 off on orders over $200 for New Year",
        type: "Fixed Amount",
        amount: 50.0,
        min_spend: 200.0,
        capping: null,
        start_date: "2024-12-01 00:00",
        end_date: "2025-01-05 23:59",
        status: "pending",
        applies_to: "All Products",
        created_at: "2024-11-15 14:00",
    },
    {
        discount_id: 8,
        discount_code: "FLASH20",
        description: "20% off on flash sale items",
        type: "Percentage",
        amount: 20.0,
        min_spend: 0.0,
        capping: 40.0,
        start_date: "2024-07-15 00:00",
        end_date: "2024-07-20 23:59",
        status: "expired",
        applies_to: "Selected Product",
        created_at: "2024-07-10 08:00",
    },
    {
        discount_id: 9,
        discount_code: "CLEARANCE15",
        description: "15% off on clearance items",
        type: "Percentage",
        amount: 15.0,
        min_spend: 10.0,
        capping: 50.0,
        start_date: "2024-05-01 00:00",
        end_date: "2024-06-30 23:59",
        status: "expired",
        applies_to: "Selected Category",
        created_at: "2024-04-20 10:00",
    },
    {
        discount_id: 10,
        discount_code: "DRAFT10",
        description: "Draft discount example",
        type: "Fixed Amount",
        amount: 10.0,
        min_spend: 0.0,
        capping: null,
        start_date: null,
        end_date: null,
        status: "draft",
        applies_to: "All Products",
        created_at: "2024-08-01 15:00",
    },
    {
        discount_id: 11,
        discount_code: "MEMBER5",
        description: "5% off for members",
        type: "Percentage",
        amount: 5.0,
        min_spend: 0.0,
        capping: null,
        start_date: "2024-01-01 00:00",
        end_date: "2024-12-31 23:59",
        status: "ongoing",
        applies_to: "All Products",
        created_at: "2024-01-01 00:00",
    },
    {
        discount_id: 12,
        discount_code: "BOGO50",
        description: "Buy one, get one 50% off",
        type: "Percentage",
        amount: 50.0,
        min_spend: 0.0,
        capping: null,
        start_date: "2024-04-01 00:00",
        end_date: "2024-06-30 23:59",
        status: "ongoing",
        applies_to: "All Products",
        created_at: "2024-03-15 16:00",
    },
    {
        discount_id: 13,
        discount_code: "BACK2SCHOOL",
        description: "$10 off on back-to-school items",
        type: "Fixed Amount",
        amount: 10.0,
        min_spend: 30.0,
        capping: null,
        start_date: "2024-08-01 00:00",
        end_date: "2024-09-30 23:59",
        status: "ongoing",
        applies_to: "Selected Category",
        created_at: "2024-07-20 09:00",
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
    { label: "Draft", value: "draft" },
    { label: "Pending", value: "pending" },
    { label: "Ongoing", value: "ongoing" },
    { label: "Expired", value: "expired" },
]);

const typeOptions = ref([
    { label: "All", value: null },
    { label: "Fixed Amount", value: "fixed_amount" },
    { label: "Percentage", value: "percentage" },
]);

const appliesToOptions = ref([
    { label: "All", value: null },
    { label: "All Products", value: "all_products" },
    { label: "Selected Collection", value: "selected_collection" },
    { label: "Selected Category", value: "selected_category" },
    { label: "Selected Product", value: "selected_product" },
]);

const subCategoryOptions = [
    { label: "All", value: null },
    { label: "Accessories", value: "accessories" },
    { label: "Bags", value: "bags" },
    { label: "Beauty", value: "beauty" },
    { label: "Clothing", value: "clothing" },
    { label: "Displays", value: "displays" },
    { label: "Furtinure", value: "furtinure" },
    { label: "Grooming", value: "grooming" },
    { label: "Home Decor", value: "home_decor" },
    { label: "Jewellery", value: "jewellery" },
    { label: "Shoes", value: "shoes" },
    { label: "Sports", value: "sports" },
];

const products = ref([
    { label: "Wireless Mouse", value: 1 },
    { label: "Bluetooth Headphones", value: 2 },
    { label: "Laptop Stand", value: 3 },
    { label: "4K Monitor", value: 4 },
    { label: "Office Chair", value: 5 },
    { label: "Ergonomic Desk", value: 6 },
    { label: "Running Shoes", value: 7 },
    { label: "Winter Jacket", value: 8 },
    { label: "Stainless Steel Water Bottle", value: 9 },
    { label: "Portable Charger", value: 10 },
]);

const colorStatus = ref({
    draft: "bg-gray-200 text-black",
    pending: "bg-gray-500 text-white",
    ongoing: "bg-black text-white",
    expired: "bg-red-500 text-white",
});

const createModal = () => {
    createModalShow.value = true;
};

const viewModal = () => {
    viewModalShow.value = true;
};

const deleteModal = () => {
    deleteModalShow.value = true;
};

const updateModal = () => {
    updateModalShow.value = true;
};

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const nav = ref([
    {
        label: "Discounts",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Discount Details"
        maxWidth="lg"
        :show="viewModalShow"
        @close="viewModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel value="Discount Code" />
                <label
                    class="block font-semibold text-md text-black dark:text-white mt-1"
                >
                    SUMMER15
                </label>
            </div>
            <div class="mb-3">
                <InputLabel value="Description" />
                <label
                    class="block font-semibold text-md text-black dark:text-white mt-1"
                >
                    15% off on all products during summer
                </label>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel value="Discount Type" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        Percentage
                    </label>
                </div>
                <div class="w-1/2">
                    <InputLabel value="Amount" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        15
                    </label>
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel value="Minimum Spend" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        199
                    </label>
                </div>
                <div class="w-1/2">
                    <InputLabel value="Capped" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        200
                    </label>
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel value="Start Date" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        08/23/2024
                    </label>
                </div>
                <div class="w-1/2">
                    <InputLabel value="End Date" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        08/29/2024
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <InputLabel value="Applies To" />
                <label
                    class="block font-semibold text-md text-black dark:text-white mt-1"
                >
                    All Products
                </label>
            </div>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <button
                class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="viewModalShow = false"
            >
                CLOSE
            </button>
        </div>
    </Modal>
    <Modal
        title="Create Discount"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="discountCode"
                    value="Discount Code"
                    :required="true"
                />
                <TextInput
                    id="discountCode"
                    type="text"
                    v-model="createForm.discount_code"
                    placeholder="Enter discount code"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="description"
                    value="Description"
                    :required="true"
                />
                <TextInput
                    id="description"
                    type="text"
                    v-model="createForm.description"
                    placeholder="Enter description"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="discountType"
                        value="Discount Type"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="createForm.discount_type"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            typeOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="amount"
                        value="Amount"
                        :required="true"
                    />
                    <TextInput
                        id="amount"
                        type="number"
                        v-model="createForm.amount"
                        placeholder="Enter amount"
                    />
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="minimumSpend"
                        value="Minimum Spend"
                    />
                    <TextInput
                        id="minimumSpend"
                        type="number"
                        v-model="createForm.minimum_spend"
                        placeholder="Enter minimum spend"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="capped"
                        value="Capped"
                    />
                    <TextInput
                        id="capped"
                        type="number"
                        v-model="createForm.capped"
                        placeholder="Enter capped"
                    />
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="startDate"
                        value="Start Date"
                        :required="true"
                    />
                    <TextInput
                        id="startDate"
                        type="date"
                        v-model="createForm.start_date"
                        placeholder="Enter start date"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="endDate"
                        value="End Date"
                        :required="true"
                    />
                    <TextInput
                        id="endDate"
                        type="date"
                        v-model="createForm.end_date"
                        placeholder="Enter end date"
                    />
                </div>
            </div>
            <div class="mb-3">
                <InputLabel
                    for="appliesTo"
                    value="Applies To"
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="createForm.applies_to"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        appliesToOptions.filter(
                            (option) => option.value !== null
                        )
                    "
                />
            </div>
            <div
                class="mb-3"
                v-if="createForm.applies_to == 'selected_category'"
            >
                <InputLabel
                    for="category"
                    value="Select Category"
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="createForm.selected_category"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        subCategoryOptions.filter(
                            (option) => option.value !== null
                        )
                    "
                    multiple
                />
            </div>
            <div
                class="mb-3"
                v-if="createForm.applies_to == 'selected_product'"
            >
                <InputLabel
                    for="product"
                    value="Select Product"
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="createForm.selected_product"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="products"
                    multiple
                />
            </div>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <button
                class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="createModalShow = false"
            >
                CANCEL
            </button>
            <button
                class="bg-black dark:bg-custom-blue text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="createModalShow = false"
            >
                SAVE
            </button>
        </div>
    </Modal>
    <Modal
        title="Confirmation"
        maxWidth="lg"
        :show="deleteModalShow"
        @close="deleteModalShow = false"
    >
        <div class="modal-body mb-5">
            <p class="text-sm dark:text-white">
                Are you sure you want to delete this discount?
            </p>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <button
                class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="deleteModalShow = false"
            >
                NO
            </button>
            <button
                class="bg-black dark:bg-slate-900 text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="deleteModalShow = false"
            >
                YES
            </button>
        </div>
    </Modal>
    <Modal
        title="Update Discount"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="discountCode"
                    value="Discount Code"
                    :required="true"
                />
                <TextInput
                    id="discountCode"
                    type="text"
                    v-model="updateForm.discount_code"
                    placeholder="Enter discount code"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="description"
                    value="Description"
                    :required="true"
                />
                <TextInput
                    id="description"
                    type="text"
                    v-model="updateForm.description"
                    placeholder="Enter description"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="discountType"
                        value="Discount Type"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="updateForm.discount_type"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="
                            typeOptions.filter(
                                (option) => option.value !== null
                            )
                        "
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="amount"
                        value="Amount"
                        :required="true"
                    />
                    <TextInput
                        id="amount"
                        type="number"
                        v-model="updateForm.amount"
                        placeholder="Enter amount"
                    />
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="minimumSpend"
                        value="Minimum Spend"
                    />
                    <TextInput
                        id="minimumSpend"
                        type="number"
                        v-model="updateForm.minimum_spend"
                        placeholder="Enter minimum spend"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="capped"
                        value="Capped"
                    />
                    <TextInput
                        id="capped"
                        type="number"
                        v-model="updateForm.capped"
                        placeholder="Enter capped"
                    />
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="startDate"
                        value="Start Date"
                        :required="true"
                    />
                    <TextInput
                        id="startDate"
                        type="date"
                        v-model="updateForm.start_date"
                        placeholder="Enter start date"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="endDate"
                        value="End Date"
                        :required="true"
                    />
                    <TextInput
                        id="endDate"
                        type="date"
                        v-model="updateForm.end_date"
                        placeholder="Enter end date"
                    />
                </div>
            </div>
            <div class="mb-3">
                <InputLabel
                    for="appliesTo"
                    value="Applies To"
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="updateForm.applies_to"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        appliesToOptions.filter(
                            (option) => option.value !== null
                        )
                    "
                />
            </div>
            <div
                class="mb-3"
                v-if="updateForm.applies_to == 'selected_category'"
            >
                <InputLabel
                    for="category"
                    value="Select Category"
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="updateForm.selected_category"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        subCategoryOptions.filter(
                            (option) => option.value !== null
                        )
                    "
                    multiple
                />
            </div>
            <div
                class="mb-3"
                v-if="updateForm.applies_to == 'selected_product'"
            >
                <InputLabel
                    for="product"
                    value="Select Product"
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="updateForm.selected_product"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="products"
                    multiple
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
    <Head title="Discounts" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">DISCOUNTS</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="discountCode"
                        value="Discount Code"
                    />
                    <TextInput
                        id="discountCode"
                        type="text"
                        v-model="form.discount_code"
                        placeholder="Enter discount code"
                    />
                </div>
                <div>
                    <InputLabel
                        for="type"
                        value="Discount Type"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.discount_type"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="typeOptions"
                    />
                </div>
                <div>
                    <InputLabel
                        for="type"
                        value="Applies To"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.applies_to"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="appliesToOptions"
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
                <button
                    class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-between"
                >
                    EXPORT
                    <Icon
                        icon="solar:export-linear"
                        class="ml-2"
                    />
                </button>
                <button
                    class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-between"
                    @click="createModal"
                >
                    CREATE DISCOUNT
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="discounts"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>ID</ColumnHeader>
                    <ColumnHeader sortKey="name">Discount Code</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="discount_type"
                    >
                        Discount Type
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="applies_to"
                    >
                        Applies To
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="amount"
                    >
                        Amount
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="duration"
                    >
                        Duration
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
                    <RowColumn>{{ row.discount_id }}</RowColumn>
                    <RowColumn>{{ row.discount_code }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.type }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.applies_to }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.amount }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <template v-if="row.start_date && row.end_date">
                            {{ row.start_date }} - {{ row.end_date }}
                        </template>
                        <template v-else>--</template>
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
                                @click="viewModal"
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
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="deleteModal"
                            >
                                <Icon
                                    icon="solar:trash-bin-2-outline"
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
