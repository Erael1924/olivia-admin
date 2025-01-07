<script setup>
import olivia_black from "@/assets/images/olivia-black.png";
import olivia_small_white from "@/assets/images/olivia-small-white.png";
import olivia_small from "@/assets/images/olivia-small.png";
import olivia_white from "@/assets/images/olivia-white.png";
import NavBarItem from "@/Components/NavBar/NavBarItem.vue";

import NavBarIcon from "@/Components/NavBar/NavBarIcon.vue";
import { useSettingStore } from "@/Stores/settings";
import { Icon } from "@iconify/vue";
import { storeToRefs } from "pinia";

const settingStore = useSettingStore();
const { sidebar, theme } = storeToRefs(settingStore);

const navLinks = [
    {
        label: "Dashboard",
        href: "dashboard",
        icon: {
            default: "mage:dashboard-2",
            active: "mage:dashboard-fill",
        },
        children: [],
        routes: [],
    },
    {
        label: "Orders",
        href: null,
        icon: {
            default: "ion:receipt-outline",
            active: "ion:receipt",
        },
        children: [
            {
                label: "All Orders",
                href: "orders",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Return Orders",
                href: "return-orders",
                icon: null,
                children: [],
                routes: [],
            },
        ],
        routes: ["orders", "return-orders"],
    },
    {
        label: "Products",
        href: null,
        icon: {
            default: "solar:cart-linear",
            active: "solar:cart-bold",
        },
        children: [
            {
                label: "All Products",
                href: "products",
                icon: null,
                children: [],
                routes: ["products.view-create"],
            },
            {
                label: "Category",
                href: "products.category",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Sub Category",
                href: "products.sub-category",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Tag",
                href: "products.tags",
                icon: null,
                children: [],
                routes: [],
            },
        ],
        routes: [
            "products",
            "products.view-create",
            "products.category",
            "products.tags",
            "products.create-product",
            "products.sub-category",
        ],
    },
    {
        label: "Customers",
        href: "customers",
        icon: {
            default: "solar:user-linear",
            active: "solar:user-bold",
        },
        children: [],
        routes: [],
    },
    {
        label: "Promotion",
        href: null,
        icon: {
            default: "streamline:discount-percent-coupon",
            active: "streamline:discount-percent-coupon-solid",
        },
        children: [
            {
                label: "Vouchers",
                href: "vouchers",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Discounts",
                href: "discounts",
                icon: null,
                children: [],
                routes: [],
            },
        ],
        routes: ["vouchers", "discounts"],
    },
    {
        label: "Content Management",
        href: null,
        icon: {
            default: "solar:upload-square-linear",
            active: "solar:upload-square-bold",
        },
        children: [
            {
                label: "Collection Banners",
                href: "collection-banners",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Promo Banners",
                href: "promo-banners",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Site Pages",
                href: "site-pages",
                icon: null,
                children: [],
                routes: ["create-site-page", "update-site-page"],
            },
            {
                label: "Email Templates",
                href: "email-templates",
                icon: null,
                children: [],
                routes: ["create-email-template", "update-email-template"],
            },
        ],
        routes: [
            "collection-banners",
            "promo-banners",
            "site-pages",
            "create-site-page",
            "update-site-page",
            "email-templates",
            "create-email-template",
            "update-email-template",
        ],
    },
    {
        label: "Report and Analytics",
        href: null,
        icon: {
            default: "solar:graph-new-linear",
            active: "solar:graph-new-bold",
        },
        children: [
            {
                label: "Sales Report",
                href: "sales-report",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Customer Insights",
                href: "customer-insights",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Product Performance",
                href: "product-performance",
                icon: null,
                children: [],
                routes: [],
            },
        ],
        routes: ["sales-report", "customer-insights", "product-performance"],
    },
    {
        label: "Settings",
        href: null,
        icon: {
            default: "solar:settings-linear",
            active: "solar:settings-bold",
        },
        children: [
            {
                label: "General Settings",
                href: "general-settings",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Payment Methods",
                href: "payment-methods",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Shipping Options",
                href: "shipping-options",
                icon: null,
                children: [],
                routes: [],
            },
        ],
        routes: ["general-settings", "payment-methods", "shipping-options"],
    },
    {
        label: "User Management",
        href: null,
        icon: {
            default: "solar:users-group-rounded-linear",
            active: "solar:users-group-rounded-bold",
        },
        children: [
            {
                label: "Users",
                href: "users",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Role Settings",
                href: "roles",
                icon: null,
                children: [],
                routes: ["permission"],
            },
        ],
        routes: ["users", "roles", "permission"],
    },
    {
        label: "Help Center",
        href: null,
        icon: {
            default: "solar:headphones-round-sound-linear",
            active: "solar:headphones-round-sound-bold",
        },
        children: [
            {
                label: "Support Tickets",
                href: "support-tickets",
                icon: null,
                children: [],
                routes: ["ticket-information"],
            },
            {
                label: "FAQs",
                href: "faqs",
                icon: null,
                children: [],
                routes: ["create-faq", "update-faq"],
            },
        ],
        routes: [
            "support-tickets",
            "ticket-information",
            "faqs",
            "create-faq",
            "update-faq",
        ],
    },
    {
        label: "Logout",
        href: "logout",
        icon: {
            default: "solar:logout-outline",
            active: "",
        },
        children: [],
        routes: [],
    },
];

const initSideBar = () => {
    sidebar.value = sidebar.value === "wide" ? "narrow" : "wide";
};
</script>

<template>
    <aside
        id="sidebar-multi-level-sidebar"
        :class="[
            sidebar == 'wide'
                ? 'dark:bg-gray-900 fixed top-0 left-0 z-20 w-1/6 h-screen transform transition-transform duration-600 ease-in-out -translate-x-full sm:translate-x-0'
                : 'dark:bg-gray-900 fixed top-0 left-0 z-20 w-[6%] h-screen inline-block transform transition-transform duration-600 ease-in-out',
        ]"
        aria-label="Sidebar"
    >
        <div
            :class="[
                'h-full px-3 py-4',
                sidebar == 'narrow' ? 'mr-5 overflow-y-auto' : '',
            ]"
        >
            <template v-if="sidebar == 'wide'">
                <a
                    href="/"
                    class="flex items-center ps-2.5 mb-3 mt-3"
                >
                    <img
                        :src="theme == 'light' ? olivia_black : olivia_white"
                        class="w-40 object-contain"
                        alt="Olivia J"
                    />
                </a>
                <div
                    class="bg-gray-100 dark:bg-gray-700 text-black dark:text-white rounded-2xl flex items-center p-3"
                >
                    <div
                        class="w-10 h-10 relative mr-3"
                        v-if="$page.props.auth.user.profile_picture"
                    >
                        <img
                            :src="$page.props.auth.user.profile_picture"
                            alt="User Avatar"
                            class="w-full h-full rounded-full object-cover"
                        />
                    </div>
                    <div
                        class="w-10 h-10 mr-3 px-2 py-2 bg-custom-blue rounded-full items-center"
                        v-else
                    >
                        <Icon
                            icon="solar:user-linear"
                            class="text-2xl text-white"
                        />
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-semibold">
                            {{ $page.props.auth.user.full_name }}
                        </p>
                        <p class="text-xs">
                            {{ $page.props.auth.user.role.role_name }}
                        </p>
                    </div>
                </div>
                <ul class="font-medium h-5/6 overflow-y-auto">
                    <template
                        v-for="item in navLinks"
                        :key="item.label"
                    >
                        <NavBarItem :item="item"></NavBarItem>
                    </template>
                </ul>
            </template>
            <template v-else>
                <a
                    href="/"
                    class="flex items-center ps-2.5 mb-10 mt-3"
                >
                    <img
                        :src="
                            theme == 'light' ? olivia_small : olivia_small_white
                        "
                        class="w-full object-contain"
                        alt="Olivia J"
                    />
                </a>
                <ul class="font-medium">
                    <template
                        v-for="item in navLinks"
                        :key="item.label"
                    >
                        <NavBarIcon :item="item"></NavBarIcon>
                    </template>
                </ul>
            </template>
            <button
                class="bg-gray-200 dark:bg-gray-900 shadow text-black dark:text-white shadow px-2 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide absolute top-8 right-[-0.8rem] hover:bg-gray-900 hover:text-white"
                @click="initSideBar"
            >
                <Icon
                    :icon="
                        sidebar == 'wide'
                            ? 'ph:arrow-line-left-light'
                            : 'ph:arrow-line-right-light'
                    "
                    class="text-md"
                />
            </button>
        </div>
    </aside>
</template>
