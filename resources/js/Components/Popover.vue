<template>
    <div class="">
        <Menu
            as="div"
            class="relative inline-block text-left"
        >
            <div>
                <MenuButton>
                    <slot name="title"></slot>
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
                    class="absolute right-0 mt-2 w-96 origin-top-right divide-y divide-gray-100 rounded-2xl bg-white dark:bg-gray-900 shadow-lg ring-1 ring-black/5 focus:outline-none z-50"
                >
                    <div class="p-4">
                        <slot name="content"></slot>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItems } from "@headlessui/vue";
</script>
