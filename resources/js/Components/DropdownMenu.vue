<template>
    <div class="">
        <Menu
            as="div"
            class="relative inline-block text-left"
        >
            <div>
                <MenuButton
                    class="inline-flex w-full justify-center items-center rounded-2xl bg-gray-100 dark:bg-slate-700 shadow px-2 py-1 text-sm font-medium focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                >
                    <slot name="title"></slot>
                    <Icon
                        icon="solar:alt-arrow-down-linear"
                        class="ml-3 dark:text-white"
                    />
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
                    class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-2xl bg-white dark:bg-gray-900 shadow-lg ring-1 ring-black/5 focus:outline-none z-50"
                >
                    <div class="px-1 py-1">
                        <slot name="content"></slot>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItems } from "@headlessui/vue";
import { Icon } from "@iconify/vue";
</script>
