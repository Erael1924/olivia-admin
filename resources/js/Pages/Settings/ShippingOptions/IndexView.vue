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

const createForm = useForm({
    id: null,
    shipping_option_name: null,
    carrier: null,
    service_level: null,
    estimated_delivery_time: null,
    handling_fee: null,
    status: null,
    international_shipping: false,
});

const updateForm = useForm({
    id: "1",
    shipping_option_name: "Standard Shipping",
    carrier: "USPS",
    service_level: "Ground",
    estimated_delivery_time: "5-7 business days",
    handling_fee: 0.0,
    status: "active",
    international_shipping: false,
});

const createModalShow = ref(false);
const updateModalShow = ref(false);

const shippingOptions = ref([
    {
        id: "1",
        shipping_option_name: "Standard Shipping",
        carrier: "USPS",
        service_level: "Ground",
        estimated_delivery_time: "5-7 business days",
        handling_fee: 0.0,
        status: "active",
        international_shipping: false,
    },
    {
        id: "2",
        shipping_option_name: "Express Shipping",
        carrier: "FedEx",
        service_level: "Overnight",
        estimated_delivery_time: "1 business day",
        handling_fee: 15.0,
        status: "active",
        international_shipping: false,
    },
    {
        id: "3",
        shipping_option_name: "Two-Day Shipping",
        carrier: "UPS",
        service_level: "Two-Day Air",
        estimated_delivery_time: "2 business days",
        handling_fee: 7.5,
        status: "active",
        international_shipping: false,
    },
    {
        id: "4",
        shipping_option_name: "International Standard",
        carrier: "DHL",
        service_level: "Economy",
        estimated_delivery_time: "7-14 business days",
        handling_fee: 25.0,
        status: "active",
        international_shipping: true,
    },
    {
        id: "5",
        shipping_option_name: "International Express",
        carrier: "FedEx",
        service_level: "International Priority",
        estimated_delivery_time: "3-5 business days",
        handling_fee: 40.0,
        status: "active",
        international_shipping: true,
    },
    {
        id: "6",
        shipping_option_name: "Local Delivery",
        carrier: "Local Courier",
        service_level: "Same Day",
        estimated_delivery_time: "Same day",
        handling_fee: 10.0,
        status: "active",
        international_shipping: false,
    },
    {
        id: "7",
        shipping_option_name: "Economy Shipping",
        carrier: "USPS",
        service_level: "Economy",
        estimated_delivery_time: "7-10 business days",
        handling_fee: 3.0,
        status: "inactive",
        international_shipping: false,
    },
    {
        id: "8",
        shipping_option_name: "Priority Mail",
        carrier: "USPS",
        service_level: "Priority",
        estimated_delivery_time: "2-3 business days",
        handling_fee: 6.0,
        status: "active",
        international_shipping: false,
    },
    {
        id: "9",
        shipping_option_name: "Freight Shipping",
        carrier: "Freight Carrier",
        service_level: "Freight",
        estimated_delivery_time: "10-15 business days",
        handling_fee: 50.0,
        status: "active",
        international_shipping: true,
    },
    {
        id: "10",
        shipping_option_name: "Same Day Shipping",
        carrier: "Courier Express",
        service_level: "Same Day",
        estimated_delivery_time: "Same day",
        handling_fee: 20.0,
        status: "active",
        international_shipping: false,
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
        label: "Shipping Options",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Create Shipping Option"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="shippingOptionName"
                    value="Shipping Option Name"
                    :required="true"
                />
                <TextInput
                    id="shippingOptionName"
                    type="text"
                    v-model="createForm.shipping_option_name"
                    placeholder="Enter shipping option name"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="carrier"
                    value="Carrier"
                    :required="true"
                />
                <TextInput
                    id="carrier"
                    type="text"
                    v-model="createForm.carrier"
                    placeholder="Enter carrier"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <InputLabel
                    for="serviceLevel"
                    value="Service Level"
                    :required="true"
                />
                <TextInput
                    id="serviceLevel"
                    type="text"
                    v-model="createForm.service_level"
                    placeholder="Enter service level"
                />
            </div>

            <div class="mb-5 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="estimatedDeliveryTime"
                        value="Estimated Delivery Time"
                        :required="true"
                    />
                    <TextInput
                        id="estimatedDeliveryTime"
                        type="text"
                        v-model="createForm.estimated_delivery_time"
                        placeholder="Enter estimated delivery time"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="handlingFee"
                        value="Handling Fee"
                        :required="true"
                    />
                    <TextInput
                        id="handlingFee"
                        type="number"
                        v-model="createForm.handling_fee"
                        placeholder="Enter handling fee"
                    />
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <input
                    id="internationalShipping"
                    type="checkbox"
                    v-model="createForm.international_shipping"
                />
                <InputLabel
                    specialClass="ml-3"
                    for="internationalShipping"
                    value="International Shipping"
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
        title="Update Shipping Option"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="shippingOptionName"
                    value="Shipping Option Name"
                    :required="true"
                />
                <TextInput
                    id="shippingOptionName"
                    type="text"
                    v-model="updateForm.shipping_option_name"
                    placeholder="Enter shipping option name"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="carrier"
                    value="Carrier"
                    :required="true"
                />
                <TextInput
                    id="carrier"
                    type="text"
                    v-model="updateForm.carrier"
                    placeholder="Enter carrier"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <InputLabel
                    for="serviceLevel"
                    value="Service Level"
                    :required="true"
                />
                <TextInput
                    id="serviceLevel"
                    type="text"
                    v-model="updateForm.service_level"
                    placeholder="Enter service level"
                />
            </div>

            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="estimatedDeliveryTime"
                        value="Estimated Delivery Time"
                        :required="true"
                    />
                    <TextInput
                        id="estimatedDeliveryTime"
                        type="text"
                        v-model="updateForm.estimated_delivery_time"
                        placeholder="Enter estimated delivery time"
                    />
                </div>
                <div class="w-1/2">
                    <InputLabel
                        for="handlingFee"
                        value="Handling Fee"
                        :required="true"
                    />
                    <TextInput
                        id="handlingFee"
                        type="number"
                        v-model="updateForm.handling_fee"
                        placeholder="Enter handling fee"
                    />
                </div>
            </div>
            <div class="mb-5">
                <InputLabel
                    for="status"
                    value="Status"
                />
                <v-select
                    id="status"
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="createForm.status"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="
                        statusOptions.filter((option) => option.value !== null)
                    "
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <input
                    id="internationalShipping"
                    type="checkbox"
                    v-model="updateForm.international_shipping"
                />
                <InputLabel
                    specialClass="ml-3"
                    for="internationalShipping"
                    value="International Shipping"
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
    <Head title="Shipping Options" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                Shipping Options
            </h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="shippingOptionName"
                        value="Shipping Option Name"
                    />
                    <TextInput
                        id="shippingOptionName"
                        type="text"
                        v-model="form.shipping_option_name"
                        placeholder="Enter shipping option name"
                    />
                </div>
                <div>
                    <InputLabel
                        for="carrierName"
                        value="Carrier Name"
                    />
                    <TextInput
                        id="carrierName"
                        type="text"
                        v-model="form.carrier_name"
                        placeholder="Enter carrier name"
                    />
                </div>
                <div>
                    <InputLabel
                        for="serviceLevel"
                        value="Service Level"
                    />
                    <TextInput
                        id="serviceLevel"
                        type="text"
                        v-model="form.service_level"
                        placeholder="Enter service level"
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
                    CREATE SHIPPING OPTION
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="shippingOptions"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader sortKey="shipping_option_id">#</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="shipping_option_name"
                    >
                        Shipping Option Name
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="carrier"
                    >
                        Carrier
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="service_level"
                    >
                        Service Level
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="estimated_delivery_time"
                    >
                        Estimated Delivery Time
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="handling_fee"
                    >
                        Handling Fee
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="international_shipping"
                    >
                        International Shipping
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
                    <RowColumn>{{ row.shipping_option_name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.carrier }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.service_level }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.estimated_delivery_time }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.handling_fee }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.international_shipping ? "Yes" : "No" }}
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
