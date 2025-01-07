<script setup>
import DropdownMenu from "@/Components/DropdownMenu.vue";
import { moneyFormat } from "@/helpers/MoneyHelper";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { MenuItem } from "@headlessui/vue";
import { Icon } from "@iconify/vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
const nav = ref([
    {
        label: "Orders",
        href: "orders",
    },
    {
        label: "Order Details",
        href: null,
    },
]);

const navigateToViewOrderDetailsPage = () => {
    window.location.href = "/orders";
};
</script>

<template>
    <Head title="Order Details" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div class="bg-white dark:bg-gray-900 p-5 rounded-2xl">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        ORDER DETAILS
                    </h1>
                    <h2
                        class="text-sm text-gray-600 mb-6 dark:text-neutral-400"
                    >
                        Complete Order Information and Status Overview
                    </h2>
                </div>
                <div class="flex flex-wrap gap-x-2 items-start">
                    <button
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center flex-wrap"
                        @click="navigateToViewOrderDetailsPage"
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
                    <DropdownMenu name="GENERATE DOCUMENT">
                        <template #title>
                            <p
                                class="px-2 py-1 text-xs text-black dark:text-white"
                            >
                                GENERATE DOCUMENT
                            </p>
                        </template>
                        <template #content>
                            <MenuItem>
                                <button
                                    :class="[
                                        'group flex w-full items-center flex items-center rounded-2xl px-2 py-2 text-sm text-gray-700 dark:text-slate-400 hover:bg-gray-200 hover:text-black dark:hover:bg-slate-900 dark:hover:text-white hover:shadow',
                                    ]"
                                >
                                    Packing List
                                </button>
                            </MenuItem>
                            <MenuItem>
                                <button
                                    :class="[
                                        'group flex w-full items-center flex items-center rounded-2xl px-2 py-2 text-sm text-gray-700 dark:text-slate-400 hover:bg-gray-200 hover:text-black dark:hover:bg-slate-900 dark:hover:text-white hover:shadow',
                                    ]"
                                >
                                    Airway Bill
                                </button>
                            </MenuItem>
                        </template>
                    </DropdownMenu>
                </div>
            </div>
            <div
                class="w-full bg-gray-100 dark:bg-slate-700 grid grid-cols-12 gap-5 mb-4 p-5 rounded-2xl"
            >
                <div
                    class="col-span-12 border-b border-gray-200 dark:border-slate-800 pb-3"
                >
                    <h1 class="text-md dark:text-white font-bold">
                        ORDER NUMBER: #20230813152001
                    </h1>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        CUSTOMER NAME
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        Ethan James Harris
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        PAYMENT METHOD
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        Cash on Delivery
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        SHIPPING OPTION
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        Standard Shipping
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        STATUS
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        <span
                            class="bg-black text-white text-xs rounded-2xl py-1 px-2"
                        >
                            Delivered
                        </span>
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        ORDER DATE
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        12 Aug 2024 08:45
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        PAYMENT TIME
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        12 Aug 2024 14:28
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-2 dark:text-neutral-400">
                        SHIP TIME
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        12 Aug 2024 18:10
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-2 dark:text-neutral-400">
                        DELIVERED TIME
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        12 Aug 2024 14:28
                    </p>
                </div>
            </div>
            <div class="w-full grid grid-cols-12 gap-4 pl-3">
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8"
                >
                    <div class="items w-full py-5 rounded-2xl">
                        <h2
                            class="text-md font-bold tracking-tight text-gray-900 mb-5 dark:text-white"
                        >
                            Order Item
                        </h2>
                        <template
                            v-for="index in 3"
                            :key="index"
                        >
                            <div
                                class="relative w-full grid grid-cols-12 py-3 border-b border-gray-200 dark:border-slate-700"
                            >
                                <div
                                    class="col-span-1 sm:col-span-1 md:col-span-1 lg:col-span-1 xl:col-span-1"
                                >
                                    <img
                                        src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/0ad177fc-38e1-4080-ae29-f0aea67416c2/AS+M+NK+DF+PRIMARY+STMT+SS.png"
                                        alt="Large Image"
                                        class="w-full h-16 object-cover rounded-2xl"
                                    />
                                </div>
                                <div
                                    class="col-span-9 sm:col-span-9 md:col-span-9 lg:col-span-9 xl:col-span-9 pl-5"
                                >
                                    <h3
                                        class="text-md font-semibold dark:text-white"
                                    >
                                        Black Basic Tee
                                    </h3>
                                    <p
                                        class="text-sm text-gray-800 dark:text-white"
                                    >
                                        Color: Black | Size: S
                                    </p>
                                    <p
                                        class="text-sm font-medium text-gray-900 dark:text-white mb-5"
                                    >
                                        <span
                                            v-if="index % 2 !== 0"
                                            class="text-red-500"
                                        >
                                            $25
                                        </span>
                                        <span
                                            v-if="index % 2 !== 0"
                                            class="line-through"
                                        >
                                            $35
                                        </span>
                                        <span v-else>$35</span>
                                    </p>
                                </div>
                                <div
                                    class="col-span-2 sm:col-span-2 md:col-span-2 lg:col-span-2 xl:col-span-2 text-right"
                                >
                                    <p
                                        class="text-md font-medium text-gray-900 dark:text-white"
                                    >
                                        1 x ${{
                                            moneyFormat(
                                                index % 2 !== 0 ? "25" : "35"
                                            )
                                        }}
                                    </p>
                                </div>
                            </div>
                        </template>
                        <h2
                            class="text-md font-bold tracking-tight text-gray-900 dark:text-white mt-10"
                        >
                            Order Summary
                        </h2>
                        <div
                            class="w-full mt-5 dark:text-white grid grid-cols-1 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4"
                        >
                            <div class="col-span-6">
                                <label class="text-sm font-semibold">
                                    Items:
                                </label>
                            </div>
                            <div class="col-span-6 text-right">
                                <label class="text-sm font-semibold">3</label>
                            </div>
                            <div class="col-span-6">
                                <label class="text-sm font-semibold">
                                    Payment Method:
                                </label>
                            </div>
                            <div class="col-span-6 text-right">
                                <label class="text-sm font-semibold">
                                    Cash on Delivery
                                </label>
                            </div>
                            <div class="col-span-12">
                                <hr
                                    class="border-gray-300 dark:border-slate-700"
                                />
                            </div>
                            <div class="col-span-6">
                                <label class="text-sm font-semibold">
                                    Product Subtotal:
                                </label>
                            </div>
                            <div class="col-span-6 text-right">
                                <label class="text-sm font-semibold">
                                    $85.00
                                </label>
                            </div>
                            <div class="col-span-6">
                                <label class="text-sm font-semibold">
                                    Voucher Discount:
                                </label>
                            </div>
                            <div class="col-span-6 text-right">
                                <label
                                    class="text-sm font-semibold text-red-500"
                                >
                                    - $25.00
                                </label>
                            </div>
                            <div class="col-span-6">
                                <label class="text-sm font-semibold">
                                    Shipping Fee:
                                </label>
                            </div>
                            <div class="col-span-6 text-right">
                                <label class="text-sm font-semibold">
                                    <span
                                        class="bg-red-500 text-white text-xs shadow-md ml-3 rounded-full py-1 px-2 mr-2"
                                    >
                                        FREE
                                    </span>
                                    <span class="line-through">$35.00</span>
                                </label>
                            </div>
                            <div class="col-span-6">
                                <label class="text-sm font-semibold">
                                    Taxes:
                                </label>
                            </div>
                            <div class="col-span-6 text-right">
                                <label class="text-sm font-semibold">
                                    $5.00
                                </label>
                            </div>
                            <div class="col-span-12">
                                <hr
                                    class="border-gray-300 dark:border-slate-700"
                                />
                            </div>
                            <div class="col-span-6">
                                <label class="text-sm font-bold text-xl">
                                    Total:
                                </label>
                            </div>
                            <div class="col-span-6 text-right">
                                <label class="text-sm font-bold text-xl">
                                    $120.00
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-4 xl:col-span-4"
                >
                    <div
                        class="bg-gray-100 dark:bg-slate-700 p-5 rounded-2xl mb-5"
                    >
                        <div class="flex flex-wrap">
                            <Icon
                                icon="system-uicons:location"
                                class="text-xl text-black dark:text-white mr-3"
                            />
                            <div class="text-black dark:text-white">
                                <h2
                                    class="text-md font-bold tracking-tight mb-5"
                                >
                                    Delivery Information
                                </h2>
                                <p class="text-md">Ethan James Harris</p>
                                <p class="text-sm">(415) 555-6789</p>
                                <p class="text-sm">
                                    123 Greenway Drive, Suite 400
                                </p>
                                <p class="text-sm">San Francisco CA 94105</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-100 dark:bg-slate-700 p-5 rounded-2xl mb-5"
                    >
                        <div class="flex flex-wrap">
                            <Icon
                                icon="material-symbols-light:local-shipping-outline-rounded"
                                class="text-xl text-black dark:text-white mr-3"
                            />
                            <div>
                                <h2
                                    class="text-md font-bold tracking-tight text-gray-900 dark:text-white mb-5"
                                >
                                    Shipping Information
                                </h2>
                                <p class="text-sm mb-5 dark:text-white">
                                    Tracking Number: TN2024081401
                                </p>
                                <div
                                    class="relative border-l-2 border-gray-300"
                                >
                                    <div class="mb-6 ml-[-0.5rem]">
                                        <div class="flex items-center mb-4">
                                            <div
                                                class="w-4 h-4 bg-black rounded-full"
                                            ></div>
                                            <div class="ml-4">
                                                <p
                                                    class="font-semibold dark:text-white"
                                                >
                                                    Delivered
                                                </p>
                                                <p
                                                    class="text-sm dark:text-neutral-400"
                                                >
                                                    Parcel has been delivered
                                                </p>
                                                <p
                                                    class="text-xs dark:text-neutral-400"
                                                >
                                                    12 Aug 14:28
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <div
                                                class="w-4 h-4 bg-gray-300 rounded-full"
                                            ></div>
                                            <div class="ml-4">
                                                <p
                                                    class="font-semibold dark:text-white"
                                                >
                                                    In transit
                                                </p>
                                                <p
                                                    class="text-sm dark:text-neutral-400"
                                                >
                                                    Parcel is out for delivery
                                                </p>
                                                <p
                                                    class="text-xs dark:text-neutral-400"
                                                >
                                                    13 Aug 09:25
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <div
                                                class="w-4 h-4 bg-gray-300 rounded-full"
                                            ></div>
                                            <div class="ml-4">
                                                <p
                                                    class="font-semibold dark:text-white"
                                                >
                                                    Shipped
                                                </p>
                                                <p
                                                    class="text-sm dark:text-neutral-400"
                                                >
                                                    Parcel has been shipped
                                                </p>
                                                <p
                                                    class="text-xs dark:text-neutral-400"
                                                >
                                                    12 Aug 18:10
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <div
                                                class="w-4 h-4 bg-gray-300 rounded-full"
                                            ></div>
                                            <div class="ml-4">
                                                <p
                                                    class="font-semibold dark:text-white"
                                                >
                                                    Preparing
                                                </p>
                                                <p
                                                    class="text-sm dark:text-neutral-400"
                                                >
                                                    Preparing to ship parcel
                                                </p>
                                                <p
                                                    class="text-xs dark:text-neutral-400"
                                                >
                                                    12 Aug 12:23
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <div
                                                class="w-4 h-4 bg-gray-300 rounded-full"
                                            ></div>
                                            <div class="ml-4">
                                                <p
                                                    class="font-semibold dark:text-white"
                                                >
                                                    Order Placed
                                                </p>
                                                <p
                                                    class="text-sm dark:text-neutral-400"
                                                >
                                                    Order is placed
                                                </p>
                                                <p
                                                    class="text-xs dark:text-neutral-400"
                                                >
                                                    12 Aug 08:45
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
