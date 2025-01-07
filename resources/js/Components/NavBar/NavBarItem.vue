<template>
    <Link
        :href="route(item.href)"
        :method="item.href == 'logout' ? 'post' : 'get'"
        as="button"
        v-if="item.href"
        class="w-full text-gray-700 flex justify-between rounded-xl mt-2 items-center p-2 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-black dark:hover:text-white hover:shadow mt-2"
        :class="
            route().current() == item.href || checkActive(item)
                ? 'bg-gray-200 dark:bg-gray-700 shadow text-black dark:text-white font-bold'
                : 'text-gray-700 dark:text-slate-400'
        "
    >
        <div class="item flex items-center items-left">
            <Icon
                :icon="
                    route().current() == item.href || checkActive(item)
                        ? item.icon.active
                        : item.icon.default
                "
                data-inline="false"
            />
            <span class="ms-3 flex-grow">{{ item.label }}</span>
        </div>
    </Link>
    <Disclosure
        v-slot="{ open }"
        :default-open="checkActive(item)"
        v-else
    >
        <DisclosureButton
            class="w-full flex justify-between items-center items-left p-2 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-black dark:hover:text-white hover:shadow mt-2"
            :class="[
                open || checkActive(item)
                    ? 'bg-gray-200 dark:bg-gray-700 shadow text-black dark:text-white font-bold rounded-t-xl'
                    : 'text-gray-700 dark:text-slate-400 rounded-xl mt-2',
            ]"
        >
            <div class="item flex items-center">
                <Icon
                    :icon="
                        route().current() == item.href || checkActive(item)
                            ? item.icon.active
                            : item.icon.default
                    "
                />
                <span class="ms-3 flex-grow">{{ item.label }}</span>
            </div>
            <Icon
                v-if="item.children.length > 0"
                :icon="
                    open || checkActive(item)
                        ? 'solar:alt-arrow-up-linear'
                        : 'solar:alt-arrow-down-linear'
                "
            />
        </DisclosureButton>
        <transition
            enter-active-class="transition transition-[max-height] duration-500 ease-in"
            enter-from-class="transform max-h-0"
            enter-to-class="transform max-h-screen"
            leave-active-class="transition transition-[max-height] duration-50 ease-out"
            leave-from-class="transform max-h-screen"
            leave-to-class="transform max-h-0"
        >
            <DisclosurePanel
                class="bg-gray-100 dark:bg-gray-800 text-sm rounded-b-xl shadow overflow-hidden"
            >
                <ul class="text-sm text-gray-700 dark:text-slate-400">
                    <template
                        v-for="child in item.children"
                        :key="child.href"
                    >
                        <Link
                            :href="route(child.href)"
                            v-if="child.label"
                            class="block p-2 pl-8 hover:bg-gray-200 hover:text-black dark:hover:bg-gray-700 dark:hover:text-white"
                            :class="
                                route().current(child.href) ||
                                checkActive(child)
                                    ? 'bg-gray-200 dark:bg-gray-700 dark:text-white'
                                    : ''
                            "
                        >
                            {{ child.label }}
                        </Link>
                        <li v-else>
                            <a
                                href="#"
                                class="block p-2 pl-4 hover:bg-gray-200 hover:text-black"
                            >
                                {{ child.label }}
                            </a>
                        </li>
                    </template>
                </ul>
            </DisclosurePanel>
        </transition>
    </Disclosure>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    item: {
        type: Object,
    },
});

const checkActive = (item) => {
    return item.routes.some((url) => url == route().current());
};
</script>

<style scoped></style>
