<script setup>
import NavBar from "@/Components/NavBar/NavBar.vue";
import Toast from "@/Components/Toast.vue";
// import NavBarSmall from "@/Components/NavBar/NavBarSmall.vue";
import FooterLayout from "@/Layouts/FooterLayout.vue";
import { useSettingStore } from "@/Stores/settings";
import { storeToRefs } from "pinia";

const settingStore = useSettingStore();
const { sidebar, theme } = storeToRefs(settingStore);

if (theme.value == "dark") {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}
</script>

<template>
    <Toast></Toast>
    <div>
        <div class="min-h-screen bg-white dark:bg-gray-700">
            <!-- Page Heading -->
            <header
                class="bg-white dark:bg-gray-700 shadow"
                v-if="$slots.header"
            >
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="bg-white dark:bg-gray-700 h-full">
                <NavBar></NavBar>
                <!-- <NavBarSmall></NavBarSmall> -->
                <div
                    :class="[
                        sidebar === 'wide'
                            ? 'w-full lg:w-5/6 xl:w-5/6 lg:ml-1/6 xl:ml-1/6 mt-20 mb-5 p-5 rounded-b-2xl bg-gray-200 dark:bg-gray-700'
                            : 'w-full lg:w-[94%] xl:w-[94%] lg::ml-[6%] xl:ml-[6%] mt-20 mb-5 p-5 rounded-b-2xl bg-gray-200 dark:bg-gray-700',
                    ]"
                >
                    <slot />
                    <FooterLayout></FooterLayout>
                </div>
            </main>
        </div>
    </div>
</template>
