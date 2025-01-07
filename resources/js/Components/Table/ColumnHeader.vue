<template>
    <th
        scope="col"
        class="py-1 group text-start font-normal focus:outline-none dark:bg-slate-800"
    >
        <div
            v-if="sortKey != '' && data.length != 0"
            :class="[
                'py-1 px-2.5 items-center border border-transparent text-sm text-gray-500 dark:text-white rounded-md hover:border-gray-300 dark:hover:text-neutral-900 cursor-pointer',
                customClass,
            ]"
            @click.prevent="updateOrderBy(props.sortKey)"
        >
            <slot></slot>
            <Icon
                v-if="sortKey != '' && data.length != 0"
                :icon="sortIcon"
                class="ml-2"
            ></Icon>
        </div>
        <div
            v-else
            :class="[
                'py-1 px-2.5 items-center border border-transparent text-sm text-gray-500 dark:text-white rounded-md',
                customClass,
            ]"
        >
            <slot></slot>
        </div>
    </th>
</template>

<script setup lang="ts">
import { Icon } from "@iconify/vue";
import type { Ref } from "vue";
import { computed, inject } from "vue";

export interface IOrderBy {
    [key: string]: string;
}

type OrderByInject = {
    orderBy: Ref<IOrderBy>;
    updateOrderBy: (sortKey: string) => void;
};

const props = defineProps({
    sortKey: {
        type: String,
        required: false,
        default: "",
    },
    customClass: {
        type: String,
        required: false,
        default: "inline-flex",
    },
});

const data = inject("somedata") as any;

const sortIcon = computed(() => {
    if (props.sortKey in orderBy.value) {
        if (orderBy.value[props.sortKey] == "asc") {
            return "system-uicons:arrow-up";
        } else if (orderBy.value[props.sortKey] == "desc") {
            return "system-uicons:arrow-down";
        }
    }
    return "fluent:arrow-sort-20-regular";
});

const { orderBy, updateOrderBy } = inject("orderBy") as OrderByInject;
</script>
