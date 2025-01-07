<script setup>
import { Icon } from "@iconify/vue";
import { ref } from "vue";
const props = defineProps({
    products: Object,
});
const perPage = ref(10);
const perPageList = [5, 10, 20, 50, 100, 200];
</script>

<template>
    <div class="flex justify-between items-center">
        <div class="flex flex-wrap items-center gap-x-2 mb-2">
            <button
                class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white border-none p-2 rounded-full shadow mr-2"
            >
                <Icon
                    icon="solar:refresh-linear"
                    class="text-sm"
                />
            </button>
            <span class="text-xs dark:text-white">Show</span>
            <v-select
                class="min-w-20 bg-gray-100 dark:bg-slate-700 dark:text-white text-xs rounded-2xl"
                @change="changePage(1)"
                v-model="perPage"
                :clearable="false"
                :options="perPageList"
            />
            <span class="text-xs dark:text-white">entries</span>
        </div>
        <button
            class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-between"
        >
            SORT
            <Icon
                icon="system-uicons:sort"
                class="ml-2"
            />
        </button>
    </div>

    <div
        class="mt-6 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 gap-x-4 gap-y-4"
    >
        <template
            v-for="(product, index) in products"
            :key="index"
        >
            <div
                class="group relative bg-gray-100 dark:bg-gray-700 rounded-2xl overflow-hidden"
            >
                <div
                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none lg:h-48"
                >
                    <img
                        :src="product.thumbnail"
                        alt="Front of men&#039;s Basic Tee in black."
                        class="h-full w-full object-cover object-center lg:h-full lg:w-full"
                    />
                    <div
                        v-if="index % 2 !== 0"
                        class="absolute top-2 left-0"
                    >
                        <span
                            class="bg-red-500 text-white text-xs shadow-md p-1 rounded-r-full pl-3"
                        >
                            25%
                        </span>
                    </div>
                </div>
                <div class="mt-4 px-4 pb-4">
                    <h3 class="text-sm font-semibold mb-1 dark:text-white">
                        {{ product.name }}
                    </h3>
                    <div
                        class="flex flex-wrap justify-between items-center dark:text-neutral-400"
                    >
                        <p class="text-xs">
                            Stock:
                            <span class="font-semibold">
                                {{ product.stock }}
                            </span>
                        </p>
                        <p class="text-xs">
                            Sold:
                            <span class="font-semibold">
                                {{ product.sold }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
