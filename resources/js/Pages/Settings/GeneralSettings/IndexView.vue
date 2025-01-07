<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { useToastStore } from "@/Stores/toast";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    settings: Object,
});

const data = props.settings.reduce((acc, { field_name, value }) => {
    acc[field_name] = value;
    return acc;
}, {});

const toastStore = useToastStore();
const logoLightImage = ref(null);
const logoDarkImage = ref(null);
const logoLight = ref(data.company_logo_light);
const logoDark = ref(data.company_logo_dark);

const companyProfile = useForm({
    company_logo_light: data.company_logo_light,
    company_logo_dark: data.company_logo_dark,
    company_name: data.company_name,
    company_email_address: data.company_email_address,
    contact_number: data.contact_number,
    description: data.description,
});

const socialMedia = useForm({
    facebook: data.facebook,
    instagram: data.instagram,
    x: data.x,
    tiktok: data.tiktok,
});

const maintenance = useForm({
    maintenance_mode_message: data.maintenance_mode_message,
    maintenance_start_date: data.maintenance_start_date,
    maintenance_start_time: data.maintenance_start_time,
    affected_platform: data.affected_platform,
});

const platformOptions = ref([
    { label: "All", value: "all" },
    { label: "Website", value: "website" },
    { label: "Back Office", value: "back-office" },
]);

const updateCompanyProfile = () => {
    companyProfile.post(route("general-settings.company-profile"), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            toastStore.addToast({
                type: "success",
                title: "Company profile has been successfully updated.",
            });
        },
    });
};

const updateSocialMedia = () => {
    socialMedia.post(route("general-settings.social-media"), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            toastStore.addToast({
                type: "success",
                title: "Social media has been successfully updated.",
            });
        },
    });
};

const updateMaintenance = () => {
    maintenance.post(route("general-settings.maintenance"), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            toastStore.addToast({
                type: "success",
                title: "Maintenance has been successfully updated.",
            });
        },
    });
};

const initLightDropArea = () => {
    if (logoLightImage.value) {
        logoLightImage.value.click();
    }
};

const initDarkDropArea = () => {
    if (logoDarkImage.value) {
        logoDarkImage.value.click();
    }
};

const handleFileInputChangeLight = () => {
    const fileInput = logoLightImage.value;

    if (fileInput.files) {
        const reader = new FileReader();

        reader.onload = (e) => {
            if (e.target && fileInput.files) {
                let thisImage = {
                    name: fileInput.files[0].name,
                    image: e.target.result,
                    size: (fileInput.files[0].size / 1024).toFixed(2),
                };
                logoLight.value = thisImage.image;
                companyProfile.company_logo_light = thisImage;
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
};

const handleFileInputChangeDark = () => {
    const fileInput = logoDarkImage.value;

    if (fileInput.files) {
        const reader = new FileReader();

        reader.onload = (e) => {
            if (e.target && fileInput.files) {
                let thisImage = {
                    name: fileInput.files[0].name,
                    image: e.target.result,
                    size: (fileInput.files[0].size / 1024).toFixed(2),
                };
                logoDark.value = thisImage.image;
                companyProfile.company_logo_dark = thisImage;
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
};

const removeLightImage = () => {
    logoLight.value = null;
    form.company_logo_light = null;
};

const removeDarkImage = () => {
    logoDark.value = null;
    form.company_logo_dark = null;
};

const nav = ref([
    {
        label: "General Settings",
        href: null,
    },
]);
</script>

<template>
    <Head title="General Settings" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        GENERAL SETTINGS
                    </h1>
                    <h2
                        class="text-sm text-gray-600 mb-6 dark:text-neutral-400"
                    >
                        Manage and Update Company Information and Settings
                    </h2>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900">
                <div class="flex flex-wrap items-center">
                    <Icon
                        icon="hugeicons:profile"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        Company Profile
                    </h2>
                </div>
                <hr class="my-3 border border-gray-200 dark:border-slate-800" />
                <div
                    :class="[
                        'w-full grid grid-cols-12 gap-3 rounded-2xl',
                        maintenance.processing ? 'opacity-50' : '',
                    ]"
                >
                    <div class="col-span-12">
                        <InputLabel
                            specialClass="mb-3"
                            value="Company Logo"
                        />
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            specialClass="mb-3"
                            value="Light"
                            :required="true"
                        />
                    </div>
                    <div class="col-span-10">
                        <!-- <div
                            class="bg-gray-100 relative shadow w-44 h-18 p-2 rounded-2xl"
                        >
                            <img
                                :src="logo"
                                class="w-full h-full"
                                alt="Olivia J"
                            />
                            <button
                                class="absolute top-[-5px] right-[-3px] inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                            >
                                <Icon
                                    icon="iconamoon:close-light"
                                    class="text-lg text-white"
                                />
                            </button>
                        </div> -->
                        <div
                            class="bg-gray-100 dark:bg-slate-900 relative w-44 h-16 rounded-2xl"
                        >
                            <div
                                class="w-full h-full cursor-pointer"
                                @click="initLightDropArea()"
                            >
                                <img
                                    v-if="logoLight"
                                    :src="logoLight"
                                    class="w-full h-full rounded-2xl object-contain"
                                    alt="Olivia J"
                                />
                                <div
                                    class="w-full h-full bg-gray-300 rounded-2xl flex items-center justify-center"
                                    v-else
                                >
                                    <Icon
                                        icon="mage:file-upload"
                                        class="text-2xl text-white"
                                    />
                                </div>
                                <input
                                    ref="logoLightImage"
                                    accept=".jpeg, .png, .jpg"
                                    hidden
                                    type="file"
                                    @change="handleFileInputChangeLight()"
                                />
                            </div>
                            <button
                                type="button"
                                class="absolute -top-2 -right-1 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                @click="removeLightImage()"
                            >
                                <Icon
                                    icon="iconamoon:close-light"
                                    class="text-lg text-white"
                                />
                            </button>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            specialClass="mb-3"
                            value="Dark"
                            :required="true"
                        />
                    </div>
                    <div class="col-span-10">
                        <div class="bg-black relative w-44 h-16 rounded-2xl">
                            <div
                                class="w-full h-full cursor-pointer"
                                @click="initDarkDropArea()"
                            >
                                <img
                                    v-if="logoDark"
                                    :src="logoDark"
                                    class="w-full h-full rounded-2xl object-contain"
                                    alt="Olivia J"
                                />
                                <div
                                    class="w-full h-full bg-gray-300 rounded-2xl flex items-center justify-center"
                                    v-else
                                >
                                    <Icon
                                        icon="mage:file-upload"
                                        class="text-2xl text-white"
                                    />
                                </div>
                                <input
                                    ref="logoDarkImage"
                                    accept=".jpeg, .png, .jpg"
                                    hidden
                                    type="file"
                                    @change="handleFileInputChangeDark()"
                                />
                            </div>
                            <button
                                type="button"
                                class="absolute -top-2 -right-1 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                @click="removeDarkImage()"
                            >
                                <Icon
                                    icon="iconamoon:close-light"
                                    class="text-lg text-white"
                                />
                            </button>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            for="companyName"
                            value="Company Name"
                            :required="true"
                        />
                    </div>
                    <div class="col-span-10">
                        <TextInput
                            id="companyName"
                            width="w-2/3"
                            type="text"
                            v-model="companyProfile.company_name"
                            placeholder="Enter company name"
                        />
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            for="companyEmailAddress"
                            value="Email Address"
                            :required="true"
                        />
                    </div>
                    <div class="col-span-10">
                        <TextInput
                            id="companyEmailAddress"
                            width="w-2/3"
                            type="email"
                            v-model="companyProfile.company_email_address"
                            placeholder="Enter company email address"
                        />
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            for="contactNumber"
                            value="Contact Number"
                            :required="true"
                        />
                    </div>
                    <div class="col-span-10">
                        <TextInput
                            id="contactNumber"
                            width="w-2/3"
                            type="text"
                            v-model="companyProfile.contact_number"
                            placeholder="Enter contact number"
                        />
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            for="description"
                            value="Short Description"
                            :required="true"
                        />
                    </div>
                    <div class="col-span-10">
                        <textarea
                            class="w-2/3 mt-1 bg-gray-100 dark:bg-gray-700 dark:text-white border-none px-4 py-2 text-xs rounded-2xl"
                            id="description"
                            type="text"
                            v-model="companyProfile.description"
                            placeholder="Enter short description"
                            rows="3"
                        ></textarea>
                    </div>
                </div>
                <div class="flex justify-end p-3 gap-x-3">
                    <SecondaryButton @click="companyProfile.reset()">
                        RESET
                    </SecondaryButton>
                    <PrimaryButton @click="updateCompanyProfile">
                        SAVE CHANGES
                    </PrimaryButton>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900">
                <div class="flex flex-wrap items-center">
                    <Icon
                        icon="circum:globe"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        Social Media
                    </h2>
                </div>
                <hr class="my-3 border border-gray-200 dark:border-slate-800" />
                <div
                    :class="[
                        'w-full grid grid-cols-12 gap-3 rounded-2xl',
                        socialMedia.processing ? 'opacity-50' : '',
                    ]"
                >
                    <div class="col-span-2 flex flex-wrap items-center">
                        <span
                            class="bg-black shadow-md rounded-full w-8 h-8 flex items-center justify-center mr-3"
                        >
                            <Icon
                                icon="basil:facebook-outline"
                                class="text-white text-xl"
                            />
                        </span>
                        <InputLabel
                            value="Facebook"
                            for="facebook"
                        />
                    </div>
                    <div class="col-span-10">
                        <TextInput
                            width="w-2/3"
                            type="text"
                            v-model="socialMedia.facebook"
                            placeholder="Enter facebook url"
                        />
                        <InputError :message="socialMedia.errors.facebook" />
                    </div>

                    <div class="col-span-2 flex flex-wrap items-center">
                        <span
                            class="bg-black shadow-md rounded-full w-8 h-8 flex items-center justify-center mr-3"
                        >
                            <Icon
                                icon="mdi:instagram"
                                class="text-white text-xl"
                            />
                        </span>
                        <InputLabel
                            value="Instagram"
                            for="instagram"
                        />
                    </div>
                    <div class="col-span-10">
                        <TextInput
                            id="instagram"
                            width="w-2/3"
                            type="text"
                            v-model="socialMedia.instagram"
                            placeholder="Enter instagram url"
                        />
                        <InputError :message="socialMedia.errors.instagram" />
                    </div>

                    <div class="col-span-2 flex flex-wrap items-center">
                        <span
                            class="bg-black shadow-md rounded-full w-8 h-8 flex items-center justify-center mr-3"
                        >
                            <Icon
                                icon="ri:twitter-x-fill"
                                class="text-white text-xl"
                            />
                        </span>
                        <InputLabel
                            value="X"
                            for="x"
                        />
                    </div>
                    <div class="col-span-10">
                        <TextInput
                            id="x"
                            width="w-2/3"
                            type="text"
                            v-model="socialMedia.x"
                            placeholder="Enter x url"
                        />
                    </div>
                    <div class="col-span-2 flex flex-wrap items-center">
                        <span
                            class="bg-black shadow-md rounded-full w-8 h-8 flex items-center justify-center mr-3"
                        >
                            <Icon
                                icon="akar-icons:tiktok-fill"
                                class="text-white text-xl"
                            />
                        </span>
                        <InputLabel
                            value="Tiktok"
                            for="tiktok"
                        />
                    </div>
                    <div class="col-span-10">
                        <TextInput
                            id="tiktok"
                            width="w-2/3"
                            type="text"
                            v-model="socialMedia.tiktok"
                            placeholder="Enter tiktok url"
                        />
                        <InputError :message="socialMedia.errors.tiktok" />
                    </div>
                </div>
                <div class="flex justify-end p-3 gap-x-3">
                    <SecondaryButton @click="socialMedia.reset()">
                        RESET
                    </SecondaryButton>
                    <PrimaryButton @click="updateSocialMedia">
                        SAVE CHANGES
                    </PrimaryButton>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900">
                <div class="flex flex-wrap items-center">
                    <Icon
                        icon="hugeicons:license-maintenance"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        Schedule Maintenance
                    </h2>
                </div>
                <hr class="my-3 border border-gray-200 dark:border-slate-800" />
                <div
                    :class="[
                        'w-full grid grid-cols-12 gap-3 rounded-2xl',
                        maintenance.processing ? 'opacity-50' : '',
                    ]"
                >
                    <div class="col-span-2">
                        <InputLabel
                            for="maintenanceMode"
                            value="Maintenance Mode Message"
                            :required="true"
                        />
                    </div>
                    <div class="col-span-10">
                        <textarea
                            class="w-2/3 mt-1 bg-gray-100 dark:bg-gray-700 dark:text-white border-none px-4 py-2 text-xs rounded-2xl"
                            id="maintenanceMode"
                            type="text"
                            v-model="maintenance.maintenance_mode_message"
                            placeholder="Enter maintenance mode message"
                            rows="3"
                        ></textarea>
                        <InputError
                            :message="
                                maintenance.errors.maintenance_mode_message
                            "
                        />
                    </div>
                    <div class="col-span-2">
                        <InputLabel value="Maintenance Start Date & Time" />
                    </div>
                    <div class="col-span-10">
                        <div class="w-2/3">
                            <TextInput
                                width="w-1/2"
                                type="date"
                                v-model="maintenance.maintenance_start_date"
                                placeholder="Select maintenance start date"
                            />
                            <InputError
                                :message="
                                    maintenance.errors.maintenance_start_date
                                "
                            />
                            <TextInput
                                width="w-1/2"
                                type="time"
                                v-model="maintenance.maintenance_start_time"
                                placeholder="Select maintenance start time"
                            />
                            <InputError
                                :message="
                                    maintenance.errors.maintenance_start_time
                                "
                            />
                        </div>
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            value="Affected Platform"
                            for="affectedPlatform"
                        />
                    </div>
                    <div class="col-span-10">
                        <v-select
                            id="affectedPlatform"
                            class="!w-2/3 form-control bg-gray-100 dark:bg-slate-700 text-xs !p-0 mt-1"
                            v-model="maintenance.affected_platform"
                            :get-option-label="(option) => option.label"
                            :reduce="(option) => option.value"
                            :clearable="false"
                            :options="platformOptions"
                        />
                        <InputError
                            :message="maintenance.errors.affected_platform"
                        />
                    </div>
                </div>
                <div class="flex justify-end p-3 gap-x-3">
                    <SecondaryButton @click="maintenance.reset()">
                        RESET
                    </SecondaryButton>
                    <PrimaryButton @click="updateMaintenance">
                        SAVE CHANGES
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
