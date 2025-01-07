<script setup>
import olivia_black from "@/assets/images/olivia-black.png";
import olivia_white from "@/assets/images/olivia-white.png";
import { useSettingStore } from "@/Stores/settings";
import { Link } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";

const settingStore = useSettingStore();
const { theme } = storeToRefs(settingStore);
if (theme.value == "dark") {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-700"
    >
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-10 bg-white dark:bg-gray-900 shadow-md overflow-hidden rounded-2xl"
        >
            <div class="mb-10 flex justify-center">
                <Link
                    href="/"
                    class=""
                >
                    <img
                        :src="theme == 'light' ? olivia_black : olivia_white"
                        class="h-12 me-3 sm:h-12"
                        alt="Olivia J"
                    />
                </Link>
            </div>
            <slot />
        </div>
    </div>
</template>
