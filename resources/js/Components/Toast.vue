<template>
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div
        aria-live="assertive"
        class="fixed inset-0 flex items-start px-4 py-6 sm:items-start sm:p-6 z-[1000] inline-table"
    >
        <div class="flex w-full flex-col items-center space-y-4 sm:items-start">
            <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->

            <template
                v-for="(toast, key) in toasts"
                :key="key"
            >
                <transition
                    enter-active-class="transform ease-out duration-300"
                    enter-from-class="translate-y-0 opacity-0 sm:translate-y-0 sm:translate-x-0"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-300"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        :class="[
                            'toast text-white shadow p-4 rounded-xl',
                            toast.type === 'success' ? 'bg-black' : '',
                            toast.type === 'error' ? 'bg-red-500' : '',
                            toast.type === 'warning' ? 'bg-gray-500' : '',
                            toast.type === 'info' ? 'bg-custom-blue' : '',
                        ]"
                    >
                        <div
                            class="toast-header flex justify-between items-center"
                        >
                            <div class="flex flex-wrap items-center">
                                <Icon
                                    :icon="icons[toast.type]"
                                    class="text-2xl text-white dark:text-white mr-3"
                                />
                                <div class="flex flex-col">
                                    <p v-if="toast.title">
                                        {{ toast.title }}
                                    </p>
                                </div>
                            </div>
                            <Icon
                                icon="iconamoon:close"
                                class="text-xl text-white dark:text-white ml-3 cursor-pointer"
                                @click="close(key)"
                            />
                        </div>
                    </div>
                </transition>
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useToastStore } from "@/Stores/toast";
import { Icon } from "@iconify/vue";
import { storeToRefs } from "pinia";
const toastStore = useToastStore();
const { toasts } = storeToRefs(toastStore);

const close = (key: number) => {
    toastStore.deleteToast(key);
};

const icons = {
    success: "solar:check-circle-linear",
    error: "ep:warning",
    warning: "solar:shield-warning-linear",
    info: "fluent:info-16-regular",
};
</script>
