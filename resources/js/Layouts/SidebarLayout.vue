<script setup>
import logo from "@/assets/images/logo.png";
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const dropdownOpen = ref(null);
const toggleDropdown = (e, dropdownId) => {
    dropdownOpen.value = dropdownOpen.value === dropdownId ? null : dropdownId;
};
</script>

<template>
    <aside
        id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen hidden sm:block transition-transform transform translate-x-full sm:translate-x-0"
        aria-label="Sidebar"
    >
        <div
            class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800"
        >
            <a
                href="/"
                class="flex items-center ps-2.5 mb-5"
            >
                <img
                    :src="logo"
                    class="h-12 me-3 sm:h-12"
                    alt="Olivia J"
                />
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl text-white hover:bg-black hover:text-white hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="mage:dashboard-2"
                            data-inline="false"
                        />
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                        @click="toggleDropdown(event, 'orders-dropdown')"
                    >
                        <Icon
                            icon="ion:receipt-outline"
                            data-inline="false"
                        />
                        <span class="ms-3">Orders</span>
                    </a>
                    <ul
                        v-if="dropdownOpen == 'orders-dropdown'"
                        class="space-y-1 mt-2 pl-4 text-sm text-gray-700"
                    >
                        <li>
                            <a
                                href="#"
                                class="block p-2 rounded-lg hover:bg-gray-200 hover:text-black"
                            >
                                Order History
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block p-2 rounded-lg hover:bg-gray-200 hover:text-black"
                            >
                                Pending Orders
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block p-2 rounded-lg hover:bg-gray-200 hover:text-black"
                            >
                                Completed Orders
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                        @click="toggleDropdown(event, 'products-dropdown')"
                    >
                        <Icon
                            icon="solar:cart-linear"
                            data-inline="false"
                        />
                        <span class="ms-3">Products</span>
                    </a>
                    <ul
                        v-if="dropdownOpen == 'products-dropdown'"
                        class="space-y-1 mt-2 pl-4 text-sm text-gray-700"
                    >
                        <li>
                            <Link
                                :href="route('products')"
                                class="block p-2 rounded-lg hover:bg-gray-200 hover:text-black"
                            >
                                All Products
                            </Link>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block p-2 rounded-lg hover:bg-gray-200 hover:text-black"
                            >
                                Category
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block p-2 rounded-lg hover:bg-gray-200 hover:text-black"
                            >
                                Tags
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="solar:user-linear"
                            data-inline="false"
                        />
                        <span class="ms-3">Customers</span>
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="hugeicons:discount-tag-02"
                            data-inline="false"
                        />
                        <span class="ms-3">Promotion</span>
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="solar:upload-square-linear"
                            data-inline="false"
                        />
                        <span class="ms-3">Content Management</span>
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="solar:headphones-round-sound-linear"
                            data-inline="false"
                        />
                        <span class="ms-3">Help Center</span>
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="solar:users-group-rounded-linear"
                            data-inline="false"
                        />
                        <span class="ms-3">User Management</span>
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="solar:settings-linear"
                            data-inline="false"
                        />
                        <span class="ms-3">Settings</span>
                    </a>
                </li>
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-sm text-gray-700 rounded-xl hover:bg-black hover:text-white"
                    >
                        <Icon
                            icon="solar:logout-outline"
                            data-inline="false"
                        />
                        <span class="ms-3">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</template>
