<script setup lang="ts">
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const form = useForm({
    message: "",
});

const nav = ref([
    {
        label: "Messages",
        href: "messages",
    },
]);

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
    {
        id: 6,
        user_profile:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZd8IFhFAzVB_AdUsDwZMmRzafOAhzsQ_JlQ&s",
        full_name: "Lisa Green",
        message:
            "Reminder: The quarterly sales report is due tomorrow. Please ensure all data is updated and submitted by end of day.",
        created_at: "2024-09-03 11:00:00",
        read: true,
    },
    {
        id: 7,
        user_profile:
            "https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg",
        full_name: "James Turner",
        message:
            "Update: We have a new promotional campaign starting next week. Please review the campaign details and prepare any necessary materials.",
        created_at: "2024-09-03 11:30:00",
        read: true,
    },
    {
        id: 8,
        user_profile:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwme89cM8YZvHcybGrZl_Obd9U9p5QabozJQ&ss",
        full_name: "Sarah Adams",
        message:
            "Heads up: There’s been a change in the vendor schedule. Please check the updated delivery times and adjust your plans accordingly.",
        created_at: "2024-09-03 12:00:00",
        read: true,
    },
    {
        id: 9,
        user_profile:
            "https://i1.wp.com/www.shutterstock.com/blog/wp-content/uploads/sites/5/2024/06/profile_photo_sample_5.jpg?ssl=1",
        full_name: "Michael Brown",
        message:
            "Notice: The website will undergo maintenance this weekend. Expect some downtime between Saturday and Sunday. Please inform customers accordingly.",
        created_at: "2024-09-03 12:30:00",
        read: true,
    },
    {
        id: 10,
        user_profile:
            "https://d2qp0siotla746.cloudfront.net/img/use-cases/profile-picture/template_3.jpg",
        full_name: "Karen Lee",
        message:
            "Reminder: Please submit your expense reports by the end of the day for processing in this month’s budget.",
        created_at: "2024-09-03 13:00:00",
        read: true,
    },
]);

const formatTime = (datetime: Date) => {
    const date = new Date(datetime); // Create a Date object with your date-time string
    const hours = date.getHours().toString().padStart(2, "0"); // Get hours and pad with leading zero if needed
    const minutes = date.getMinutes().toString().padStart(2, "0"); // Get minutes and pad with leading zero if needed

    return `${hours}:${minutes}`;
};

const isTyping = computed(() => form.message.length > 0);
</script>

<template>
    <Head title="Messages" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">MESSAGES</h1>
                    <h2 class="text-sm text-gray-600 dark:text-slate-400 mb-6">
                        Essential Messages for E-Commerce Operations
                    </h2>
                </div>
                <div
                    class="filter-action mb-5 flex flex-wrap items-center gap-x-2"
                >
                    <button
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-between"
                    >
                        CREATE MESSAGE
                        <Icon
                            icon="solar:add-circle-linear"
                            class="ml-2"
                        />
                    </button>
                </div>
            </div>
            <div class="w-full grid grid-cols-12 gap-4 mb-4">
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-4 xl:col-span-4"
                >
                    <div class="bg-gray-100 dark:bg-slate-700 rounded-2xl p-4">
                        <div class="relative flex items-center w-full mb-3">
                            <Icon
                                icon="iconoir:search"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 dark:text-white"
                            />
                            <TextInput
                                specialClass="px-4 py-2 pl-10"
                                backgroundColor="bg-white dark:bg-slate-800"
                                id="search"
                                type="text"
                                placeholder="Search"
                            />
                        </div>
                        <div class="h-[500px] overflow-y-auto pt-2 pr-3">
                            <template
                                v-for="item in messages"
                                :key="item.id"
                            >
                                <div
                                    :class="[
                                        !item.read
                                            ? 'bg-gray-200 dark:bg-slate-800'
                                            : '',
                                        'flex items-center rounded-lg p-1 px-2 mb-2 cursor-pointer transition duration-850 ease-in-out hover:bg-gray-200 dark:hover:bg-slate-800',
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
                                                    formatTime(item.created_at)
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
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8"
                >
                    <div
                        class="bg-gray-100 dark:bg-slate-700 h-full w-full rounded-2xl mb-2 transition duration-850 ease-in-out"
                    >
                        <div class="flex items-center p-1 px-3">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center text-white sm:h-12 sm:w-12"
                            >
                                <div class="w-10 h-10 relative">
                                    <img
                                        src="https://marketplace.canva.com/EAFqNrAJpQs/1/0/1600w/canva-neutral-pink-modern-circle-shape-linkedin-profile-picture-WAhofEY5L1U.jpg"
                                        alt="User Avatar"
                                        class="w-full h-full rounded-full object-cover"
                                    />
                                </div>
                            </div>
                            <div class="ml-2 w-full flex justify-between">
                                <div class="relative">
                                    <p
                                        class="text-sm font-medium text-black dark:text-white"
                                    >
                                        Alice Johnson
                                    </p>
                                    <p
                                        class="text-xs text-gray-500 dark:text-neutral-400 line-clamp-1"
                                    >
                                        Active 10 minutes ago
                                    </p>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <Icon
                                        icon="fluent:video-16-regular"
                                        class="text-md dark:text-white"
                                    />
                                    <Icon
                                        icon="fluent:call-16-regular"
                                        class="text-md dark:text-white"
                                    />
                                    <Icon
                                        icon="solar:menu-dots-bold"
                                        class="text-md dark:text-white"
                                    />
                                </div>
                            </div>
                        </div>
                        <hr
                            class="border border-gray-200 dark:border-slate-800"
                        />
                        <div
                            class="conversation py-2 px-3 mb-3 h-[450px] overflow-y-auto"
                        >
                            <div class="text-center mb-2">
                                <p class="text-xs dark:text-white">Today</p>
                            </div>
                            <div class="flex mb-2">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center text-white sm:h-12 sm:w-12"
                                >
                                    <div class="w-10 h-10 relative">
                                        <img
                                            src="https://marketplace.canva.com/EAFqNrAJpQs/1/0/1600w/canva-neutral-pink-modern-circle-shape-linkedin-profile-picture-WAhofEY5L1U.jpg"
                                            alt="User Avatar"
                                            class="w-full h-full rounded-full object-cover"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="w-7/12 bg-white dark:bg-slate-800 p-2 rounded-2xl"
                                >
                                    <p
                                        class="text-xs text-black dark:text-white mb-1"
                                    >
                                        Hi Frank, we have a problem with Order
                                        #12345. The customer has reported that
                                        they received the wrong item. Can
                                        someone check the fulfillment details
                                        and provide an update? Thanks!
                                    </p>
                                    <img
                                        src="https://i.ebayimg.com/images/g/9MQAAOSw5qxjKJL-/s-l1200.jpg"
                                        class="w-20 rounded-2xl mb-2"
                                    />
                                    <p
                                        class="text-xs text-gray-500 dark:text-neutral-400"
                                    >
                                        08:03
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end mb-2">
                                <div
                                    class="w-7/12 bg-black dark:bg-custom-blue p-2 rounded-2xl"
                                >
                                    <p class="text-xs text-white mb-1">
                                        Hi Alice, Thanks for letting me know.
                                        I’ll check the fulfillment details and
                                        get back to you shortly.
                                    </p>
                                    <p
                                        class="text-xs text-gray-500 dark:text-neutral-400"
                                    >
                                        08:05
                                    </p>
                                </div>
                            </div>
                            <div class="flex mb-2">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center text-white sm:h-12 sm:w-12"
                                >
                                    <div class="w-10 h-10 relative">
                                        <img
                                            src="https://marketplace.canva.com/EAFqNrAJpQs/1/0/1600w/canva-neutral-pink-modern-circle-shape-linkedin-profile-picture-WAhofEY5L1U.jpg"
                                            alt="User Avatar"
                                            class="w-full h-full rounded-full object-cover"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="w-7/12 bg-white dark:bg-slate-800 p-2 rounded-2xl"
                                >
                                    <p
                                        class="text-xs text-black dark:text-white mb-1"
                                    >
                                        Thank you for your prompt attention to
                                        this matter. I appreciate your help in
                                        resolving the issue
                                    </p>
                                    <p
                                        class="text-xs text-gray-500 dark:text-neutral-400"
                                    >
                                        08:06
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr
                            class="border mb-3 border-gray-200 dark:border-slate-800"
                        />
                        <div class="flex items-center gap-x-3 px-3">
                            <Icon
                                icon="iconamoon:attachment-light"
                                class="text-lg dark:text-white"
                            />
                            <Icon
                                icon="solar:microphone-linear"
                                class="text-lg dark:text-white"
                            />
                            <TextInput
                                backgroundColor="bg-white dark:bg-gray-900"
                                id="message"
                                type="text"
                                v-model="form.message"
                                placeholder="Write a message..."
                            />
                            <Icon
                                :icon="
                                    isTyping
                                        ? 'streamline:send-email-solid'
                                        : 'streamline:send-email'
                                "
                                class="text-md dark:text-white"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
