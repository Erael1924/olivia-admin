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
    name: null,
    status: null,
});

const updateStatus = useForm({
    status: "published",
});
const updateModalShow = ref(false);

const emailTemplates = ref([
    {
        id: 1,
        name: "Welcome Email",
        description: "Email sent to new users upon registration.",
        status: "published",
        date_created: "2024-01-10 08:30:00",
        last_updated: "2024-01-12 09:00:00",
        updated_by: "Alice Johnson",
        version: 1,
    },
    {
        id: 2,
        name: "Password Reset",
        description: "Email sent when a user requests to reset their password.",
        status: "published",
        date_created: "2024-01-15 09:45:00",
        last_updated: "2024-01-16 10:15:00",
        updated_by: "Bob Smith",
        version: 2,
    },
    {
        id: 3,
        name: "Order Confirmation",
        description: "Confirmation email sent after a purchase.",
        status: "draft",
        date_created: "2024-02-01 10:00:00",
        last_updated: "2024-02-02 11:00:00",
        updated_by: "Charlie Davis",
        version: 1,
    },
    {
        id: 4,
        name: "Monthly Newsletter",
        description: "Monthly updates and news sent to subscribers.",
        status: "published",
        date_created: "2024-03-01 11:15:00",
        last_updated: "2024-03-02 12:00:00",
        updated_by: "Diana Martinez",
        version: 3,
    },
    {
        id: 5,
        name: "Account Suspension",
        description: "Notification email for account suspension.",
        status: "unpublished",
        date_created: "2024-04-05 12:30:00",
        last_updated: "2024-04-07 13:00:00",
        updated_by: "Eve Lewis",
        version: 1,
    },
    {
        id: 6,
        name: "Feedback Request",
        description:
            "Email requesting feedback after a purchase or interaction.",
        status: "published",
        date_created: "2024-04-20 13:45:00",
        last_updated: "2024-04-22 14:15:00",
        updated_by: "Frank Wilson",
        version: 2,
    },
    {
        id: 7,
        name: "Appointment Reminder",
        description: "Reminder email for upcoming appointments.",
        status: "draft",
        date_created: "2024-05-10 14:00:00",
        last_updated: "2024-05-11 15:00:00",
        updated_by: "Grace Lee",
        version: 1,
    },
    {
        id: 8,
        name: "Promotional Offer",
        description:
            "Email sent with special promotional offers and discounts.",
        status: "published",
        date_created: "2024-06-01 15:15:00",
        last_updated: "2024-06-03 16:00:00",
        updated_by: "Hannah Young",
        version: 4,
    },
    {
        id: 9,
        name: "Survey Invitation",
        description: "Email inviting users to participate in a survey.",
        status: "unpublished",
        date_created: "2024-06-15 16:30:00",
        last_updated: "2024-06-17 17:00:00",
        updated_by: "Ian Thompson",
        version: 1,
    },
    {
        id: 10,
        name: "Thank You Note",
        description:
            "A thank you note sent after a successful transaction or interaction.",
        status: "published",
        date_created: "2024-07-01 17:45:00",
        last_updated: "2024-07-02 18:00:00",
        updated_by: "Judy Adams",
        version: 2,
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

const colorStatus = ref({
    draft: "bg-gray-200 text-black",
    published: "bg-black text-white",
    unpublished: "bg-gray-500 text-white",
});

const capitalizeFirstLetter = (str) => {
    if (!str) return "";
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const navigateToCreateEmailTemplate = () => {
    window.location.href =
        "/content-management/email-templates/create-email-template";
};

const navigateToEditEmailTemplate = () => {
    window.location.href =
        "/content-management/email-templates/edit-email-template";
};

const updateModal = () => {
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Email Templates",
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
    <Head title="Email Templates" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                Email Templates
            </h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="name"
                        value="Template Name"
                    />
                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        placeholder="Enter template name"
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
                    @click="navigateToCreateEmailTemplate"
                >
                    CREATE EMAIL TEMPLATE
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="emailTemplates"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="name">Template Name</ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="description"
                    >
                        Description
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
                        sortKey="updated_by"
                    >
                        Updated By
                    </ColumnHeader>
                    <ColumnHeader customClass="flex justify-center">
                        Action
                    </ColumnHeader>
                </template>
                <Row v-slot="{ row, index }">
                    <RowColumn>{{ index + 1 }}</RowColumn>
                    <RowColumn>{{ row.name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.description }}
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
                        {{ row.updated_by }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <div class="flex justify-center gap-x-4">
                            <button
                                type="button"
                                class="border-none bg-none"
                                @click="navigateToEditEmailTemplate"
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
