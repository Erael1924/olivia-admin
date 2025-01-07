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
    payment_method_name: null,
    payment_gateway: null,
    type: null,
    status: null,
});

const createForm = useForm({
    payment_method_name: null,
    payment_gateway: null,
    logo: null,
    type: null,
    transaction_fees: null,
    status: null,
});

const updateForm = useForm({
    id: "1",
    payment_method_name: "Credit Card",
    payment_gateway: "Stripe",
    logo: "https://i.pngimg.me/thumb/f/720/comdlpng6953127.jpg",
    type: "Credit Card",
    transaction_fees: "2.9",
    status: "active",
});

const createModalShow = ref(false);
const updateModalShow = ref(false);

const paymentMethods = ref([
    {
        id: "1",
        payment_method_name: "Credit Card",
        payment_gateway: "Stripe",
        logo: "https://i.pngimg.me/thumb/f/720/comdlpng6953127.jpg",
        type: "Credit Card",
        transaction_fees: "2.9",
        status: "active",
        date_created: "2024-01-10",
    },
    {
        id: "2",
        payment_method_name: "PayPal",
        payment_gateway: "PayPal",
        logo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFvmekC8ZMwaUuf-icSP8JSiPYIXsVf0blTQ&s",
        type: "Digital Wallet",
        transaction_fees: "2.9",
        status: "active",
        date_created: "2024-01-12",
    },
    {
        id: "3",
        payment_method_name: "Bank Transfer",
        payment_gateway: "Manual",
        logo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3R7XjefzufRARnoO_cmv-cGiJU3bcg4L3Gw&s",
        type: "Bank Transfer",
        transaction_fees: "0.0",
        status: "active",
        date_created: "2024-01-15",
    },
    {
        id: "4",
        payment_method_name: "Apple Pay",
        payment_gateway: "Stripe",
        logo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWxYUQvdwKXZ9meVu4Jx6fr7nNNo99TLl-bA&s",
        type: "Digital Wallet",
        transaction_fees: "2.9",
        status: "active",
        date_created: "2024-01-18",
    },
    {
        id: "5",
        payment_method_name: "Google Pay",
        payment_gateway: "Stripe",
        logo: "https://1000logos.net/wp-content/uploads/2023/03/Google-Pay-logo.png",
        type: "Digital Wallet",
        transaction_fees: "2.9",
        status: "active",
        date_created: "2024-01-20",
    },
    {
        id: "6",
        payment_method_name: "Amazon Pay",
        payment_gateway: "Amazon Pay",
        logo: "https://static.vecteezy.com/system/resources/previews/014/018/563/non_2x/amazon-logo-on-transparent-background-free-vector.jpg",
        type: "Digital Wallet",
        transaction_fees: "2.9",
        status: "inactive",
        date_created: "2024-01-22",
    },
    {
        id: "7",
        payment_method_name: "Bitcoin",
        payment_gateway: "Coinbase",
        logo: "https://images.vexels.com/media/users/3/144838/isolated/preview/0e8ecc882dcf98521ef01d2163416fc9-bitcoin-logo.png?w=360",
        type: "Cryptocurrency",
        transaction_fees: "1.49",
        status: "active",
        date_created: "2024-01-25",
    },
    {
        id: "8",
        payment_method_name: "Afterpay",
        payment_gateway: "Afterpay",
        logo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjCaHPlsOI36LrUuBjBfuGEv5tFvO9s62d9A&s",
        type: "Buy Now, Pay Later",
        transaction_fees: "6.0",
        status: "active",
        date_created: "2024-01-27",
    },
    {
        id: "9",
        payment_method_name: "Klarna",
        payment_gateway: "Klarna",
        logo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRU9p7exzQMMgsZ10etTPtkkT-UxVnMRiP00Q&s",
        type: "Buy Now, Pay Later",
        transaction_fees: "3.29",
        status: "inactive",
        date_created: "2024-01-30",
    },
    {
        id: "10",
        payment_method_name: "Alipay",
        payment_gateway: "Alipay",
        logo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlhhajHYb9U7e72vjKH_uzdTpC21eyossIEA&s",
        type: "Digital Wallet",
        transaction_fees: "2.8",
        status: "active",
        date_created: "2024-02-01",
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
    { label: "Inactive", value: "inactive" },
]);

const typeOptions = ref([
    { label: "All", value: null },
    { label: "Bank Transfer", value: "Bank Transfer" },
    { label: "Buy Now, Pay Later", value: "Buy Now, Pay Later" },
    { label: "Credit Card", value: "Credit Card" },
    { label: "Digital Wallet", value: "Digital Wallet" },
    { label: "Cryptocurrency", value: "Cryptocurrency" },
]);

const colorStatus = ref({
    active: "bg-black dark:bg-slate-800 text-white",
    inactive: "bg-gray-500 text-white",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const createModal = () => {
    createModalShow.value = true;
};

const updateModal = () => {
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Payment Methods",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Create Payment Method"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="Logo"
                    value="Logo"
                    :required="true"
                    specialClass="mb-1"
                />
                <div
                    class="bg-gray-100 dark:bg-slate-700 p-10 text-center items-center rounded-2xl cursor-pointer w-full h-28 flex items-center"
                >
                    <div class="w-full">
                        <Icon
                            icon="solar:cloud-upload-outline"
                            class="mx-auto mb-4 text-[28px] text-black dark:text-white"
                        />
                        <span
                            class="text-black dark:text-white block font-bold text-sm"
                        >
                            Drop files here or click to upload
                        </span>
                        <span
                            class="text-gray-600 dark:text-neutral-400 text-xs"
                        >
                            Only JPEG and PNG with a size of 2000KB
                        </span>
                        <input
                            accept=".jpeg, .png, .jpg"
                            hidden
                            type="file"
                        />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <InputLabel
                    for="paymentMethodName"
                    value="Payment Method Name"
                    :required="true"
                />
                <TextInput
                    id="paymentMethodName"
                    type="text"
                    v-model="createForm.payment_method_name"
                    placeholder="Enter payment method name"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="paymentGateway"
                    value="Payment Gateway"
                    :required="true"
                />
                <TextInput
                    id="paymentGateway"
                    type="text"
                    v-model="createForm.payment_gateway"
                    placeholder="Enter payment gateway"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <InputLabel
                    for="type"
                    value="Type"
                    :required="true"
                />
                <v-select
                    id="type"
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="createForm.type"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        typeOptions.filter((option) => option.value !== null)
                    "
                />
            </div>

            <div class="mb-3">
                <InputLabel
                    for="transactionFees"
                    value="Transaction Fees"
                    :required="true"
                />
                <TextInput
                    id="transactionFees"
                    type="number"
                    v-model="createForm.transaction_fees"
                    placeholder="Enter transaction fees"
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
        title="Update Payment Method"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="Logo"
                    value="Logo"
                    :required="true"
                    specialClass="mb-2"
                />
                <div
                    class="relative bg-gray-100 dark:bg-slate-700 text-center items-center rounded-2xl cursor-pointer w-full h-48 flex items-center"
                >
                    <div class="w-full rounded-2xl overflow-hidden">
                        <img
                            :src="updateForm.logo"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <button
                        class="absolute top-[-10px] right-[-5px] inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-500 rounded-full"
                    >
                        <Icon
                            icon="iconamoon:close-light"
                            class="text-lg text-white"
                        />
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <InputLabel
                    for="paymentMethodName"
                    value="Payment Method Name"
                    :required="true"
                />
                <TextInput
                    id="paymentMethodName"
                    type="text"
                    v-model="updateForm.payment_method_name"
                    placeholder="Enter payment method name"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="paymentGateway"
                    value="Payment Gateway"
                    :required="true"
                />
                <TextInput
                    id="paymentGateway"
                    type="text"
                    v-model="updateForm.payment_gateway"
                    placeholder="Enter payment gateway"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <InputLabel
                    for="type"
                    value="Type"
                    :required="true"
                />
                <v-select
                    id="type"
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="createForm.type"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        typeOptions.filter((option) => option.value !== null)
                    "
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="transactionFees"
                    value="Transaction Fees"
                    :required="true"
                />
                <TextInput
                    id="transactionFees"
                    type="number"
                    v-model="updateForm.transaction_fees"
                    placeholder="Enter transaction fees"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="status"
                    value="Status"
                />
                <v-select
                    id="status"
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="updateForm.status"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        statusOptions.filter((option) => option.value !== null)
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
    <Head title="Payment Methods" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                PAYMENT METHODS
            </h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="paymentMethodName"
                        value="Payment Method Name"
                    />
                    <TextInput
                        id="paymentMethodName"
                        type="text"
                        v-model="form.payment_method_name"
                        placeholder="Enter payment method name"
                    />
                </div>
                <div>
                    <InputLabel
                        for="paymentGateway"
                        value="Payment Gateway"
                    />
                    <TextInput
                        id="paymentGateway"
                        type="text"
                        v-model="form.payment_gateway"
                        placeholder="Enter payment gateway"
                    />
                </div>
                <div>
                    <InputLabel
                        for="type"
                        value="Type"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.type"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="typeOptions"
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
                    @click="createModal"
                >
                    CREATE PAYMENT METHOD
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="paymentMethods"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="payment_method_name">
                        Payment Method Name
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="payment_gateway"
                    >
                        Payment Gateway
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="type"
                    >
                        Type
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="logo"
                    >
                        Logo
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="transaction_fees"
                    >
                        Transaction Fees
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
                    <RowColumn>{{ row.payment_method_name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.payment_gateway }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.type }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <img
                            :src="row.logo"
                            :alt="row.payment_method_name"
                            class="w-28 h-full object-cover"
                        />
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.transaction_fees }}
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
                    </RowColumn>
                </Row>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>
