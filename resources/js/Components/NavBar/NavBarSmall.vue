<script setup>
import logo from "@/assets/images/olivia-small.png";
import NavBarIcon from "@/Components/NavBar/NavBarIcon.vue";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

const theme = ref("light");
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
                routes: ["add-product"],
            },
            {
                label: "Category",
                href: "category",
                icon: null,
                children: [],
                routes: [],
            },
            {
                label: "Tag",
                href: "tag",
                icon: null,
                children: [],
                routes: [],
            },
        ],
        routes: ["products", "category", "tag", "add-product"],
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
        href: null,
        icon: {
            default: "solar:logout-outline",
            active: "",
        },
        children: [],
        routes: [],
    },
];

const changeTheme = (newTheme) => {
    theme.value = newTheme;
};
</script>

<template>
    <aside
        id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-20 w-[5%] h-screen inline-block"
        aria-label="Sidebar"
    >
        <div class="px-3 py-4 mr-5 h-full overflow-y-auto">
            <a
                href="/"
                class="flex items-center mt-3 mb-5"
            >
                <img
                    :src="logo"
                    class="object-contain"
                    alt="Olivia J"
                />
            </a>

            <!-- <ul class="font-medium">
                <template
                    v-for="item in navLinks"
                    :key="item.label"
                >
                    <NavBarItem
                        :item="item"
                        @close="closeMenu"
                    ></NavBarItem>
                </template>
            </ul> -->
            <ul class="flex flex-col justify-center font-medium mt-5">
                <template
                    v-for="item in navLinks"
                    :key="item.label"
                >
                    <NavBarIcon
                        :item="item"
                        @close="closeMenu"
                    ></NavBarIcon>
                </template>
            </ul>
            <button
                class="bg-gray-200 shadow text-black shadow px-2 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide absolute top-8 right-[-10px] hover:bg-gray-900 hover:text-white"
            >
                <Icon
                    icon="ph:arrow-line-right-light"
                    class="text-md"
                />
            </button>
        </div>
    </aside>
</template>
