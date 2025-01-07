<template>
    <div class="w-50 flex flex-wrap">
        <button
            type="button"
            class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 dark:text-white hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
            :disabled="pagination.current_page == 1"
            @click.prevent="changePage(1)"
        >
            <Icon
                icon="solar:double-alt-arrow-left-linear"
                class="text-xs"
            />
            <span class="sr-only">First Page</span>
        </button>
        <button
            type="button"
            class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 dark:text-white hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
            :disabled="pagination.current_page == 1"
            @click.prevent="previousPage"
        >
            <Icon
                icon="solar:alt-arrow-left-line-duotone"
                class="text-xs"
            />
            <span class="sr-only">Previous Page</span>
        </button>
        <div
            class="flex items-center space-x-1 [&amp;>.active]:bg-gray-100 dark:[&amp;>.active]:bg-neutral-700"
            data-hs-datatable-paging-pages=""
        >
            <button
                v-for="page in pages()"
                type="button"
                :data-page="page.name"
                :disabled="page.isDisabled"
                @click.prevent="changePage(page.name)"
                :class="[
                    'min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-xs rounded-full disabled:pointer-events-none dark:text-white dark:focus:bg-neutral-700 dark:hover:bg-neutral-700',
                    pagination.current_page == page.name
                        ? 'bg-gray-100 dark:bg-slate-800'
                        : '',
                ]"
                class=""
            >
                {{ page.name }}
            </button>
        </div>
        <button
            type="button"
            class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 disabled"
            :disabled="pagination.current_page == pagination.total_pages"
            @click.prevent="nextPage"
        >
            <Icon
                icon="solar:alt-arrow-right-line-duotone"
                class="text-xs"
            />
            <span class="sr-only">Next Page</span>
        </button>
        <button
            :disabled="pagination.current_page == pagination.total_pages"
            @click.prevent="changePage(pagination.total_pages)"
            type="button"
            class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
        >
            <span class="sr-only">Last Page</span>
            <Icon
                icon="solar:double-alt-arrow-right-linear"
                class="text-xs"
            />
        </button>
    </div>
</template>

<script setup lang="ts">
import type { IPagination } from "@/interfaces/ApiResponse";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

interface Props {
    pagination: IPagination;
    maxVisibleButton?: number;
}

const props = defineProps<Props>();
const emit = defineEmits(["change"]);

const maxVisibleButtons: number = props.maxVisibleButton ?? 5;

const nextPage = () => {
    if (props.pagination.current_page < props.pagination.total_pages) {
        changePage(props.pagination.current_page + 1);
    }
};
const previousPage = () => {
    if (props.pagination.current_page > 1) {
        changePage(props.pagination.current_page - 1);
    }
};

const startPage = (): number => {
    // When on the first page
    if (props.pagination.current_page === 1) {
        return 1;
    }

    // When on the last page
    if (props.pagination.current_page === props.pagination.total_pages) {
        return props.pagination.total_pages - maxVisibleButtons + 1;
    }

    // When inbetween

    if (
        props.pagination.current_page + maxVisibleButtons >
        props.pagination.total_pages + 1
    ) {
        const forward =
            props.pagination.total_pages - props.pagination.current_page;
        const back = maxVisibleButtons - forward;
        const start = props.pagination.current_page - back;
        return start + 1;
    }
    return props.pagination.current_page - 1;
};

const pages = (): any => {
    const start = startPage() < 1 ? 1 : startPage();
    const range = [];
    for (
        let i = start;
        i <=
        Math.min(start + maxVisibleButtons - 1, props.pagination.total_pages);
        i++
    ) {
        range.push({
            name: i,
            isDisabled: i === props.pagination.current_page,
        });
    }

    return range;
};

const pageManualInput = ref(null as number | null);

const changePage = (page: number) => {
    pageManualInput.value = null;
    emit("change", page);
};
</script>
