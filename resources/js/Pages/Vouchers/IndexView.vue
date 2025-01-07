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
    voucher_code: null,
    voucher_type: null,
    applies_to: null,
    status: null,
});

const createForm = useForm({
    voucher_code: null,
    description: null,
    voucher_type: null,
    amount: null,
    minimum_spend: null,
    capped: null,
    usage_limit: null,
    maximum_redemptions: null,
    applies_to: null,
    start_date: null,
    end_date: null,
});

const updateForm = useForm({
    voucher_code: "SUMMER15",
    description: "15% off on all products during summer",
    voucher_type: "percentage",
    amount: 15,
    minimum_spend: 200,
    capped: 150,
    usage_limit: 100,
    maximum_redemptions: 1,
    start_date: "2024-08-16",
    end_date: "2024-08-20",
    applies_to: "total_amount",
});

const createModalShow = ref(false);
const viewModalShow = ref(false);
const deleteModalShow = ref(false);
const updateModalShow = ref(false);

const vouchers = ref([
    {
        voucher_id: 1,
        voucher_code: "SAVE10",
        description: "$10 off on orders over $50",
        type: "Fixed",
        amount: 10.0,
        min_spend: 50.0,
        capping: 100.0,
        usage_limit: 100,
        maximum_redemptions: 1,
        start_date: "2024-01-01 00:00",
        end_date: "2024-06-30 23:59",
        status: "expired",
        applies_to: "total_amount",
    },
    {
        voucher_id: 2,
        voucher_code: "WELCOME20",
        description: "$20 off on first purchase",
        type: "Fixed",
        amount: 20.0,
        min_spend: 100.0,
        capping: null,
        usage_limit: null,
        maximum_redemptions: 1,
        start_date: "2024-02-01 00:00",
        end_date: "2024-08-31 23:59",
        status: "ongoing",
        applies_to: "total_amount",
    },
    {
        voucher_id: 3,
        voucher_code: "SPRING15",
        description: "15% off sitewide (deducted from price)",
        type: "Percentage",
        amount: 15.0,
        min_spend: 0.0,
        capping: 50.0,
        usage_limit: 500,
        maximum_redemptions: null,
        start_date: "2024-03-01 00:00",
        end_date: "2024-04-30 23:59",
        status: "expired",
        applies_to: "total_amount",
    },
    {
        voucher_id: 4,
        voucher_code: "FREESHIP",
        description: "Free shipping on orders over $75",
        type: "Fixed",
        amount: 0.0,
        min_spend: 75.0,
        capping: null,
        usage_limit: null,
        maximum_redemptions: null,
        start_date: "2024-01-01 00:00",
        end_date: "2024-12-31 23:59",
        status: "ongoing",
        applies_to: "shipping_fee",
    },
    {
        voucher_id: 5,
        voucher_code: "HOLIDAY25",
        description: "$25 off on holiday items",
        type: "Fixed",
        amount: 25.0,
        min_spend: 30.0,
        capping: 200.0,
        usage_limit: 300,
        maximum_redemptions: 5,
        start_date: "2024-11-01 00:00",
        end_date: "2024-12-31 23:59",
        status: "pending",
        applies_to: "total_amount",
    },
    {
        voucher_id: 6,
        voucher_code: "NEWYEAR50",
        description: "$50 off on orders over $200",
        type: "Fixed",
        amount: 50.0,
        min_spend: 200.0,
        capping: null,
        usage_limit: null,
        maximum_redemptions: 1,
        start_date: "2024-12-01 00:00",
        end_date: "2025-01-05 23:59",
        status: "pending",
        applies_to: "total_amount",
    },
    {
        voucher_id: 7,
        voucher_code: "SUMMER10",
        description: "10% off summer collection (deducted from price)",
        type: "Percentage",
        amount: 10.0,
        min_spend: 0.0,
        capping: 25.0,
        usage_limit: 1000,
        maximum_redemptions: 1,
        start_date: "2024-06-01 00:00",
        end_date: "2024-08-31 23:59",
        status: "ongoing",
        applies_to: "total_amount",
    },
    {
        voucher_id: 8,
        voucher_code: "FLASHSALE30",
        description: "30% off on flash sale items (deducted from price)",
        type: "Percentage",
        amount: 30.0,
        min_spend: 0.0,
        capping: 75.0,
        usage_limit: 350,
        maximum_redemptions: 2,
        start_date: "2024-07-15 00:00",
        end_date: "2024-07-20 23:59",
        status: "expired",
        applies_to: "total_amount",
    },
    {
        voucher_id: 9,
        voucher_code: "VIP15",
        description: "$15 off for VIP members",
        type: "Fixed",
        amount: 15.0,
        min_spend: 50.0,
        capping: null,
        usage_limit: null,
        maximum_redemptions: 1,
        start_date: "2024-01-01 00:00",
        end_date: "2024-12-31 23:59",
        status: "ongoing",
        applies_to: "total_amount",
    },
    {
        voucher_id: 10,
        voucher_code: "CLEARANCE40",
        description: "$40 off clearance items",
        type: "Fixed",
        amount: 40.0,
        min_spend: 20.0,
        capping: 100.0,
        usage_limit: 1000,
        maximum_redemptions: 5,
        start_date: "2024-05-01 00:00",
        end_date: "2024-06-30 23:59",
        status: "expired",
        applies_to: "total_amount",
    },
    {
        voucher_id: 11,
        voucher_code: "DRAFTVOUCHER",
        description: "Draft voucher example",
        type: "Fixed",
        amount: 20.0,
        min_spend: 0.0,
        capping: null,
        usage_limit: 400,
        maximum_redemptions: 1,
        start_date: null,
        end_date: null,
        status: "draft",
        applies_to: "total_amount",
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
    { label: "Total Amount", value: "total_amount" },
    { label: "Shipping Fee", value: "shippping_fee" },
]);

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

const colorStatus = ref({
    draft: "bg-gray-200 text-black",
    pending: "bg-gray-500 text-white",
    ongoing: "bg-black dark:bg-slate-800 text-white",
    expired: "bg-red-500 text-white",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const nav = ref([
    {
        label: "Vouchers",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Voucher Details"
        maxWidth="lg"
        :show="viewModalShow"
        @close="viewModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="voucherCode"
                    value="Voucher Code"
                />
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
                    10% off summer collection (deducted from price)
                </label>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel value="Voucher Type" />
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
                        10
                    </label>
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel value="Minimum Spend" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        299
                    </label>
                </div>
                <div class="w-1/2">
                    <InputLabel value="Capped" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        100
                    </label>
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel value="Usage Limit" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        100
                    </label>
                </div>
                <div class="w-1/2">
                    <InputLabel value="Maximum Redemptions" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        1
                    </label>
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel value="Start Date" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        08/16/2024
                    </label>
                </div>
                <div class="w-1/2">
                    <InputLabel value="End Date" />
                    <label
                        class="block font-semibold text-md text-black dark:text-white mt-1"
                    >
                        08/20/2024
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <InputLabel value="Applies To" />
                <label
                    class="block font-semibold text-md text-black dark:text-white mt-1"
                >
                    Total Amount
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
        title="Create Voucher"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="voucherCode"
                    value="Voucher Code"
                    :required="true"
                />
                <TextInput
                    id="voucherCode"
                    type="text"
                    v-model="createForm.voucher_code"
                    placeholder="Enter voucher code"
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
                        for="voucherType"
                        value="Voucher Type"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="createForm.voucher_type"
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
                        for="usageLimit"
                        value="Usage Limit"
                    />
                    <TextInput
                        id="usageLimit"
                        type="number"
                        v-model="createForm.usage_limit"
                        placeholder="Enter usage limit"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="maxRedemptions"
                        value="Maximum Redemptions"
                    />
                    <TextInput
                        id="maxRedemptions"
                        type="number"
                        v-model="createForm.maximum_redemptions"
                        placeholder="Enter maximum redemptions"
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
                Are you sure you want to delete this voucher?
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
                class="bg-black dark:bg-custom-blue text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                @click="deleteModalShow = false"
            >
                YES
            </button>
        </div>
    </Modal>
    <Modal
        title="Update Voucher"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="voucherCode"
                    value="Voucher Code"
                    :required="true"
                />
                <TextInput
                    id="voucherCode"
                    type="text"
                    v-model="updateForm.voucher_code"
                    placeholder="Enter voucher code"
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
                        for="Voucher Type"
                        value="Voucher Type"
                        :required="true"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="updateForm.voucher_type"
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
                        for="usageLimit"
                        value="Usage Limit"
                    />
                    <TextInput
                        id="usageLimit"
                        type="number"
                        v-model="updateForm.usage_limit"
                        placeholder="Enter usage limit"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="maxRedemptions"
                        value="Maximum Redemptions"
                    />
                    <TextInput
                        id="maxRedemptions"
                        type="number"
                        v-model="updateForm.maximum_redemptions"
                        placeholder="Enter maximum redemptions"
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
    <Head title="Vouchers" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">VOUCHERS</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="voucherCode"
                        value="Voucher Code"
                    />
                    <TextInput
                        id="voucherCode"
                        type="text"
                        v-model="form.voucher_code"
                        placeholder="Enter voucher code"
                    />
                </div>
                <div>
                    <InputLabel
                        for="type"
                        value="Voucher Type"
                    />
                    <v-select
                        id="type"
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.voucher_type"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="typeOptions"
                    />
                </div>
                <div>
                    <InputLabel
                        for="appliesTo"
                        value="Applies To"
                    />
                    <v-select
                        id="appliesTo"
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
                        id="status"
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
                    CREATE VOUCHER
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="vouchers"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>ID</ColumnHeader>
                    <ColumnHeader sortKey="name">Voucher Code</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="voucher_type"
                    >
                        Voucher Type
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
                        sortKey="usage_limit"
                    >
                        Usage Limit
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
                    <RowColumn>{{ row.voucher_id }}</RowColumn>
                    <RowColumn>{{ row.voucher_code }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.type }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{
                            row.applies_to == "total_amount"
                                ? "Total Amount"
                                : "Shipping Fee"
                        }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.amount }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.usage_limit ?? "Unlimited" }}
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
