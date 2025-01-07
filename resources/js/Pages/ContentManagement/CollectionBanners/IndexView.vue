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

const updateModalShow = ref(false);

const updateForm = useForm({
    title: "ELEVATE YOUR STYLE",
    subtitle: "PREMIUM CLOTHING FOR WOMEN",
    image_url:
        "https://img.freepik.com/premium-photo/photograph-capturing-fashionable-women-with-bags-ai_431161-13818.jpg?size=626&ext=jpg&ga=GA1.1.1413502914.1697068800&semt=ais",
    status: "active",
});

const collectionBanners = ref([
    {
        id: 1,
        title: "ELEVATE YOUR STYLE",
        subtitle: "PREMIUM CLOTHING FOR WOMEN",
        button_label: "SHOP WOMEN",
        image_url:
            "https://img.freepik.com/premium-photo/photograph-capturing-fashionable-women-with-bags-ai_431161-13818.jpg?size=626&ext=jpg&ga=GA1.1.1413502914.1697068800&semt=ais",
        status: "active",
    },
    {
        id: 2,
        title: "UNLEASH YOUR CONFIDENCE",
        subtitle: "PREMIUM CLOTHING FOR MEN",
        button_label: "SHOP MEN",
        image_url:
            "https://media.istockphoto.com/id/906808234/photo/handsome-man.jpg?s=612x612&w=0&k=20&c=Ec8IY-ETslaS56vmO77BJyEOpPM1hzJlLbs6xeKRoAc=",
        status: "active",
    },
    {
        id: 3,
        title: "TRENDY KIDS WEAR",
        subtitle: "COMFORTABLE AND STYLISH CLOTHING",
        button_label: "SHOP KIDS",
        image_url:
            "https://t4.ftcdn.net/jpg/02/36/25/75/360_F_236257548_utLNKIOqHh9Uwpvdi9t69fzVAOLkzPVk.jpg",
        status: "active",
    },
    {
        id: 4,
        title: "STYLE YOUR HOME",
        subtitle: "FURNISHINGS THAT INSPIRE",
        button_label: "SHOP HOME",
        image_url:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW1tevlp8dgg78ytN0f1tbsfuY6DLUyQdJBQ&s",
        status: "inactive",
    },
]);

const pagination = ref({
    total: 4,
    count: 4,
    per_page: 10,
    current_page: 1,
    total_pages: 1,
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

const updateModal = () => {
    updateModalShow.value = true;
};

const nav = ref([
    {
        label: "Collection Banners",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Update Promo Banner"
        maxWidth="lg"
        :show="updateModalShow"
        @close="updateModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="BannerImage"
                    value="Banner Image"
                    :required="true"
                    specialClass="mb-2"
                />
                <div
                    class="relative bg-gray-100 text-center items-center rounded-2xl cursor-pointer w-full h-42 flex items-center"
                >
                    <div class="w-full rounded-2xl overflow-hidden">
                        <img
                            :src="updateForm.image_url"
                            class="w-full h-42 object-cover"
                        />
                    </div>
                    <button
                        class="absolute top-[-15px] right-[-5px] inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-500 rounded-full"
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
                    for="title"
                    value="Title"
                />
                <TextInput
                    id="title"
                    type="text"
                    v-model="updateForm.title"
                    placeholder="Enter title"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="subtitle"
                    value="Sub Title"
                />
                <TextInput
                    id="subtitle"
                    type="text"
                    v-model="updateForm.subtitle"
                    placeholder="Enter sub title"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="actionLabel"
                    value="Action Label"
                />
                <TextInput
                    id="actionLabel"
                    type="text"
                    v-model="updateForm.action_label"
                    placeholder="Enter action label"
                />
            </div>
            <div>
                <InputLabel
                    for="status"
                    value="Status"
                />
                <v-select
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
    <Head title="Collection Banners" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                COLLECTION BANNERS
            </h1>
            <Table
                :data="collectionBanners"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="title">Banner Title</ColumnHeader>
                    <ColumnHeader sortKey="subtitle">
                        Banner SubTitle
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="image_url"
                    >
                        Banner Image
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="action_label"
                    >
                        Action Label
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
                    <RowColumn>{{ row.title }}</RowColumn>
                    <RowColumn>
                        {{ row.subtitle }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <img
                            :src="row.image_url"
                            :alt="row.banner_name"
                            class="w-full h-24 object-cover"
                        />
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.button_label }}
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
