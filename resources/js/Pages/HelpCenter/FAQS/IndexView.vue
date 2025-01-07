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

const updateStatus = useForm({
    status: "open",
});
const updateModalShow = ref(false);

const faqs = ref([
    {
        faq_id: "1",
        question: "How can I track my order?",
        category: "Shipping and Delivery",
        status: "published",
        sort_order: 1,
        date_created: "2024-01-15 08:30:00",
    },
    {
        faq_id: "2",
        question: "What is your return policy?",
        category: "Returns Policies",
        status: "published",
        sort_order: 2,
        date_created: "2024-01-16 09:00:00",
    },
    {
        faq_id: "3",
        question: "How can I change my payment method?",
        category: "Payment and Billing",
        status: "draft",
        sort_order: 3,
        date_created: "2024-01-17 10:15:00",
    },
    {
        faq_id: "4",
        question: "Do you offer international shipping?",
        category: "Shipping and Delivery",
        status: "published",
        sort_order: 4,
        date_created: "2024-01-18 11:00:00",
    },
    {
        faq_id: "5",
        question: "How do I reset my password?",
        category: "Account and Login",
        status: "published",
        sort_order: 5,
        date_created: "2024-01-19 12:30:00",
    },
    {
        faq_id: "6",
        question: "Can I cancel my order after it's placed?",
        category: "Order",
        status: "archived",
        sort_order: 6,
        date_created: "2024-01-20 13:45:00",
    },
    {
        faq_id: "7",
        question: "How can I contact customer support?",
        category: "Customer Service",
        status: "published",
        sort_order: 7,
        date_created: "2024-01-21 14:00:00",
    },
    {
        faq_id: "8",
        question: "What do I do if I receive a damaged item?",
        category: "Returns Policies",
        status: "published",
        sort_order: 8,
        date_created: "2024-01-22 15:30:00",
    },
    {
        faq_id: "9",
        question: "Do you offer gift cards?",
        category: "Payment and Billing",
        status: "draft",
        sort_order: 9,
        date_created: "2024-01-23 16:00:00",
    },
    {
        faq_id: "10",
        question: "How can I update my shipping address?",
        category: "Shipping and Delivery",
        status: "published",
        sort_order: 10,
        date_created: "2024-01-24 17:30:00",
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
    { label: "Published", value: "published" },
    { label: "Unpublished", value: "unpublished" },
]);

const categoryOptions = ref([
    { label: "All", value: null },
    { label: "Account and Login", value: "account-and-login" },
    { label: "Customer Service", value: "customer-service" },
    { label: "Order", value: "order" },
    { label: "Payment and Billing", value: "payment-and-billing" },
    { label: "Product", value: "product" },
    { label: "Promotion and Discount", value: "promotion-and-discount" },
    { label: "Returns Policies", value: "returns-policies" },
    { label: "Shipping and Delivery", value: "shipping-delivery" },
    { label: "Technical Support", value: "technical-support" },
]);

const colorStatus = ref({
    draft: "bg-gray-200 text-black",
    published: "bg-black text-white",
    unpublished: "bg-gray-500 text-white",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const navigateToCreateFaq = () => {
    window.location.href = "/help-center/faqs/create-faq";
};

const navigateToUpdateFaq = () => {
    window.location.href = "/help-center/faqs/update-faq";
};

const updateModal = () => {
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "FAQS",
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
                    :options="
                        statusOptions.filter((option) => option.value !== null)
                    "
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
    <Head title="FAQs" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">FAQs</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="ticketId"
                        value="Ticket ID"
                    />
                    <TextInput
                        id="ticketId"
                        type="text"
                        v-model="form.ticket_id"
                        placeholder="Ticket ID"
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
                    class="bg-black dark:bg-custom-blue text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                >
                    SEARCH
                    <Icon
                        icon="iconoir:search"
                        class="ml-2"
                    />
                </button>
                <button
                    class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-between"
                    @click="navigateToCreateFaq"
                >
                    CREATE FAQ
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="faqs"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader sortKey="faq_id">FAQ ID</ColumnHeader>
                    <ColumnHeader sortKey="question">Question</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="category"
                    >
                        Category
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="sort_order"
                    >
                        Sort Order
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="status"
                    >
                        Status
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="date_created"
                    >
                        Date Created
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row }">
                    <RowColumn>{{ row.faq_id }}</RowColumn>
                    <RowColumn>{{ row.question }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.category }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.sort_order }}
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
                        {{ row.date_created }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <div class="flex justify-center gap-x-4">
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="navigateToUpdateFaq"
                            >
                                <Icon
                                    icon="mynaui:edit-one"
                                    class="text-xs"
                                />
                            </button>
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="updateModal"
                            >
                                <Icon
                                    icon="mdi:check"
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
