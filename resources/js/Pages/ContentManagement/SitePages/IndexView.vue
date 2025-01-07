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
    page_title: null,
    page_type: null,
    status: null,
});

const updateStatus = useForm({
    status: "published",
});

const updateModalShow = ref(false);

const pages = ref([
    {
        page_title: "Home",
        page_slug: "home",
        page_type: "Static",
        status: "published",
        date_created: "2024-01-01 08:00",
        last_updated: "2024-08-15 10:30",
        author: "Admin",
    },
    {
        page_title: "About Us",
        page_slug: "about-us",
        page_type: "Static",
        status: "published",
        date_created: "2024-01-05 09:00",
        last_updated: "2024-08-18 14:00",
        author: "Admin",
    },
    {
        page_title: "Privacy Policy",
        page_slug: "privacy-policy",
        page_type: "Legal",
        status: "draft",
        date_created: "2024-01-10 10:00",
        last_updated: "2024-08-12 16:00",
        author: "Admin",
    },
    {
        page_title: "Terms and Conditions",
        page_slug: "terms-conditions",
        page_type: "Legal",
        status: "published",
        date_created: "2024-01-15 11:00",
        last_updated: "2024-08-15 12:00",
        author: "Admin",
    },
    {
        page_title: "Contact Us",
        page_slug: "contact-us",
        page_type: "Static",
        status: "published",
        date_created: "2024-02-01 08:30",
        last_updated: "2024-08-10 09:00",
        author: "Admin",
    },
    {
        page_title: "FAQs",
        page_slug: "faqs",
        page_type: "Static",
        status: "unpublished",
        date_created: "2024-02-10 07:00",
        last_updated: "2024-07-01 12:00",
        author: "Admin",
    },
    {
        page_title: "Shipping Information",
        page_slug: "shipping-information",
        page_type: "Static",
        status: "published",
        date_created: "2024-02-15 10:00",
        last_updated: "2024-08-05 15:00",
        author: "Admin",
    },
    {
        page_title: "Returns Policy",
        page_slug: "returns-policy",
        page_type: "Legal",
        status: "draft",
        date_created: "2024-03-01 09:30",
        last_updated: "2024-08-20 11:00",
        author: "Admin",
    },
    {
        page_title: "Site Map",
        page_slug: "site-map",
        page_type: "Static",
        status: "published",
        date_created: "2024-03-10 08:00",
        last_updated: "2024-08-18 10:00",
        author: "Admin",
    },
    {
        page_title: "Press Releases",
        page_slug: "press-releases",
        page_type: "Static",
        status: "unpublished",
        date_created: "2024-03-15 12:00",
        last_updated: "2024-06-30 13:00",
        author: "Admin",
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

const pageTypeOptions = ref([
    { label: "All", value: null },
    { label: "Static", value: "static" },
    { label: "Legal", value: "legal" },
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

const navigateToCreateSitePage = () => {
    window.location.href = "/content-management/site-pages/create-site-page";
};

const navigateToEditSitePage = () => {
    window.location.href = "/content-management/site-pages/update-site-page";
};

const updateModal = () => {
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Site Pages",
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
    <Head title="Site Pages" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">SITE PAGES</h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="pageTitle"
                        value="Page Title"
                    />
                    <TextInput
                        id="pageTitle"
                        type="text"
                        v-model="form.page_title"
                        placeholder="Page Title"
                    />
                </div>
                <div>
                    <InputLabel
                        for="type"
                        value="Page Type"
                    />
                    <v-select
                        class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                        v-model="form.page_type"
                        :get-option-label="(option) => option.label"
                        :reduce="(option) => option.value"
                        :clearable="false"
                        :options="pageTypeOptions"
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
                    @click="navigateToCreateSitePage"
                >
                    CREATE SITE PAGE
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="pages"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="page_title">Page Title</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="page_slug"
                    >
                        Page Slug
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="page_type"
                    >
                        Page Type
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
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="last_updated"
                    >
                        Last Updated
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="author"
                    >
                        Author
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row, index }">
                    <RowColumn>{{ index + 1 }}</RowColumn>
                    <RowColumn>{{ row.page_title }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.page_slug }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.page_type }}
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
                        {{ row.last_updated }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.author }}
                    </RowColumn>

                    <RowColumn customClass="text-center">
                        <div class="flex justify-center gap-x-4">
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="navigateToEditSitePage"
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
