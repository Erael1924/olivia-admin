<template>
    <div class="w-full">
        <Menu as="div">
            <div>
                <MenuButton class="w-full">
                    <div
                        class="w-full flex justify-center rounded-xl my-[0.35rem] items-center px-5 py-2 text-sm hover:bg-gray-200 dark:hover:bg-slate-700 hover:text-black dark:hover:text-white hover:shadow"
                        :class="
                            checkActive(item)
                                ? 'bg-gray-200 dark:bg-gray-700 shadow text-black dark:text-white font-bold'
                                : 'text-gray-700 dark:text-slate-400'
                        "
                    >
                        <div class="item flex items-center items-left">
                            <Icon
                                class="text-xl"
                                :icon="
                                    checkActive(item)
                                        ? item.icon.active
                                        : item.icon.default
                                "
                                data-inline="false"
                            />
                        </div>
                    </div>
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-[-10rem] w-56 origin-top-right divide-y divide-gray-100 rounded-2xl bg-white dark:bg-gray-900 shadow-lg ring-1 ring-black/5 focus:outline-none z-50"
                >
                    <div
                        class="px-1 py-1 text-sm text-gray-700 dark:text-slate-400 flex flex-col"
                    >
                        <template
                            v-for="child in item.children"
                            :key="child.href"
                        >
                            <Link
                                :href="route(child.href)"
                                v-if="child.label"
                                class="block px-3 py-2 rounded-2xl hover:bg-gray-200 hover:text-black dark:hover:bg-gray-700 dark:hover:text-white"
                                :class="
                                    route().current(child.href) ||
                                    checkActive(child)
                                        ? 'bg-gray-200 dark:bg-gray-900 dark:text-white'
                                        : ''
                                "
                            >
                                {{ child.label }}
                            </Link>
                            <li v-else>
                                <a
                                    href="#"
                                    class="block px-3 py-2 rounded-2xl hover:bg-gray-200 hover:text-black"
                                >
                                    {{ child.label }}
                                </a>
                            </li>
                        </template>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItems } from "@headlessui/vue";
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
