<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const navigateToSitePages = () => {
    window.location.href = "/content-management/site-pages";
};
const form = useForm({
    page_title: null,
    page_type: null,
});

const pageTypeOptions = ref([
    { label: "Static", value: "static" },
    { label: "Legal", value: "legal" },
]);

const nav = ref([
    {
        label: "Site Pages",
        href: "site-pages",
    },
    {
        label: "Create Site Page",
        href: null,
    },
]);
</script>

<template>
    <Head title="Create Site Page" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        CREATE SITE PAGE
                    </h1>
                    <h2
                        class="text-sm text-gray-600 dark:text-neutral-400 mb-6"
                    >
                        Create and Manage Essential Pages and Content for Your
                        Website
                    </h2>
                </div>
                <div
                    class="filter-action mb-5 flex flex-wrap items-center gap-x-2"
                >
                    <button
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center flex-wrap"
                        @click="navigateToSitePages"
                    >
                        <Icon
                            icon="bitcoin-icons:arrow-left-outline"
                            class="mr-2"
                        />
                        BACK
                    </button>
                    <button
                        class="bg-black dark:bg-custom-blue text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
                    >
                        SAVE
                        <Icon
                            icon="bitcoin-icons:arrow-right-outline"
                            class="ml-2"
                        />
                    </button>
                </div>
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-3/4 pr-2">
                    <InputLabel
                        for="pageTitle"
                        value="Page Title"
                        :required="true"
                    />
                    <TextInput
                        id="pageTitle"
                        type="text"
                        v-model="form.page_title"
                        placeholder="Enter page title"
                    />
                </div>
                <div class="w-1/4 pr-2">
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
            </div>
            <div class="mb-3">
                <InputLabel
                    for="content"
                    value="Content"
                    class="mb-3"
                    :required="true"
                />
                <QuillEditor theme="snow" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
