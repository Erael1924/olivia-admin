<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
const navigateToEmailTemplates = () => {
    window.location.href = "/content-management/email-templates";
};

const form = useForm({
    name: null,
    description: null,
    content: null,
    status: null,
});

const quillEditor = ref(null);

const insertPlaceholder = (placeholder) => {
    const editor = quillEditor.value.getQuill();
    const cursorPosition = editor.getSelection()?.index ?? 0;
    editor.insertText(cursorPosition, placeholder);

    editor.setSelection(cursorPosition + placeholder.length);
};

const nav = ref([
    {
        label: "Email Templates",
        href: "email-templates",
    },
    {
        label: "Create Email Template",
        href: null,
    },
]);
</script>

<template>
    <Head title="Create Email Template" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        CREATE EMAIL TEMPLATE
                    </h1>
                    <h2
                        class="text-sm text-gray-600 mb-6 dark:text-neutral-400"
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
                        @click="navigateToEmailTemplates"
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
            <div class="mb-3">
                <InputLabel
                    for="name"
                    value="Template Name"
                    :required="true"
                />
                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    placeholder="Enter template name"
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
                    v-model="form.description"
                    placeholder="Enter description"
                />
            </div>
            <div class="mb-3">
                <InputLabel
                    for="content"
                    value="Content"
                    class="mb-3"
                    :required="true"
                />
                <section class="mb-6">
                    <h2 class="text-sm text-black dark:text-white mb-0 italic">
                        Insert Placeholders
                    </h2>
                    <p
                        class="text-sm text-gray-600 dark:text-neutral-400 mb-2 italic"
                    >
                        Add dynamic content to your email templates by inserting
                        placeholders.
                    </p>
                    <div class="flex flex-wrap gap-x-4">
                        <button
                            @click="insertPlaceholder('[Customer Username]')"
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Customer Username
                        </button>
                        <button
                            @click="insertPlaceholder('[Customer Full Name]')"
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Customer Full Name
                        </button>
                        <button
                            @click="
                                insertPlaceholder('[Customer Email Address]')
                            "
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Customer Email Address
                        </button>
                        <button
                            @click="insertPlaceholder('[Order Number]')"
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Order Number
                        </button>
                        <button
                            @click="insertPlaceholder('[Order Date]')"
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Order Date
                        </button>
                        <button
                            @click="insertPlaceholder('[Tracking Number]')"
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Tracking Number
                        </button>
                        <button
                            @click="insertPlaceholder('[Shipping Address]')"
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Shipping Address
                        </button>
                        <button
                            @click="insertPlaceholder('[Delivery Date]')"
                            class="bg-gray-200 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            Delivery Date
                        </button>
                    </div>
                </section>
                <QuillEditor
                    theme="snow"
                    ref="quillEditor"
                    v-model="form.content"
                    contentType="html"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
