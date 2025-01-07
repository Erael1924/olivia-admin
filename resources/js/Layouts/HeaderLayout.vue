<script setup lang="ts">
import DropdownMenu from "@/Components/DropdownMenu.vue";
import Popover from "@/Components/Popover.vue";
import { useSettingStore } from "@/Stores/settings";
import { MenuItems } from "@headlessui/vue";
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";
import { ref } from "vue";

const settingStore = useSettingStore();
const { sidebar, theme } = storeToRefs(settingStore);

interface Nav {
    label: String;
    href: String | null;
}

defineProps({
    nav: {
        type: Array<Nav>,
        required: false,
    },
});

document.documentElement.setAttribute("data-theme", theme);

const changeTheme = (newTheme: string) => {
    theme.value = newTheme;
    if (theme.value == "dark") {
        document.documentElement.classList.add("dark");
        document.documentElement.setAttribute("data-theme", "dark");
    } else {
        document.documentElement.classList.remove("dark");
        document.documentElement.setAttribute("data-theme", "light");
    }
};

const messages = ref([
    {
        id: 1,
        user_profile:
            "https://marketplace.canva.com/EAFqNrAJpQs/1/0/1600w/canva-neutral-pink-modern-circle-shape-linkedin-profile-picture-WAhofEY5L1U.jpg",
        full_name: "Alice Johnson",
        message:
            "Hi Frank, we have a problem with Order #12345. The customer has reported that they received the wrong item. Can someone check the fulfillment details and provide an update? Thanks!",
        created_at: "2024-09-03 08:30:00",
        read: false,
    },
    {
        id: 2,
        user_profile:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhQuYoNwYXhnteQASMOTMJwAa23uEAzOl8SA&s",
        full_name: "Bob Smith",
        message:
            "Attention: Our stock for item #67890 is running low. Please review the inventory and place a reorder if necessary. Let me know if you need any assistance.",
        created_at: "2024-09-03 09:00:00",
        read: false,
    },
    {
        id: 3,
        user_profile:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSS_1cY15aBRszFg8H-lUZI2V-UWnJ0hmWkHA&s",
        full_name: "Carol Davis",
        message:
            "Hi, I’ve received a refund request for Order #98765. The customer cited a damaged product. Can someone from the returns department handle this? Please expedite if possible.",
        created_at: "2024-09-03 09:30:00 ",
        read: true,
    },
    {
        id: 4,
        user_profile:
            "https://media.licdn.com/dms/image/v2/D4D12AQHQdFqdQc0XBQ/article-inline_image-shrink_1500_2232/article-inline_image-shrink_1500_2232/0/1705949052951?e=1730332800&v=beta&t=ICrJ5i_wb0eK9oD8y1TCITijkvcHdq_7EQUId6BeJLM",
        full_name: "David Wilson",
        message:
            "Hello, we’ve been notified of a delay in shipping for Order #54321. The carrier has updated the expected delivery date. Could someone update the customer with the new information?",
        created_at: "2024-09-03 10:00:00",
        read: true,
    },
    {
        id: 5,
        user_profile:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRh4moBSRCeyvWaJI8pPsFRCczpc9rB-f53ew&s",
        full_name: "Emily Brown",
        message:
            "Hey everyone, we need to update the product description for item #45678. The current description is outdated. Please review and make the necessary changes by end of day.",
        created_at: "2024-09-03 10:30:00",
        read: false,
    },
]);

const notifications = ref([
    {
        id: 1,
        type: "Order",
        message: "New order received from John Doe. Order #12345.",
        created_at: "2024-09-01 08:30:00",
        read: false,
    },
    {
        id: 2,
        type: "Stock",
        message: 'Stock level for "Product A" is below the minimum threshold.',
        created_at: "2024-09-01 09:00:00",
        read: true,
    },
    {
        id: 3,
        type: "Payment",
        message: "Payment of $150.00 received for Order #12345.",
        created_at: "2024-09-01 09:15:00",
        read: false,
    },
    {
        id: 4,
        type: "Shipment",
        message: "Order #12345 has been shipped.",
        created_at: "2024-09-01 10:00:00",
        read: false,
    },
    {
        id: 5,
        type: "Refund",
        message: "Refund of $50.00 processed for Order #12344.",
        created_at: "2024-09-01 10:30:00",
        read: true,
    },
]);

const formatTime = (datetime: Date) => {
    const date = new Date(datetime); // Create a Date object with your date-time string
    const hours = date.getHours().toString().padStart(2, "0"); // Get hours and pad with leading zero if needed
    const minutes = date.getMinutes().toString().padStart(2, "0"); // Get minutes and pad with leading zero if needed

    return `${hours}:${minutes}`;
};
</script>

<template>
    <div
        :class="[
            sidebar === 'wide'
                ? 'w-full lg:w-5/6 xl:w-5/6 lg::ml-1/6 xl:ml-1/6 fixed top-0 left-0 px-5 py-5 rounded-tl-2xl bg-gray-200 dark:bg-gray-700 z-10'
                : 'w-full lg:w-[94%] xl:w-[94%] lg::ml-[6%] xl:ml-[6%] fixed top-0 left-0 px-5 py-5 rounded-tl-2xl bg-gray-200 dark:bg-gray-700 z-10',
        ]"
    >
        <div
            class="w-full bg-white dark:bg-gray-900 px-4 py-3 rounded-2xl shadow flex flex-wrap justify-between"
        >
            <div class="flex flex-wrap items-center gap-x-2">
                <div class="mr-2 inline-block lg:hidden xl:hidden">
                    <Icon
                        icon="solar:hamburger-menu-linear"
                        class="text-xl text-black"
                    />
                </div>
                <template v-if="nav && nav.length > 0">
                    <Link
                        :href="route('dashboard')"
                        class="text-sm text-gray-900 dark:text-white"
                    >
                        Home
                    </Link>
                    <Icon
                        icon="ic:round-keyboard-arrow-right"
                        class="text-md text-gray-400 dark:text-slate-400"
                    />
                    <template
                        v-for="(row, index) in nav"
                        :key="index"
                    >
                        <template v-if="index + 1 != nav.length">
                            <Link
                                :href="route(row.href)"
                                class="text-sm text-gray-900 dark:text-white"
                            >
                                {{ row.label }}
                            </Link>
                            <Icon
                                icon="ic:round-keyboard-arrow-right"
                                class="text-md text-gray-400 dark:text-slate-400"
                            />
                        </template>
                        <template v-else>
                            <p
                                class="text-sm text-gray-400 dark:text-slate-400"
                            >
                                {{ row.label }}
                            </p>
                        </template>
                    </template>
                </template>
                <template v-else>
                    <p class="text-sm text-gray-900 dark:text-white">
                        Welcome,
                        <span class="font-semibold">
                            {{ $page.props.auth.user.full_name }}
                        </span>
                    </p>
                </template>
            </div>
            <div class="flex flex-wrap items-center gap-x-4">
                <template class="top-2 hidden lg:inline-block xl:inline-block">
                    <Popover>
                        <template #title>
                            <div class="relative">
                                <Icon
                                    icon="solar:inbox-linear"
                                    class="text-xl text-black dark:text-white"
                                />
                                <span
                                    class="absolute top-[-5px] left-3 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full"
                                >
                                    3
                                </span>
                            </div>
                        </template>
                        <template #content>
                            <div class="popover-header mb-3 flex items-center">
                                <h3
                                    class="text-md font-bold text-black dark:text-white"
                                >
                                    Messages
                                </h3>
                                <span
                                    class="flex items-center justify-center w-4 h-4 ml-2 text-xs font-bold text-white bg-red-500 rounded-full"
                                >
                                    3
                                </span>
                            </div>
                            <div class="relative bg-white dark:bg-gray-900">
                                <template
                                    v-for="item in messages"
                                    :key="item.id"
                                >
                                    <div
                                        :class="[
                                            !item.read
                                                ? 'bg-gray-200 dark:bg-slate-700'
                                                : '',
                                            'flex items-center rounded-lg p-1 px-2 mb-2 cursor-pointer transition duration-850 ease-in-out hover:bg-gray-200 dark:hover:bg-slate-700',
                                        ]"
                                    >
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center text-white sm:h-12 sm:w-12"
                                        >
                                            <div class="w-10 h-10 relative">
                                                <img
                                                    :src="item.user_profile"
                                                    alt="User Avatar"
                                                    class="w-full h-full rounded-full object-cover"
                                                />
                                            </div>
                                        </div>
                                        <div class="ml-2">
                                            <div class="relative">
                                                <p
                                                    class="text-sm font-medium text-black dark:text-white"
                                                >
                                                    {{ item.full_name }}
                                                </p>
                                                <p
                                                    class="text-xs text-gray-500 dark:text-neutral-400 line-clamp-1"
                                                >
                                                    {{ item.message }}
                                                </p>
                                                <span
                                                    class="absolute top-0 right-0 text-xs font-light text-gray-500 dark:text-neutral-400"
                                                >
                                                    {{
                                                        formatTime(
                                                            item.created_at
                                                        )
                                                    }}
                                                </span>
                                                <div
                                                    v-if="!item.read"
                                                    class="absolute -top-3 -right-2 w-2 h-2 bg-red-500 rounded-full"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <hr
                                class="my-3 border border-gray-200 dark:border-slate-800"
                            />
                            <div
                                class="popover-footer mb-2 flex items-center justify-between"
                            >
                                <a
                                    class="text-blue-900 dark:text-white text-xs font-semibold rounded-full flex items-center hover:opacity-75 cursor-pointer"
                                >
                                    <Icon
                                        icon="solar:check-read-linear"
                                        class="text-lg"
                                    />
                                    Mark as all read
                                </a>
                                <Link
                                    href="/messages"
                                    class="text-black dark:text-white text-xs font-semibold rounded-full hover:opacity-75 cursor-pointer"
                                >
                                    View all messages
                                </Link>
                            </div>
                        </template>
                    </Popover>
                </template>

                <template class="top-2 hidden lg:inline-block xl:inline-block">
                    <Popover>
                        <template #title>
                            <div class="relative">
                                <Icon
                                    icon="ion:notifications-outline"
                                    class="text-xl text-black dark:text-white"
                                />
                                <span
                                    class="absolute top-[-5px] left-3 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full"
                                >
                                    6
                                </span>
                            </div>
                        </template>
                        <template #content>
                            <div class="popover-header mb-3 flex items-center">
                                <h3
                                    class="text-md font-bold text-black dark:text-white"
                                >
                                    Notifications
                                </h3>
                                <span
                                    class="flex items-center justify-center w-4 h-4 ml-2 text-xs font-bold text-white bg-red-500 rounded-full"
                                >
                                    6
                                </span>
                            </div>
                            <div class="relative bg-white dark:bg-gray-900">
                                <template
                                    v-for="item in notifications"
                                    :key="item.id"
                                >
                                    <div
                                        :class="[
                                            !item.read
                                                ? 'bg-gray-200 dark:bg-slate-700'
                                                : '',
                                            'flex items-center rounded-lg p-1 px-2 mb-2 cursor-pointer transition duration-850 ease-in-out hover:bg-gray-200 dark:hover:bg-slate-700',
                                        ]"
                                    >
                                        <div class="w-full relative">
                                            <p
                                                class="text-sm font-medium text-black dark:text-white"
                                            >
                                                {{ item.type }}
                                            </p>
                                            <p
                                                class="text-xs text-gray-500 dark:text-neutral-400 line-clamp-1"
                                            >
                                                {{ item.message }}
                                            </p>
                                            <span
                                                class="absolute top-0 right-0 text-xs font-light text-gray-500 dark:text-neutral-400"
                                            >
                                                {{
                                                    formatTime(item.created_at)
                                                }}
                                            </span>
                                            <div
                                                v-if="!item.read"
                                                class="absolute -top-2 -right-3 w-2 h-2 bg-red-500 rounded-full"
                                            ></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <hr
                                class="my-3 border border-gray-200 dark:border-slate-800"
                            />
                            <div
                                class="popover-footer mb-2 flex items-center justify-between"
                            >
                                <a
                                    class="text-blue-900 dark:text-white text-xs font-semibold rounded-full flex items-center hover:opacity-75 cursor-pointer"
                                >
                                    <Icon
                                        icon="solar:check-read-linear"
                                        class="text-lg"
                                    />
                                    Mark as all read
                                </a>
                                <a
                                    class="text-black dark:text-white text-xs font-semibold rounded-full hover:opacity-75 cursor-pointer"
                                >
                                    Delete all notifications
                                </a>
                            </div>
                        </template>
                    </Popover>
                </template>
                <div
                    class="bg-white dark:bg-gray-700 rounded-full shadow hidden lg:inline-block xl:inline-block"
                >
                    <div
                        class="bg-gray-100 dark:bg-gray-700 rounded-full p-1 flex gap-x-1"
                    >
                        <button
                            class="bg-gray-200 dark:bg-gray-700 dark:text-white w-1/2 text-black px-2 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-white hover:text-black flex items-center justify-center"
                            @click="changeTheme('light')"
                        >
                            <Icon
                                :icon="
                                    theme == 'light'
                                        ? 'solar:sun-bold'
                                        : 'solar:sun-linear'
                                "
                            ></Icon>
                        </button>
                        <button
                            class="dark:bg-gray-900 dark:text-white w-1/2 text-black px-2 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-white hover:text-black flex items-center justify-center"
                            @click="changeTheme('dark')"
                        >
                            <Icon
                                :icon="
                                    theme == 'dark'
                                        ? 'solar:moon-bold'
                                        : 'solar:moon-line-duotone'
                                "
                            ></Icon>
                        </button>
                    </div>
                </div>
                <DropdownMenu>
                    <template #title>
                        <div
                            class="w-6 h-6 relative"
                            v-if="$page.props.auth.user.profile_picture"
                        >
                            <img
                                :src="$page.props.auth.user.profile_picture"
                                alt="User Avatar"
                                class="w-full h-full rounded-full object-cover"
                            />
                        </div>
                        <div
                            class="w-6 h-6 bg-custom-blue rounded-full flex items-center justify-center"
                            v-else
                        >
                            <Icon
                                icon="solar:user-linear"
                                class="text-md text-white"
                            />
                        </div>
                    </template>
                    <template #content>
                        <MenuItems>
                            <Link
                                :href="route('account-settings')"
                                :class="[
                                    'group flex w-full items-center flex items-center rounded-2xl px-2 py-2 text-sm text-gray-700 dark:text-slate-400 inline-block lg:hidden xl:hidden hover:bg-gray-200 hover:text-black dark:hover:bg-slate-700 dark:hover:text-white hover:shadow',
                                ]"
                            >
                                <Icon
                                    icon="solar:inbox-linear"
                                    class="text-xl mr-3"
                                />
                                Messages
                            </Link>
                            <Link
                                :href="route('account-settings')"
                                :class="[
                                    'group flex w-full items-center flex items-center rounded-2xl px-2 py-2 text-sm text-gray-700 dark:text-slate-400 inline-block lg:hidden xl:hidden hover:bg-gray-200 hover:text-black dark:hover:bg-slate-700 dark:hover:text-white hover:shadow',
                                ]"
                            >
                                <Icon
                                    icon="ion:notifications-outline"
                                    class="text-xl mr-3"
                                />
                                Notifications
                            </Link>
                            <Link
                                :href="route('account-settings')"
                                :class="[
                                    'group flex w-full items-center flex items-center rounded-2xl px-2 py-2 text-sm text-gray-700 dark:text-slate-400 hover:bg-gray-200 hover:text-black dark:hover:bg-slate-700 dark:hover:text-white hover:shadow',
                                ]"
                            >
                                <Icon
                                    icon="solar:key-square-2-outline"
                                    class="text-xl mr-3"
                                />
                                Account Settings
                            </Link>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                :class="[
                                    'group flex w-full items-center flex items-center rounded-2xl px-2 py-2 text-sm text-gray-700 dark:text-slate-400 hover:bg-gray-200 hover:text-black dark:hover:bg-slate-700 dark:hover:text-white hover:shadow',
                                ]"
                            >
                                <Icon
                                    icon="solar:logout-outline"
                                    class="text-xl mr-3"
                                />
                                Logout
                            </Link>
                        </MenuItems>
                    </template>
                </DropdownMenu>
            </div>
        </div>
    </div>
</template>
