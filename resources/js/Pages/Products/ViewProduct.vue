<script setup>
import { moneyFormat } from "@/helpers/MoneyHelper";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    result: Object,
    variants: Object,
    options: Object,
});

const nav = ref([
    {
        label: "Products",
        href: "products",
    },
    {
        label: "Create Product",
        href: null,
    },
]);

const variations = ref({});

const getImages = () => {
    props.options.forEach((item) => {
        if (item.hasOwnProperty("images") && item.images.length > 0) {
            let collection = item.images;
            variations.value[item.first_option] = collection;
        }
    });
};

getImages();

const colors = ["#ffffff", "#000000", "#3490dc", "#718096", "#e53e3e"];

const sizes = ["S", "M", "L", "XL", "2XL"];

const thisImage = ref(variations[0]);
const imageVariantSelected = ref("Black");
const imageSelected = ref(0);
const colorSelected = ref(0);
const sizeSelected = ref(0);

const showImage = (index) => {
    thisImage.value = images[index];
    imageSelected.value = index;
};

const selectColor = (index) => {
    colorSelected.value = index;
};

const selectSize = (index) => {
    sizeSelected.value = index;
};
</script>

<style scoped>
.product-details {
    grid-row: span 2;
}
</style>

<template>
    <Head title="View Product" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        VIEW PRODUCT
                    </h1>
                    <h2 class="text-sm text-gray-600 dark:text-slate-400 mb-6">
                        Fill in the Details to Add a New Product
                    </h2>
                </div>
                <div
                    class="filter-action mb-5 flex flex-wrap items-center gap-x-2"
                >
                    <Link
                        :href="route('products')"
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-2xl focus:outline-none tracking-wide hover:opacity-75 flex items-center flex-wrap"
                    >
                        <Icon
                            icon="bitcoin-icons:arrow-left-outline"
                            class="mr-2"
                        />
                        BACK
                    </Link>
                </div>
            </div>
            <div
                class="w-full bg-gray-100 dark:bg-slate-700 grid grid-cols-12 gap-5 mb-4 p-5 rounded-2xl"
            >
                <div
                    class="col-span-12 border-b border-gray-200 dark:border-slate-800 pb-3"
                >
                    <h1 class="text-md dark:text-white">
                        <span class="font-bold mr-2">
                            {{ result.data.name }}
                        </span>
                    </h1>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        COLLECTION
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        {{ result.data.collection.name }}
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        CATEGORY
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        {{ result.data.category.name }}
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        SUB-CATEGORY
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        {{ result.data.sub_category.name }}
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        DATE CREATED
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        21 Aug 2024, 01:09 PM
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        PRICE
                    </p>
                    <p class="text-lg text-semibold dark:text-white">
                        <template v-if="result.data.has_variant == 1">
                            <template
                                v-if="
                                    result.data.min_price ==
                                    result.data.max_price
                                "
                            >
                                ${{ moneyFormat(result.data.min_price) }}
                            </template>
                            <template v-else>
                                ${{ moneyFormat(result.data.min_price) }} - ${{
                                    moneyFormat(result.data.max_price)
                                }}
                            </template>
                        </template>
                        <template v-else>
                            ${{ moneyFormat(result.data.price) }}
                        </template>
                    </p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-1 dark:text-neutral-400">
                        STOCK
                    </p>
                    <p class="text-lg text-semibold dark:text-white">209</p>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-2 dark:text-neutral-400">
                        CURRENT STATUS
                    </p>
                    <span
                        class="bg-black text-white text-xs rounded-2xl py-1 px-2"
                    >
                        Ongoing
                    </span>
                </div>
                <div class="col-span-3">
                    <p class="text-xs text-gray-900 mb-2 dark:text-neutral-400">
                        CREATED BY
                    </p>
                    <div class="flex flex-wrap items-center">
                        <div class="w-8 h-8 relative mr-3">
                            <img
                                src="https://images.ctfassets.net/lh3zuq09vnm2/yBDals8aU8RWtb0xLnPkI/19b391bda8f43e16e64d40b55561e5cd/How_tracking_user_behavior_on_your_website_can_improve_customer_experience.png"
                                alt="User Avatar"
                                class="w-full h-full rounded-full object-cover"
                            />
                        </div>
                        <p class="text-sm text-black dark:text-white">
                            John Michael Boland
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-slate-700 p-5 rounded-2xl mb-5">
                <div class="flex flex-wrap">
                    <Icon
                        icon="carbon:product"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white mb-5"
                    >
                        Product Information
                    </h2>
                </div>
                <div class="mb-5 ml-8 dark:text-white">
                    <p>
                        {{ result.data.description }}
                    </p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li
                            v-for="(item, index) in result.data.details"
                            :key="index"
                        >
                            <span class="font-semibold">
                                {{ item.attribute }}:
                            </span>
                            {{ item.value }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-slate-700 p-5 rounded-2xl mb-5">
                <div class="flex flex-wrap">
                    <Icon
                        icon="carbon:product"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white mb-5"
                    >
                        Product Variations
                    </h2>
                </div>
                <div class="flex flex-col mb-5">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div
                                class="border rounded-lg overflow-hidden dark:border-slate-800"
                            >
                                <table
                                    class="min-w-full divide-y divide-gray-200 dark:divide-slate-800"
                                >
                                    <thead>
                                        <tr
                                            class="text-xs font-medium text-gray-500 uppercase dark:text-slate-400"
                                        >
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-start"
                                            >
                                                #
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-start"
                                            >
                                                SKU
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-center"
                                            >
                                                Variant
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-center"
                                            >
                                                Price
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-center"
                                            >
                                                Stock
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 dark:divide-slate-800"
                                    >
                                        <tr
                                            class="text-sm text-gray-800 dark:text-neutral-200"
                                            v-for="(option, index) in options"
                                            :key="index"
                                        >
                                            <td
                                                class="px-6 py-4 whitespace-nowrap font-medium"
                                            >
                                                {{ index + 1 }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap font-medium"
                                            >
                                                {{ option.sku }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-center text-sm text-gray-800 dark:text-neutral-200"
                                            >
                                                {{ option.first_option }},
                                                {{ option.second_option }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center"
                                            >
                                                ${{ moneyFormat(option.price) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center"
                                            >
                                                {{ option.stock }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <template
                    v-for="(variant, index) in variations"
                    :key="index"
                >
                    <div
                        class="bg-white dark:bg-slate-700 rounded-2xl p-4 mb-4"
                    >
                        <p class="text-sm dark:text-white">
                            {{ index }}
                        </p>
                        <div class="mt-4 flex flex-wrap gap-x-4">
                            <template
                                v-for="(item, imageIndex) in variant"
                                :key="imageIndex"
                            >
                                <div
                                    class="w-24 h-28 bg-gray-100 dark:bg-slate-900 rounded-2xl shadow relative"
                                >
                                    <img
                                        :src="item.image_url"
                                        alt="Front of men&#039;s Basic Tee in black."
                                        class="h-24 w-24 object-cover object-center rounded-2xl lg:h-full lg:w-full"
                                    />
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
