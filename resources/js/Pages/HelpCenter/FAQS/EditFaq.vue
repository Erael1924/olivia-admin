<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const navigateToFaqs = () => {
    window.location.href = "/help-center/faqs";
};
const editorHtml = ref(`<h2>How to Track My Order</h2>
                <p>Tracking your order is easy. Here’s how you can do it:</p>
                <ol>
                    <li><strong>Log in</strong> to your account on our website.</li>
                    <li>Go to the <strong>Orders</strong> section in your account dashboard.</li>
                    <li>Find the order you want to track and click on the <strong>Track Order</strong> button.</li>
                    <li>You will be redirected to a page with the current status and tracking details of your order.</li>
                </ol>
                <p>If you encounter any issues tracking your order, please contact our <a href="/support">customer support</a> for assistance.</p>`);
const form = useForm({
    question: "How can I track my order?",
    category: "shipping-delivery",
    sort_order: 1,
    answer: editorHtml.value,
});

const categoryOptions = ref([
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

const nav = ref([
    {
        label: "FAQS",
        href: "faqs",
    },
    {
        label: "Update FAQ",
        href: null,
    },
]);
</script>

<template>
    <Head title="Update Faq" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        UPDATE FAQ
                    </h1>
                    <h2
                        class="text-sm text-gray-600 mb-6 dark:text-neutral-400"
                    >
                        Build and Publish FAQ Content for Our Help Center
                    </h2>
                </div>
                <div
                    class="filter-action mb-5 flex flex-wrap items-center gap-x-2"
                >
                    <button
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center flex-wrap"
                        @click="navigateToFaqs"
                    >
                        <Icon
                            icon="bitcoin-icons:arrow-left-outline"
                            class="mr-2"
                        />
                        BACK
                    </button>
                    <button
                        class="bg-black dark:bg-custom-blue text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-between"
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
                <InputLabel
                    for="question"
                    value="Question"
                    :required="true"
                />
                <TextInput
                    id="question"
                    type="text"
                    v-model="form.question"
                    placeholder="Enter question"
                />
            </div>
            <div class="mb-3 flex flex-wrap">
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="category"
                        value="Category"
                        :required="true"
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
                <div class="w-1/2 pr-2">
                    <InputLabel
                        for="sortOrder"
                        value="Sort Order"
                    />
                    <TextInput
                        id="sortOrder"
                        type="number"
                        v-model="form.sort_order"
                        placeholder="Enter sort number"
                    />
                </div>
            </div>
            <div class="mb-3">
                <InputLabel
                    for="answer"
                    value="Answer"
                    class="mb-3"
                    :required="true"
                />
                <QuillEditor
                    theme="snow"
                    :content="form.answer"
                    contentType="html"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
