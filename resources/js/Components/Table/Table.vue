<template>
    <div class="flex flex-wrap items-center gap-x-2 mb-2">
        <button
            class="bg-gray-100 dark:bg-slate-700 dark:text-white border-none p-2 rounded-full shadow mr-2"
        >
            <Icon
                icon="solar:refresh-linear"
                class="text-sm"
            />
        </button>
        <span class="text-xs dark:text-white">Show</span>
        <v-select
            class="min-w-20 bg-gray-100 dark:bg-slate-700 dark:text-white text-xs rounded-2xl"
            @input="changePage(1)"
            v-model="perPage"
            :clearable="false"
            :options="perPageList"
        />
        <span class="text-xs dark:text-white">entries</span>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto min-h-[460px]">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden rounded-2xl">
                    <table class="min-w-full">
                        <thead
                            class="bg-gray-200 border-b border-gray-200 dark:border-neutral-700"
                            ref="tableHeader"
                        >
                            <slot name="columnHeader"></slot>
                        </thead>
                        <tbody
                            class="divide-y divide-gray-200 dark:divide-neutral-700"
                        >
                            <slot :data="data"></slot>
                            <tr
                                v-if="data.length == 0"
                                class="bg-gray-0"
                            >
                                <td
                                    class="whitespace-nowrap py-4 text-sm text-center"
                                    :colspan="
                                        (tableHeader?.childElementCount ?? 0) +
                                        1
                                    "
                                >
                                    No data available
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        class="flex items-center justify-between space-x-1 mt-4"
                        data-hs-datatable-paging=""
                    >
                        <div class="w-50 text-xs dark:text-white">
                            Showing
                            <span>
                                <template v-if="pagination.total == 0">
                                    0
                                </template>
                                <template v-else>
                                    {{
                                        defaultToZero(
                                            (pagination.current_page - 1) *
                                                pagination.per_page +
                                                1
                                        )
                                    }}
                                </template>
                            </span>
                            to
                            <span>
                                {{
                                    defaultToZero(
                                        (pagination.current_page - 1) *
                                            pagination.per_page +
                                            pagination.count
                                    )
                                }}
                            </span>
                            of
                            <span>{{ pagination.total ?? 0 }}</span>
                            entries
                        </div>
                        <div>
                            <Pagination
                                class="justify-end table-pagination"
                                :pagination="pagination"
                                @change="changePage"
                            ></Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts" generic="Data">
import type { IPagination } from "@/interfaces/ApiResponse";
import { useSettingStore } from "@/Stores/settings";
import { Icon } from "@iconify/vue";
import { storeToRefs } from "pinia";
import { provide, ref, toRef } from "vue";
import Pagination from "./Pagination.vue";

const props = defineProps<{
    pagination: IPagination;
    data: Data[];
    hideAction?: boolean;
    preloader?: boolean;
    orderBy?: IOrderBy;
}>();

const tableHeader = ref<HTMLInputElement>();

const settingStore = useSettingStore();
const { perPage } = storeToRefs(settingStore);
const perPageList = [5, 10, 20, 50, 100, 200];

const test = toRef(props, "data");

export interface IOrderBy {
    [key: string]: string;
}

const orderBy = ref({} as IOrderBy);
if (props.orderBy !== undefined && props.orderBy !== null) {
    orderBy.value = props.orderBy;
}

const updateOrderBy = (sortKey: string) => {
    if (sortKey in orderBy.value) {
        if (orderBy.value[sortKey] == "asc") {
            orderBy.value[sortKey] = "desc";
        } else if (orderBy.value[sortKey] == "desc") {
            delete orderBy.value[sortKey];
        } else {
            orderBy.value[sortKey] = "asc";
        }
    } else {
        orderBy.value = { [sortKey]: "asc" };
    }
    emit("orderBy", orderBy.value);
};

provide("somedata", test as any);
provide("orderBy", {
    orderBy,
    updateOrderBy,
});

const currentPage = ref(1);

const emit = defineEmits(["change", "refresh", "export-data", "orderBy"]);

const refresh = () => {
    emit("refresh", (currentPage.value = 1));
};

const changePage = (page: number) => {
    console.log("CALL ME FIRST");
    currentPage.value = page;
    emit("change", page);
};

const defaultToZero = (number: number) => {
    if (isNaN(number)) {
        return 0;
    }
    return number;
};
</script>
