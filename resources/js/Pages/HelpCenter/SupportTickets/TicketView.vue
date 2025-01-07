<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

const navigateToSupportTickets = () => {
    window.location.href = "/help-center/support-tickets";
};

const nav = ref([
    {
        label: "Support Tickets",
        href: "support-tickets",
    },
    {
        label: "Ticket Information",
        href: null,
    },
]);
</script>

<template>
    <Head title="Ticket Information" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        TICKET INFORMATION
                    </h1>
                    <h2
                        class="text-sm text-gray-600 mb-6 dark:text-neutral-400"
                    >
                        Detailed Overview of Support Requests
                    </h2>
                </div>
                <div
                    class="filter-action mb-5 flex flex-wrap items-center gap-x-2"
                >
                    <button
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center flex-wrap"
                        @click="navigateToSupportTickets"
                    >
                        <Icon
                            icon="bitcoin-icons:arrow-left-outline"
                            class="mr-2"
                        />
                        BACK
                    </button>
                    <button
                        class="bg-black dark:bg-slate-900 text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:opacity-75"
                    >
                        UPDATE STATUS
                    </button>
                </div>
            </div>

            <div
                class="w-full bg-gray-100 dark:bg-slate-700 grid grid-cols-12 gap-5 mb-4 p-5 rounded-2xl"
            >
                <div
                    class="col-span-12 border-b border-gray-200 dark:border-slate-800 pb-3"
                >
                    <h1 class="text-md dark:text-white">
                        <span class="font-bold mr-2">#TC-240821001</span>
                        Order Not Received
                    </h1>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        CUSTOMER NAME
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        Alice Johnson
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        EMAIL ADDRESS
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        alice.johnson@example.com
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        CONTACT NUMBER
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        +1-555-123-4567
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        DATE SUBMITTED
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        21 Aug 2024, 01:09 PM
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        CATEGORY
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        Shipping and Delivery
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        PRIORITY LEVEL
                    </p>
                    <p class="text-lg text-semibold dark:text-white">Urgent</p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-2 dark:text-neutral-400">
                        CURRENT STATUS
                    </p>
                    <span
                        class="bg-black text-white text-xs rounded-2xl py-1 px-2"
                    >
                        Ongoing
                    </span>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-2 dark:text-neutral-400">
                        ASSIGNED TO
                    </p>
                    <div class="flex flex-wrap items-center">
                        <div class="w-8 h-8 relative mr-3">
                            <img
                                src="https://images.ctfassets.net/lh3zuq09vnm2/yBDals8aU8RWtb0xLnPkI/19b391bda8f43e16e64d40b55561e5cd/How_tracking_user_behavior_on_your_website_can_improve_customer_experience.png"
                                alt="User Avatar"
                                class="w-full h-full rounded-full object-cover"
                            />
                        </div>
                        <p class="text-sm text-black dark:text-white">
                            John Michael Boland
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-slate-700 p-5 rounded-2xl mb-5">
                <div class="flex flex-wrap">
                    <Icon
                        icon="lets-icons:message-open-light"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white mb-5"
                    >
                        Issue Description
                    </h2>
                </div>
                <div class="mb-5 ml-8 dark:text-white">
                    <p>
                        I’m following up on my previous message about the order
                        that I haven't received yet. I placed the order on July
                        20th, and it was supposed to arrive by August 20th. I’m
                        really concerned because it’s now August 21th and I
                        still haven’t received any updates. I have attached
                        screenshots of the order confirmation and a shipping
                        receipt for your reference.
                    </p>
                    <br />
                    <p>Order Number: #240818642001</p>
                    <p>Expected Delivery: August 20, 2024</p>
                    <br />
                    <p>
                        Please check the status of my order and let me know when
                        I can expect it to arrive. Thank you for your
                        assistance!
                    </p>
                </div>
                <hr class="my-3 border border-gray-200 dark:border-slate-800" />
                <div class="flex flex-wrap">
                    <Icon
                        icon="solar:file-linear"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white mb-5"
                    >
                        Attachments
                    </h2>
                </div>
                <div class="flex flex-wrap gap-x-4 ml-8">
                    <img
                        src="https://img.freepik.com/premium-vector/document-courier-delivery-smartphone-interface-vector-template-mobile-app-page-white-design-layout-my-orders-history-screen-flat-ui-application-online-resources-books-rental-phone-display_106317-13824.jpg"
                        alt="Attachment 1"
                        class="w-60 h-full object-cover"
                    />
                    <img
                        src="https://img.freepik.com/premium-vector/email-sending-smartphone-interface-vector-template-mobile-app-page-white-design-layout-attaching-files-media-screen-flat-ui-application-online-attachments-sharing-adding-phone-display_106317-11264.jpg"
                        alt="Attachment 1"
                        class="w-60 h-full object-cover"
                    />
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-slate-700 p-5 rounded-2xl mb-5">
                <div class="flex flex-wrap">
                    <Icon
                        icon="solar:clock-circle-linear"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white mb-5"
                    >
                        Ticket Activity
                    </h2>
                </div>

                <div class="relative border-l-2 border-gray-300 ml-8">
                    <div class="mb-6 ml-[-0.5rem]">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-4 h-4 bg-black dark:bg-custom-blue rounded-full"
                            ></div>
                            <div class="ml-4">
                                <p class="font-semibold dark:text-white">
                                    Updated Ticket Status
                                </p>
                                <p class="text-sm dark:text-neutral-400">
                                    Changed ticket status to 'In Progress' after
                                    confirming the issue with the shipping
                                    department.
                                </p>
                                <p class="text-xs dark:text-neutral-400">
                                    22 Aug 14:48
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="w-4 h-4 bg-gray-300 rounded-full"></div>
                            <div class="ml-4">
                                <p class="font-semibold dark:text-white">
                                    Investigated Issue
                                </p>
                                <p class="text-sm dark:text-neutral-400">
                                    Support agent Bob Smith investigated the
                                    issue and found that the order was delayed
                                    in the shipping process.
                                </p>
                                <p class="text-xs dark:text-neutral-400">
                                    22 Aug 14:28
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="w-4 h-4 bg-gray-300 rounded-full"></div>
                            <div class="ml-4">
                                <p class="font-semibold dark:text-white">
                                    Contacted Customer
                                </p>
                                <p class="text-sm dark:text-neutral-400">
                                    Support agent Bob Smith contacted Alice
                                    Johnson for more details about the order.
                                </p>
                                <p class="text-xs dark:text-neutral-400">
                                    22 Aug 09:25
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="w-4 h-4 bg-gray-300 rounded-full"></div>
                            <div class="ml-4">
                                <p class="font-semibold dark:text-white">
                                    Assigned to Support Agent
                                </p>
                                <p class="text-sm dark:text-neutral-400">
                                    Ticket assigned to support agent Bob Smith
                                    for further investigation.
                                </p>
                                <p class="text-xs dark:text-neutral-400">
                                    21 Aug 18:10
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="w-4 h-4 bg-gray-300 rounded-full"></div>
                            <div class="ml-4">
                                <p class="font-semibold dark:text-white">
                                    Acknowledgement Sent
                                </p>
                                <p class="text-sm dark:text-neutral-400">
                                    Sent an acknowledgment email to Alice
                                    Johnson confirming receipt of the ticket.
                                </p>
                                <p class="text-xs dark:text-neutral-400">
                                    21 Aug 12:23
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="w-4 h-4 bg-gray-300 rounded-full"></div>
                            <div class="ml-4">
                                <p class="font-semibold dark:text-white">
                                    Ticket Created
                                </p>
                                <p class="text-sm dark:text-neutral-400">
                                    Customer Alice Johnson submitted a ticket
                                    regarding an order not received.
                                </p>
                                <p class="text-xs dark:text-neutral-400">
                                    21 Aug 08:45
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
