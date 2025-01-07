<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { useToastStore } from "@/Stores/toast";
import { Icon } from "@iconify/vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    collections: Object,
    categories: Object,
    sub_categories: Object,
    tags: Object,
});

const addVariantModalShow = ref(false);
const addOptionModalShow = ref(false);
const inputImage = ref(null);
const thumbnail = ref(null);
const toastStore = useToastStore();
const variantIndex = ref(null);
const optionName = ref(null);
const variantName = ref(null);
const customVariantName = ref(null);
const showCustomVariant = ref(false);
const productImage = ref(null);
const variants = ref([]);
const variantsInfo = ref([]);
const showVariantError = ref(false);
const showOptionError = ref(false);

const variantOptions = [
    { label: "Color", value: "Color" },
    { label: "Size", value: "Size" },
    { label: "Gender", value: "Gender" },
    { label: "Custom Variant", value: "Custom Variant" },
];

const collectionOptions = ref([]);
collectionOptions.value = props.collections.map((item) => ({
    value: item["id"],
    label: item["name"],
}));

const categoryOptions = ref([]);
categoryOptions.value = props.categories.map((item) => ({
    value: item["id"],
    label: item["name"],
}));

const subCategoryOptions = ref([]);
subCategoryOptions.value = props.sub_categories.map((item) => ({
    value: item["id"],
    label: item["name"],
}));

const tagOptions = ref([]);
tagOptions.value = props.tags.map((item) => ({
    value: item["id"],
    label: item["name"],
}));

const form = useForm({
    form: 1,
    thumbnail: null,
    collection: null,
    category: null,
    sub_category: null,
    tags: [],
    product_code: null,
    product_name: null,
    description: null,
    has_variant: 0,
    price: null,
    stock: null,
    product_images: [],
    product_details: [
        {
            attribute: "Material",
            value: "",
        },
        {
            attribute: "Fit",
            value: "",
        },
        {
            attribute: "Neckline",
            value: "",
        },
        {
            attribute: "Sleeve Style",
            value: "",
        },
        {
            attribute: "Care Instructions",
            value: "",
        },
    ],
    weight: null,
    width: null,
    length: null,
    height: null,
    variants: [],
    variants_info: [],
});

const variantImages = ref([]);

const setFileInputRef = (index) => (el) => {
    if (el) {
        variantImages.value[index] = el;
    }
};

const initDropArea = () => {
    if (inputImage.value) {
        inputImage.value.click();
    }
};

const initProductImageDropArea = () => {
    if (productImage.value) {
        productImage.value.click();
    }
};

const handleFileInputChange = () => {
    const fileInput = inputImage.value;

    if (fileInput.files) {
        const reader = new FileReader();

        reader.onload = (e) => {
            if (e.target && fileInput.files) {
                let thisImage = {
                    name: fileInput.files[0].name,
                    image: e.target.result,
                    size: (fileInput.files[0].size / 1024).toFixed(2),
                };
                thumbnail.value = thisImage.image;
                form.thumbnail = thisImage;
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
};

const handleProductImageFileInputChange = () => {
    const fileInput = productImage.value;

    if (fileInput.files) {
        const reader = new FileReader();

        reader.onload = (e) => {
            if (e.target && fileInput.files) {
                let thisImage = {
                    name: fileInput.files[0].name,
                    image: e.target.result,
                    size: (fileInput.files[0].size / 1024).toFixed(2),
                };
                form.product_images.push(thisImage);
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
};

const initVariantDropArea = (index) => {
    if (variantImages.value[index]) {
        variantImages.value[index].click();
    }
};

const handleFileInputChangeVariant = (index) => {
    const fileInput = variantImages.value[index];
    if (fileInput.files) {
        const reader = new FileReader();

        reader.onload = (e) => {
            if (e.target && fileInput.files) {
                let thisImage = {
                    name: fileInput.files[0].name,
                    image: e.target.result,
                    size: (fileInput.files[0].size / 1024).toFixed(2),
                };
                variants.value[0].options[index].images.push(thisImage);
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
};

const removeImage = () => {
    thumbnail.value = null;
    form.thumbnail = null;
};

const create = () => {
    form.variants = variants.value;
    form.variants_info = variantsInfo.value;
    form.post(route("products.create"), {
        preserveScroll: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            if (form.form == 1 || (form.form == 2 && form.has_variant == 1)) {
                form.form++;
                if (form.has_variant == 1) {
                    setupVariation();
                }
            } else {
                toastStore.addToast({
                    type: "success",
                    title: "Product has been successfully created",
                });
            }
        },
    });
};

const removeAttribute = (index) => {
    form.product_details.splice(index, 1);
};

const addAttribute = () => {
    form.product_details.push({
        attribute: "",
        value: "",
    });
};

const removeVariantImage = (index, optionIndex, imageIndex) => {
    if (variants.value[index].options[optionIndex].images[imageIndex]) {
        variants.value[index].options[optionIndex].images.splice(imageIndex, 1);
    } else {
        console.log(`No image found at index ${key}`);
    }
};

const removeProductImage = (imageIndex) => {
    if (form.product_images[imageIndex]) {
        form.product_images.splice(imageIndex, 1);
    } else {
        console.log(
            `No image found at index ${imageIndex} of form.product_images`
        );
    }
};

const addVariantShow = () => {
    showVariantError.value = false;
    addVariantModalShow.value = true;
};

const addOption = (index) => {
    variantIndex.value = index;
    addOptionModalShow.value = true;
    showOptionError.value = false;
};
const saveOption = () => {
    if (optionName.value) {
        let newOption = {
            name: optionName.value,
            images: [],
        };

        variants.value[variantIndex.value].options.push(newOption);
        optionName.value = null;
        addOptionModalShow.value = false;
    } else {
        showOptionError.value = true;
    }
};

const removeVariantOption = (index, optionIndex) => {
    variants.value[index].options.splice(optionIndex, 1);
};

const removeVariant = (index) => {
    variants.value.splice(index, 1);
};

const handleVariantChange = () => {
    if (variantName.value == "Custom Variant") {
        showCustomVariant.value = true;
    } else {
        showCustomVariant.value = false;
    }
};

const saveVariant = () => {
    if (variantName.value) {
        let name =
            variantName.value == "Custom Variant"
                ? customVariantName.value
                : variantName.value;

        let newVariant = {
            name: name,
            options: [],
        };

        variants.value.push(newVariant);

        addVariantModalShow.value = false;
        variantName.value = null;
        showCustomVariant.value = false;
    } else {
        showVariantError.value = true;
    }
};

const setupVariation = () => {
    let firstVariant = variants.value[0].options; // Array of first variant options
    let secondVariant = variants.value[1].options; // Array of second variant options
    console.log(firstVariant);
    console.log(secondVariant);

    // Ensure variantInfo is initialized as an array
    variantsInfo.value = [];

    for (let x = 0; x < firstVariant.length; x++) {
        let arr = [];
        for (let y = 0; y < secondVariant.length; y++) {
            arr.push({ price: null, stock: null });
        }
        console.log(arr);
        variantsInfo.value.push(arr);
    }
};

const hasVariantChange = () => {
    form.price = null;
    form.stock = null;
};

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
</script>

<template>
    <Modal
        title="New Option"
        maxWidth="lg"
        :show="addOptionModalShow"
        @close="addOptionModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="optionName"
                    value="Option Name"
                    :required="true"
                />
                <TextInput
                    id="optionName"
                    type="text"
                    placeholder="Enter option name"
                    v-model="optionName"
                />
                <InputError
                    message="The option name is required"
                    v-if="showOptionError"
                />
            </div>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <SecondaryButton
                @click="(addOptionModalShow = false), createForm.reset()"
            >
                CANCEL
            </SecondaryButton>
            <PrimaryButton @click="saveOption">SAVE</PrimaryButton>
        </div>
    </Modal>
    <Modal
        title="Add Variant"
        maxWidth="lg"
        :show="addVariantModalShow"
        @close="addVariantModalShow = false"
    >
        <div class="modal-body mb-5">
            <div class="mb-3">
                <InputLabel
                    for="selectVariant"
                    value="Select Variant"
                    :required="true"
                />
                <v-select
                    class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                    v-model="variantName"
                    :get-option-label="(option) => option.label"
                    :reduce="(option) => option.value"
                    :clearable="false"
                    :options="variantOptions"
                    id="selectVariant"
                    @update:modelValue="handleVariantChange()"
                />
                <TextInput
                    v-if="showCustomVariant"
                    type="text"
                    placeholder="Enter variation name"
                    v-model="customVariantName"
                />
                <InputError
                    message="The variant name is required"
                    v-if="showVariantError"
                />
            </div>
        </div>
        <div class="modal-footer flex flex-wrap gap-x-2">
            <SecondaryButton
                @click="
                    (addVariantModalShow = false),
                        (variantName = null),
                        (customVariantName = null)
                "
            >
                CANCEL
            </SecondaryButton>
            <PrimaryButton @click="saveVariant">SAVE</PrimaryButton>
        </div>
    </Modal>
    <Head title="Create Product" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        CREATE PRODUCT
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
                    <PrimaryButton
                        @click="create"
                        v-if="form.form != 3"
                    >
                        NEXT
                        <Icon
                            icon="bitcoin-icons:arrow-right-outline"
                            class="ml-2"
                        />
                    </PrimaryButton>
                    <PrimaryButton
                        @click="create"
                        v-if="form.form == 3"
                    >
                        SAVE
                        <Icon
                            icon="bitcoin-icons:arrow-right-outline"
                            class="ml-2"
                        />
                    </PrimaryButton>
                </div>
            </div>
            {{ form }}
            <div
                v-if="form.form == 1"
                class="w-full grid grid-cols-12 gap-4 mb-4"
            >
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-3 xl:col-span-3"
                >
                    <div
                        class="bg-gray-100 dark:bg-gray-700 rounded-2xl p-4 mb-3"
                    >
                        <h1 class="font-bold dark:text-white text-md mb-3">
                            Thumbnail
                        </h1>
                        <div
                            class="bg-gray-100 dark:bg-gray-700 border border-dashed border-gray-500 p-2 text-center items-center rounded-2xl cursor-pointer w-full h-72 flex items-center"
                        >
                            <div
                                class="w-full h-full flex flex-col justify-center items-center"
                                v-if="!thumbnail"
                                @click="initDropArea"
                            >
                                <button
                                    class="bg-gray-800 dark:bg-slate-800 text-white shadow px-2 py-2 mb-4 rounded-full focus:outline-none"
                                >
                                    <Icon
                                        icon="mage:file-upload"
                                        class="text-2xl"
                                    />
                                </button>
                                <span
                                    class="text-black dark:text-white block font-bold text-sm mb-2"
                                >
                                    Drop files here or click to upload
                                </span>
                                <p
                                    class="text-gray-600 dark:text-neutral-400 text-xs"
                                >
                                    Accepted Format: JPEG and PNG
                                </p>
                                <p
                                    class="text-gray-600 dark:text-neutral-400 text-xs"
                                >
                                    Max Filesize: 2000KB
                                </p>
                                <input
                                    ref="inputImage"
                                    accept=".jpeg, .png, .jpg"
                                    hidden
                                    type="file"
                                    @change="handleFileInputChange()"
                                />
                            </div>
                            <div
                                class="relative w-full h-full rounded-2xl"
                                v-else
                            >
                                <div class="w-full h-full">
                                    <img
                                        :src="thumbnail"
                                        class="w-full h-full rounded-2xl object-contain"
                                    />
                                </div>
                                <button
                                    type="button"
                                    class="absolute -top-3 -right-3 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                    @click="removeImage()"
                                >
                                    <Icon
                                        icon="iconamoon:close-light"
                                        class="text-lg text-white"
                                    />
                                </button>
                            </div>
                        </div>
                        <InputError :message="form.errors.thumbnail" />
                    </div>
                    <div
                        class="border border-gray-200 dark:border-slate-800 rounded-2xl p-4"
                    >
                        <h1 class="font-bold text-md mb-3 dark:text-white">
                            Product Category
                        </h1>
                        <hr
                            class="my-3 border border-gray-200 dark:border-slate-800"
                        />
                        <div class="mb-3">
                            <InputLabel
                                for="collection"
                                value="Collection"
                                :required="true"
                            />
                            <v-select
                                class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                                v-model="form.collection"
                                :get-option-label="(option) => option.label"
                                :reduce="(option) => option.value"
                                :clearable="false"
                                :options="
                                    collectionOptions.filter(
                                        (option) => option.value !== null
                                    )
                                "
                                id="collection"
                            />
                            <InputError :message="form.errors.collection" />
                        </div>
                        <div class="mb-3">
                            <InputLabel
                                for="category"
                                value="Category"
                                :required="true"
                            />
                            <v-select
                                class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                                v-model="form.category"
                                :get-option-label="(option) => option.label"
                                :reduce="(option) => option.value"
                                :clearable="false"
                                :options="
                                    categoryOptions.filter(
                                        (option) => option.value !== null
                                    )
                                "
                                id="category"
                            />
                            <InputError :message="form.errors.category" />
                        </div>
                        <div class="mb-3">
                            <InputLabel
                                for="subcategory"
                                value="Sub-Category"
                                :required="true"
                            />
                            <v-select
                                class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                                v-model="form.sub_category"
                                :get-option-label="(option) => option.label"
                                :reduce="(option) => option.value"
                                :clearable="false"
                                :options="
                                    subCategoryOptions.filter(
                                        (option) => option.value !== null
                                    )
                                "
                                id="subcategory"
                            />
                            <InputError :message="form.errors.sub_category" />
                        </div>
                        <div class="mb-3">
                            <InputLabel
                                for="tags"
                                value="Tags"
                            />
                            <v-select
                                class="form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                                v-model="form.tags"
                                :get-option-label="(option) => option.label"
                                :reduce="(option) => option.value"
                                :clearable="false"
                                :options="
                                    tagOptions.filter(
                                        (option) => option.value !== null
                                    )
                                "
                                multiple
                                id="tags"
                            />
                            <InputError :message="form.errors.tags" />
                        </div>
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-9 xl:col-span-9"
                >
                    <div
                        class="border border-gray-200 dark:border-slate-800 rounded-2xl p-4"
                    >
                        <div>
                            <h1 class="font-bold text-md dark:text-white">
                                General
                            </h1>
                            <hr
                                class="my-3 border border-gray-200 dark:border-slate-800"
                            />
                            <div class="mb-3">
                                <InputLabel
                                    for="productName"
                                    value="Product Name"
                                    :required="true"
                                />
                                <TextInput
                                    id="productName"
                                    type="text"
                                    v-model="form.product_name"
                                    placeholder="Enter product name"
                                />
                                <InputError
                                    :message="form.errors.product_name"
                                />
                            </div>
                            <div class="mb-3">
                                <InputLabel
                                    for="description"
                                    value="Description"
                                    :required="true"
                                />
                                <textarea
                                    class="w-full mt-1 bg-gray-100 dark:bg-slate-700 border-none px-4 py-2 text-xs rounded-2xl"
                                    id="description"
                                    type="text"
                                    v-model="form.description"
                                    placeholder="Enter product description"
                                    rows="7"
                                ></textarea>
                                <InputError
                                    :message="form.errors.description"
                                />
                            </div>

                            <h1 class="font-bold text-md dark:text-white mt-5">
                                Product Information
                            </h1>
                            <p
                                class="text-sm text-gray-700 dark:text-neutral-400 mb-5"
                            >
                                In the Attribute column, enter the name of the
                                attribute (e.g., Material, Neckline, Sleeve
                                Style) and in the Value column, enter the
                                corresponding value (e.g., Cotton, Crew Neck,
                                Short Sleeve).
                            </p>
                            <hr
                                class="my-3 border border-gray-200 dark:border-slate-800"
                            />
                            <div class="flex items-center gap-x-3">
                                <h5
                                    class="w-4/12 font-bold text-sm mb-3 dark:text-white"
                                >
                                    Attribute
                                </h5>
                                <h5
                                    class="w-7/12 font-bold text-sm mb-3 dark:text-white"
                                >
                                    Value
                                </h5>
                                <h5
                                    class="w-1/12 font-bold text-sm mb-3 dark:text-white text-center"
                                >
                                    Action
                                </h5>
                            </div>
                            <div>
                                <template
                                    v-for="(
                                        attribute, index
                                    ) in form.product_details"
                                    :key="index"
                                >
                                    <div class="mb-3 flex gap-x-3">
                                        <div class="w-4/12">
                                            <TextInput
                                                type="text"
                                                placeholder="Enter attribute"
                                                v-model="
                                                    form.product_details[index]
                                                        .attribute
                                                "
                                            />
                                            <div
                                                v-if="
                                                    form.errors[
                                                        `product_details.${index}.attribute`
                                                    ]
                                                "
                                            >
                                                <InputError
                                                    :message="
                                                        form.errors[
                                                            `product_details.${index}.attribute`
                                                        ]
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div class="w-7/12">
                                            <TextInput
                                                type="text"
                                                placeholder="Enter value"
                                                v-model="
                                                    form.product_details[index]
                                                        .value
                                                "
                                            />
                                            <div
                                                v-if="
                                                    form.errors[
                                                        `product_details.${index}.value`
                                                    ]
                                                "
                                            >
                                                <InputError
                                                    :message="
                                                        form.errors[
                                                            `product_details.${index}.value`
                                                        ]
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div
                                            class="w-1/12 flex justify-center pt-3"
                                            @mouseover="hover = true"
                                            @mouseleave="hover = false"
                                        >
                                            <Icon
                                                icon="solar:trash-bin-trash-linear"
                                                class="text-sm text-black cursor-pointer"
                                                @click="removeAttribute(index)"
                                            />
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div class="flex justify-end">
                                <button
                                    class="bg-black dark:bg-slate-800 text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-center"
                                    @click="addAttribute"
                                >
                                    ADD ROW
                                    <Icon
                                        icon="solar:add-circle-linear"
                                        class="ml-2"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="form.form == 2"
                class="w-full grid grid-cols-12 gap-4"
            >
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-3 xl:col-span-3"
                >
                    <div
                        class="border border-gray-200 dark:border-slate-800 rounded-2xl p-4"
                    >
                        <div>
                            <h1 class="font-bold text-md dark:text-white">
                                Shipping Fee
                            </h1>
                            <hr class="my-3 border border-gray-200" />
                            <p
                                class="text-sm text-gray-700 dark:text-neutral-400 mb-5"
                            >
                                Please provide accurate measurements and weight
                                for your package to ensure precise shipping fee
                                calculations.
                            </p>
                            <h5 class="font-bold text-sm mb-3 dark:text-white">
                                Weight & Dimensions
                            </h5>
                            <div class="mb-3">
                                <InputLabel
                                    for="weight"
                                    value="Weight (g)"
                                    :required="true"
                                />
                                <TextInput
                                    id="weight"
                                    type="number"
                                    v-model="form.weight"
                                    placeholder="Set weight"
                                />
                                <InputError :message="form.errors.weight" />
                            </div>
                            <div class="mb-3">
                                <InputLabel
                                    for="width"
                                    value="Width (cm)"
                                />
                                <TextInput
                                    id="width"
                                    type="number"
                                    v-model="form.width"
                                    placeholder="Set width"
                                />
                                <InputError :message="form.errors.width" />
                            </div>
                            <div class="mb-3">
                                <InputLabel
                                    for="length"
                                    value="Length (cm)"
                                />
                                <TextInput
                                    id="length"
                                    type="number"
                                    v-model="form.length"
                                    placeholder="Set length"
                                />
                                <InputError :message="form.errors.length" />
                            </div>
                            <div class="mb-3">
                                <InputLabel
                                    for="height"
                                    value="Height (cm)"
                                />
                                <TextInput
                                    id="height"
                                    type="number"
                                    v-model="form.height"
                                    placeholder="Set height"
                                />
                                <InputError :message="form.errors.height" />
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-9 xl:col-span-9"
                >
                    <div
                        class="border border-gray-200 dark:border-slate-800 rounded-2xl p-4"
                    >
                        <div>
                            <h1 class="font-bold text-md dark:text-white">
                                Product Variations
                            </h1>
                            <hr
                                class="my-3 border border-gray-200 dark:border-slate-800"
                            />
                            <div class="mb-3">
                                <InputLabel
                                    for="hasVariant"
                                    value="Does the product have variations"
                                    :required="true"
                                    specialClass="mb-3"
                                />
                                <div class="flex gap-x-3">
                                    <label class="flex items-center">
                                        <input
                                            type="radio"
                                            value="1"
                                            v-model="form.has_variant"
                                            @change="hasVariantChange()"
                                        />
                                        <span
                                            class="ms-2 text-sm text-black dark:text-neutral-400"
                                        >
                                            Yes
                                        </span>
                                    </label>
                                    <label class="flex items-center">
                                        <input
                                            type="radio"
                                            value="0"
                                            v-model="form.has_variant"
                                            @change="hasVariantChange()"
                                        />
                                        <span
                                            class="ms-2 text-sm text-black dark:text-neutral-400"
                                        >
                                            No
                                        </span>
                                    </label>
                                </div>
                                <InputError
                                    :message="form.errors.has_variant"
                                />
                            </div>

                            <div
                                class="grid grid-cols-12 gap-x-3 mb-3"
                                v-if="form.has_variant == 0"
                            >
                                <div class="col-span-6">
                                    <InputLabel
                                        for="price"
                                        value="Price"
                                        :required="true"
                                    />
                                    <TextInput
                                        id="productName"
                                        type="number"
                                        v-model="form.price"
                                        placeholder="Enter product price"
                                    />
                                    <InputError :message="form.errors.price" />
                                </div>
                                <div class="col-span-6">
                                    <InputLabel
                                        for="stock"
                                        value="Stock"
                                        :required="true"
                                    />
                                    <TextInput
                                        id="stock"
                                        type="number"
                                        v-model="form.stock"
                                        placeholder="Enter stock"
                                    />
                                    <InputError :message="form.errors.stock" />
                                </div>
                            </div>
                            <div v-if="form.has_variant == 0">
                                <InputLabel
                                    for="productImage"
                                    value="Product Images"
                                    :required="true"
                                />
                                <div class="mt-4 flex flex-wrap gap-x-4">
                                    <div
                                        class="w-24 h-28 bg-white dark:bg-slate-900 border border-dashed border-gray-500 p-4 rounded-2xl shadow text-black dark:text-white text-center"
                                        @click="initProductImageDropArea()"
                                    >
                                        <button
                                            class="bg-gray-800 dark:bg-slate-800 text-white shadow px-2 py-2 mb-3 rounded-full focus:outline-none"
                                        >
                                            <Icon
                                                icon="mage:file-upload"
                                                class="text-lg"
                                            />
                                        </button>
                                        <br />
                                        <span class="font-bold text-xs">
                                            Add Photo
                                        </span>
                                        <input
                                            ref="productImage"
                                            accept=".jpeg, .png, .jpg"
                                            hidden
                                            type="file"
                                            @change="
                                                handleProductImageFileInputChange()
                                            "
                                        />
                                    </div>

                                    <template
                                        v-for="(
                                            images, imageIndex
                                        ) in form.product_images"
                                        :key="imageIndex"
                                    >
                                        <div
                                            class="w-24 h-28 bg-gray-100 dark:bg-slate-900 rounded-2xl shadow relative"
                                        >
                                            <img
                                                :src="images.image"
                                                alt="Front of men&#039;s Basic Tee in black."
                                                class="h-24 w-24 object-cover object-center rounded-2xl lg:h-full lg:w-full"
                                            />
                                            <button
                                                class="absolute top-[-5px] right-[-3px] inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                                @click="
                                                    removeProductImage(
                                                        imageIndex
                                                    )
                                                "
                                            >
                                                <Icon
                                                    icon="iconamoon:close-light"
                                                    class="text-lg text-white"
                                                />
                                            </button>
                                        </div>
                                    </template>
                                </div>
                                <InputError
                                    :message="form.errors.product_images"
                                />
                            </div>
                            <template v-if="form.has_variant == 1">
                                <template
                                    v-for="(variant, index) in variants"
                                    :key="index"
                                >
                                    <div
                                        class="bg-gray-100 dark:bg-slate-700 rounded-2xl p-4 mb-4"
                                    >
                                        <div class="flex justify-between">
                                            <p class="text-sm dark:text-white">
                                                {{ variants[index].name }}
                                            </p>
                                            <button
                                                class="inline-flex items-center -right-2 justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                                @click="removeVariant(index)"
                                            >
                                                <Icon
                                                    icon="iconamoon:close-light"
                                                    class="text-lg text-white"
                                                />
                                            </button>
                                        </div>
                                        <hr
                                            class="my-3 border border-gray-200 dark:border-slate-600"
                                        />
                                        <div class="flex flex-wrap gap-x-4">
                                            <template v-if="index == 0">
                                                <template
                                                    v-for="(
                                                        option, optionIndex
                                                    ) in variant.options"
                                                    :key="optionIndex"
                                                >
                                                    <div
                                                        class="relative inline-block w-full bg-white dark:bg-slate-900 shadow text-black p-4 mb-3 text-xs font-semibold rounded-2xl tracking-wide"
                                                    >
                                                        <span
                                                            class="dark:text-white"
                                                        >
                                                            {{
                                                                variants[index]
                                                                    .options[
                                                                    optionIndex
                                                                ].name
                                                            }}
                                                        </span>
                                                        <div
                                                            class="mt-4 flex flex-wrap gap-x-4"
                                                        >
                                                            <div
                                                                class="w-24 h-28 bg-white dark:bg-slate-900 border border-dashed border-gray-500 p-4 rounded-2xl shadow text-black dark:text-white text-center"
                                                                @click="
                                                                    initVariantDropArea(
                                                                        optionIndex
                                                                    )
                                                                "
                                                            >
                                                                <button
                                                                    class="bg-gray-800 dark:bg-slate-800 text-white shadow px-2 py-2 mb-3 rounded-full focus:outline-none"
                                                                >
                                                                    <Icon
                                                                        icon="mage:file-upload"
                                                                        class="text-lg"
                                                                    />
                                                                </button>
                                                                <br />
                                                                <span
                                                                    class="font-bold text-xs"
                                                                >
                                                                    Add Photo
                                                                </span>
                                                                <input
                                                                    :ref="
                                                                        setFileInputRef(
                                                                            optionIndex
                                                                        )
                                                                    "
                                                                    accept=".jpeg, .png, .jpg"
                                                                    hidden
                                                                    type="file"
                                                                    @change="
                                                                        handleFileInputChangeVariant(
                                                                            optionIndex
                                                                        )
                                                                    "
                                                                />
                                                            </div>
                                                            <template
                                                                v-for="(
                                                                    images,
                                                                    imageIndex
                                                                ) in variants[
                                                                    index
                                                                ].options[
                                                                    optionIndex
                                                                ].images"
                                                                :key="
                                                                    imageIndex
                                                                "
                                                            >
                                                                <div
                                                                    class="w-24 h-28 bg-gray-100 dark:bg-slate-900 rounded-2xl shadow relative"
                                                                >
                                                                    <img
                                                                        :src="
                                                                            images.image
                                                                        "
                                                                        alt="Front of men&#039;s Basic Tee in black."
                                                                        class="h-24 w-24 object-cover object-center rounded-2xl lg:h-full lg:w-full"
                                                                    />
                                                                    <button
                                                                        class="absolute top-[-5px] right-[-3px] inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                                                        @click="
                                                                            removeVariantImage(
                                                                                index,
                                                                                optionIndex,
                                                                                imageIndex
                                                                            )
                                                                        "
                                                                    >
                                                                        <Icon
                                                                            icon="iconamoon:close-light"
                                                                            class="text-lg text-white"
                                                                        />
                                                                    </button>
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div
                                                            v-if="
                                                                form.errors[
                                                                    `variants.${index}.options.${optionIndex}.images`
                                                                ]
                                                            "
                                                        >
                                                            <InputError
                                                                :message="
                                                                    form.errors[
                                                                        `variants.${index}.options.${optionIndex}.images`
                                                                    ]
                                                                "
                                                            />
                                                        </div>
                                                        <button
                                                            class="absolute top-[-5px] right-[-3px] inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                                            @click="
                                                                removeVariantOption(
                                                                    index,
                                                                    optionIndex
                                                                )
                                                            "
                                                        >
                                                            <Icon
                                                                icon="iconamoon:close-light"
                                                                class="text-lg text-white"
                                                            />
                                                        </button>
                                                    </div>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <template
                                                    v-for="(
                                                        options, optionIndex
                                                    ) in variant.options"
                                                    :key="optionIndex"
                                                >
                                                    <div
                                                        class="relative inline-block"
                                                    >
                                                        <span
                                                            class="bg-white shadow text-black px-4 py-2 text-xs font-semibold rounded-full tracking-wide"
                                                        >
                                                            {{
                                                                variants[index]
                                                                    .options[
                                                                    optionIndex
                                                                ].name
                                                            }}
                                                        </span>
                                                        <button
                                                            class="absolute top-[-5px] right-[-3px] inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                                            @click="
                                                                removeVariantOption(
                                                                    index,
                                                                    optionIndex
                                                                )
                                                            "
                                                        >
                                                            <Icon
                                                                icon="iconamoon:close-light"
                                                                class="text-lg text-white"
                                                            />
                                                        </button>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                        <div class="flex justify-end">
                                            <button
                                                class="bg-black text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-center"
                                                @click="addOption(index)"
                                            >
                                                ADD OPTION
                                                <Icon
                                                    icon="solar:add-circle-linear"
                                                    class="ml-2"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </template>
                            <InputError :message="form.errors[`variants`]" />
                            <div
                                class="flex justify-end"
                                v-if="
                                    variants.length < 2 && form.has_variant == 1
                                "
                            >
                                <button
                                    class="bg-black dark:bg-custom-blue text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-center"
                                    @click="addVariantShow"
                                >
                                    ADD VARIANT
                                    <Icon
                                        icon="solar:add-circle-linear"
                                        class="ml-2"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="form.form == 3"
                class="w-full grid grid-cols-12 gap-4 mb-4"
            >
                <div
                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12"
                >
                    <div
                        class="border border-gray-200 dark:border-slate-800 rounded-2xl p-4"
                    >
                        <div>
                            <h1 class="font-bold text-md dark:text-white">
                                Set Variation Info
                            </h1>
                            <hr class="my-3 border border-gray-200" />
                            <p
                                class="text-sm text-gray-700 dark:text-neutral-400 mb-5"
                            >
                                Set Prices and Stock Levels for Each Option
                            </p>
                        </div>
                        {{ variantsInfo }}
                        <div class="w-full grid grid-cols-12 gap-4">
                            <template
                                v-for="(option, optionIndex) in variants[0]
                                    .options"
                                :key="optionIndex"
                            >
                                <div
                                    class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-6 xl:col-span-6 bg-gray-100 dark:bg-slate-700 rounded-2xl p-4 mb-4"
                                >
                                    <div class="flex justify-between">
                                        <p class="text-sm dark:text-white">
                                            {{ option.name }}
                                        </p>
                                    </div>
                                    <hr
                                        class="my-3 border border-gray-200 dark:border-slate-600"
                                    />
                                    <template
                                        v-for="(
                                            secondOption, secondOptionIndex
                                        ) in variants[1].options"
                                        :key="secondOptionIndex"
                                    >
                                        <div
                                            class="mb-3 flex items-center gap-x-3"
                                        >
                                            <div class="w-2/12">
                                                <p
                                                    class="text-sm dark:text-white"
                                                >
                                                    {{ secondOption.name }}
                                                </p>
                                            </div>
                                            <div class="w-5/12">
                                                <TextInput
                                                    type="number"
                                                    placeholder="Enter price"
                                                    backgroundColor="bg-white dark:bg-slate-900"
                                                    v-model="
                                                        variantsInfo[
                                                            optionIndex
                                                        ][secondOptionIndex]
                                                            .price
                                                    "
                                                />
                                            </div>
                                            <div class="w-5/12">
                                                <TextInput
                                                    type="number"
                                                    placeholder="Enter stock"
                                                    backgroundColor="bg-white dark:bg-slate-900"
                                                    v-model="
                                                        variantsInfo[
                                                            optionIndex
                                                        ][secondOptionIndex]
                                                            .stock
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
