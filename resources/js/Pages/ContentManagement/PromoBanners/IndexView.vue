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

const createModalShow = ref(false);
const updateModalShow = ref(false);

const statusOptions = ref([
    { label: "All", value: null },
    { label: "Active", value: "active" },
    { label: "Inactive", value: "inactive" },
]);

const colorStatus = ref({
    active: "bg-black dark:bg-slate-800 text-white",
    inactive: "bg-gray-500 text-white",
});

const form = useForm({
    name: null,
    status: null,
});

const createForm = useForm({
    banner_name: null,
    link_url: null,
    image_url: null,
    start_date: null,
    end_date: null,
});

const updateForm = useForm({
    banner_name: "Summer Sale",
    link_url: "https://example.com/summer-sale",
    image_url:
        "https://i.pinimg.com/originals/75/1d/2b/751d2b30f041d6a7ec336dbdef797311.jpg",
    start_date: "2024-06-01 00:00:00",
    end_date: "2024-06-05 00:00:00",
});

const promoBanners = ref([
    {
        id: 1,
        banner_name: "Summer Sale",
        image_url:
            "https://i.pinimg.com/originals/75/1d/2b/751d2b30f041d6a7ec336dbdef797311.jpg",
        link_url: "https://example.com/summer-sale",
        start_date: "2024-06-01 00:00:00",
        end_date: "2024-06-30 23:59:59",
        display_order: 1,
        date_created: "2024-05-15 08:30:00",
        status: "active",
    },
    {
        id: 2,
        banner_name: "Winter Clearance",
        image_url:
            "https://t4.ftcdn.net/jpg/03/67/56/73/360_F_367567354_JnT96QOWu8rugfLdYaESxWkqaIOUja8t.jpg",
        link_url: "https://example.com/winter-clearance",
        start_date: "2024-12-01 00:00:00",
        end_date: "2024-12-31 23:59:59",
        display_order: 2,
        date_created: "2024-11-01 09:00:00",
        status: "inactive",
    },
    {
        id: 3,
        banner_name: "Black Friday Deals",
        image_url:
            "https://static.vecteezy.com/system/resources/thumbnails/004/299/806/small/online-shopping-on-phone-buy-sell-business-digital-web-banner-application-money-advertising-payment-ecommerce-illustration-search-vector.jpg",
        link_url: "https://example.com/black-friday",
        start_date: "2024-11-24 00:00:00",
        end_date: "2024-11-24 23:59:59",
        display_order: 3,
        date_created: "2024-10-20 10:15:00",
        status: "active",
    },
    {
        id: 4,
        banner_name: "New Arrivals",
        image_url:
            "https://static.vecteezy.com/system/resources/previews/003/543/603/non_2x/paper-art-shopping-online-on-smartphone-and-new-buy-sale-promotion-pink-backgroud-for-banner-market-ecommerce-women-concept-free-vector.jpg",
        link_url: "https://example.com/new-arrivals",
        display_order: 4,
        date_created: "2024-08-01 11:00:00",
        status: "inactive",
    },
    {
        id: 5,
        banner_name: "Holiday Specials",
        image_url:
            "https://static.vecteezy.com/system/resources/previews/015/614/507/non_2x/online-shopping-on-phone-buy-sell-business-digital-web-banner-application-money-advertising-payment-ecommerce-illustration-search-podium-vector.jpg",
        link_url: "https://example.com/holiday-specials",
        start_date: "2024-12-15 00:00:00",
        end_date: "2024-12-25 23:59:59",
        display_order: 5,
        date_created: "2024-11-15 12:30:00",
        status: "active",
    },
    {
        id: 6,
        banner_name: "Back to School",
        image_url:
            "https://static.vecteezy.com/system/resources/thumbnails/004/707/506/small/online-shopping-on-phone-buy-sell-business-digital-web-banner-application-money-advertising-payment-ecommerce-illustration-search-vector.jpg",
        link_url: "https://example.com/back-to-school",
        start_date: "2024-08-01 00:00:00",
        end_date: "2024-08-31 23:59:59",
        display_order: 6,
        date_created: "2024-07-10 13:00:00",
        status: "active",
    },
    {
        id: 7,
        banner_name: "Valentine's Day",
        image_url:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMn1PCo4QTFWeaPKo6GpAZW1Tp8cDB24uVORP0lIZl8GzWsQAVRNDopBQ4yBXrgHaM1g&usqp=CAU",
        link_url: "https://example.com/valentines-day",
        start_date: "2024-02-01 00:00:00",
        end_date: "2024-02-14 23:59:59",
        display_order: 7,
        date_created: "2024-01-15 14:00:00",
        status: "inactive",
    },
    {
        id: 8,
        banner_name: "Easter Sale",
        image_url:
            "https://static.vecteezy.com/system/resources/thumbnails/004/299/813/small/online-shopping-on-phone-buy-sell-business-digital-web-banner-application-money-advertising-payment-ecommerce-illustration-search-vector.jpg",
        link_url: "https://example.com/easter-sale",
        start_date: "2024-03-20 00:00:00",
        end_date: "2024-03-31 23:59:59",
        display_order: 8,
        date_created: "2024-02-20 15:15:00",
        status: "active",
    },
    {
        id: 9,
        banner_name: "Mother's Day",
        image_url:
            "https://www.shutterstock.com/image-vector/online-shopping-on-phone-buy-260nw-2078330851.jpg",
        link_url: "https://example.com/mothers-day",
        start_date: "2024-05-01 00:00:00",
        end_date: "2024-05-12 23:59:59",
        display_order: 9,
        date_created: "2024-04-10 16:30:00",
        status: "inactive",
    },
    {
        id: 10,
        banner_name: "Father's Day",
        image_url:
            "https://www.shutterstock.com/image-vector/ecommerce-website-banner-template-presents-260nw-2252124451.jpg",
        link_url: "https://example.com/fathers-day",
        start_date: "2024-06-01 00:00:00",
        end_date: "2024-06-16 23:59:59",
        display_order: 10,
        date_created: "2024-05-15 17:45:00",
        status: "active",
    },
]);

const pagination = ref({
    total: 70,
    count: 10,
    per_page: 10,
    current_page: 1,
    total_pages: 7,
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
        label: "Promo Banners",
        href: null,
    },
]);
</script>

<template>
    <Modal
        title="Create Promo Banner"
        maxWidth="lg"
        :show="createModalShow"
        @close="createModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="BannerImage"
                    value="Banner Image"
                    :required="true"
                    specialClass="mb-1"
                />
                <div
                    class="bg-white dark:bg-gray-900 border border-dashed border-gray-500 p-10 text-center items-center rounded-2xl cursor-pointer w-full h-48 flex items-center"
                >
                    <div class="w-full">
                        <button
                            class="bg-gray-800 dark:bg-slate-800 text-white shadow px-2 py-2 mb-4 rounded-full focus:outline-none"
                        >
                            <Icon
                                icon="mage:file-upload"
                                class="text-2xl"
                            />
                        </button>
                        <span
                            class="text-black block font-bold text-sm dark:text-white"
                        >
                            Drop files here or click to upload
                        </span>
                        <span
                            class="text-gray-600 text-xs dark:text-neutral-400"
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
                    for="bannerName"
                    value="Banner Name"
                    :required="true"
                />
                <TextInput
                    id="bannerName"
                    type="text"
                    v-model="createForm.banner_name"
                    placeholder="Enter banner name"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="linkUrl"
                    value="Link Url"
                />
                <TextInput
                    id="linkUrl"
                    type="text"
                    v-model="createForm.link_url"
                    placeholder="Enter link url"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="startDate"
                        value="Start Date"
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
                    />
                    <TextInput
                        id="endDate"
                        type="date"
                        v-model="createForm.end_date"
                        placeholder="Enter end date"
                    />
                </div>
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
                    class="relative bg-white dark:bg-gray-900 border border-dashed border-gray-500 text-center items-center rounded-2xl cursor-pointer w-full h-48 flex items-center"
                >
                    <div class="w-full rounded-2xl overflow-hidden">
                        <img
                            :src="updateForm.image_url"
                            class="w-full h-full object-cover"
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
                    for="bannerName"
                    value="Banner Name"
                    :required="true"
                />
                <TextInput
                    id="bannerName"
                    type="text"
                    v-model="updateForm.banner_name"
                    placeholder="Enter banner name"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="linkUrl"
                    value="Link Url"
                />
                <TextInput
                    id="linkUrl"
                    type="text"
                    v-model="updateForm.link_url"
                    placeholder="Enter link url"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="startDate"
                        value="Start Date"
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
                    />
                    <TextInput
                        id="endDate"
                        type="date"
                        v-model="updateForm.end_date"
                        placeholder="Enter end date"
                    />
                </div>
            </div>
            <div>
                <InputLabel
                    for="type"
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
    <Head title="Promo Banners" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <h1 class="font-bold text-lg mb-3 dark:text-white">
                PROMO BANNERS
            </h1>
            <div
                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-x-4 mb-3"
            >
                <div>
                    <InputLabel
                        for="name"
                        value="Banner Name"
                    />
                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        placeholder="Enter banner name"
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
                    @click="createModal"
                >
                    CREATE PROMO BANNER
                    <Icon
                        icon="solar:add-circle-linear"
                        class="ml-2"
                    />
                </button>
            </div>
            <Table
                :data="promoBanners"
                :pagination="pagination"
            >
                <template #columnHeader>
                    <ColumnHeader>#</ColumnHeader>
                    <ColumnHeader sortKey="banner_name">
                        Banner Name
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="image_url"
                    >
                        Banner Image
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="link_url"
                    >
                        Link URL
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="start_date"
                    >
                        Start Date
                    </ColumnHeader>
                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="end_date"
                    >
                        End Date
                    </ColumnHeader>

                    <ColumnHeader
                        customClass="flex justify-center"
                        sortKey="display_order"
                    >
                        Display Order
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
                <Row v-slot="{ row, index }">
                    <RowColumn>{{ index + 1 }}</RowColumn>
                    <RowColumn>{{ row.banner_name }}</RowColumn>
                    <RowColumn customClass="text-center">
                        <img
                            :src="row.image_url"
                            :alt="row.banner_name"
                            class="w-86 h-full object-cover"
                        />
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        <a
                            :href="row.link_url"
                            target="_blank"
                            class="text-blue-900 underline"
                        >
                            View Link
                        </a>
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.start_date ?? "--" }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.end_date ?? "--" }}
                    </RowColumn>
                    <RowColumn customClass="text-center">
                        {{ row.display_order }}
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
