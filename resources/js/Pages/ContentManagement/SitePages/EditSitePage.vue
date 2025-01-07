<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const navigateToSitePages = () => {
    window.location.href = "/content-management/site-pages";
};

const editorHtml = ref(`
        <h1>Privacy Policy</h1>

<p>Welcome to Olivia J. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website [your website URL]. Please read this Privacy Policy carefully. If you do not agree with the terms of this Privacy Policy, please do not access the site.</p>

<h2>1. Collection of Your Information</h2>
<p>We may collect information about you in a variety of ways. The information we may collect includes:</p>
<ul>
    <li><strong>Personal Data:</strong> Personally identifiable information, such as your name, shipping address, email address, and telephone number, and demographic information, that you voluntarily give to us when you register with the site or when you choose to participate in various activities related to the site.</li>
    <li><strong>Derivative Data:</strong> Information our servers automatically collect when you access the site, such as your IP address, your browser type, your operating system, your access times, and the pages you have directly viewed.</li>
    <li><strong>Financial Data:</strong> Financial information, such as data related to your payment method (e.g., valid credit card number, card brand, expiration date) that we may collect when you purchase, order, return, exchange, or request information about our services from the site.</li>
</ul>

<h2>2. Use of Your Information</h2>
<p>Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience. Specifically, we may use information collected about you via the site to:</p>
<ul>
    <li>Assist in the operation of the site;</li>
    <li>Monitor and analyze usage and trends to improve your experience with the site;</li>
    <li>Notify you of updates to the site;</li>
    <li>Offer new products, services, and/or recommendations to you;</li>
    <li>Send you promotional information and marketing communications;</li>
    <li>Respond to your customer service requests and support needs.</li>
</ul>

<h2>3. Disclosure of Your Information</h2>
<p>We may share information we have collected about you in certain situations. Your information may be disclosed as follows:</p>
<ul>
    <li><strong>By Law or to Protect Rights:</strong> If we believe the release of information about you is necessary to respond to legal process, to investigate or remedy potential violations of our policies, or to protect the rights, property, and safety of others, we may share your information as permitted or required by any applicable law, rule, or regulation.</li>
    <li><strong>Business Transfers:</strong> We may share or transfer your information in connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business to another company.</li>
    <li><strong>Third-Party Service Providers:</strong> We may share your information with third-party service providers that perform services for us or on our behalf.</li>
</ul>

<h2>4. Security of Your Information</h2>
<p>We use administrative, technical, and physical security measures to help protect your personal information. While we have taken reasonable steps to secure the personal information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable, and no method of data transmission can be guaranteed against any interception or other type of misuse.</p>

<h2>5. Policy for Children</h2>
<p>We do not knowingly solicit information from or market to children under the age of 13. If we learn that we have collected personal information from a child under age 13 without verification of parental consent, we will delete that information as quickly as possible.</p>

<h2>6. Changes to This Privacy Policy</h2>
<p>We may update this Privacy Policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal, or regulatory reasons. We encourage you to review this Privacy Policy periodically to stay informed about how we are protecting your information.</p>

<h2>7. Contact Us</h2>
<p>If you have questions or comments about this Privacy Policy, please contact us at:</p>
<p>Email: [Your Email Address]</p>
<p>Phone: [Your Phone Number]</p>
<p>Address: [Your Address]</p>

    `);

const nav = ref([
    {
        label: "Site Pages",
        href: "site-pages",
    },
    {
        label: "Update Site Page",
        href: null,
    },
]);
</script>

<template>
    <Head title="Update Site Page" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        Update SITE PAGE
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
            <QuillEditor
                theme="snow"
                :content="editorHtml"
                contentType="html"
            ></QuillEditor>
        </div>
    </AuthenticatedLayout>
</template>
