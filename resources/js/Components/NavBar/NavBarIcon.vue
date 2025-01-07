<template>
    <Link
        v-if="item.href"
        :href="item.href"
        class="w-full flex justify-center rounded-xl items-center my-[0.35rem] px-5 py-2 text-sm hover:bg-gray-200 dark:hover:bg-slate-700 hover:text-black dark:hover:text-white hover:shadow"
        :class="
            route().current() == item.href || checkActive(item)
                ? 'bg-gray-200 dark:bg-gray-700 shadow text-black dark:text-white font-bold'
                : 'text-gray-700 dark:text-slate-400'
        "
    >
        <div class="item">
            <Icon
                class="text-xl lg:4xl xl:5xl"
                :icon="
                    route().current() == item.href || checkActive(item)
                        ? item.icon.active
                        : item.icon.default
                "
                data-inline="false"
            />
        </div>
    </Link>
    <template v-else>
        <NavDropdown :item="item"></NavDropdown>
    </template>
</template>

<script setup>
import NavDropdown from "@/Components/NavBar/NavDropdown.vue";
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
