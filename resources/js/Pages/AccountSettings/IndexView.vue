<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { useToastStore } from "@/Stores/toast";
import { Icon } from "@iconify/vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const user = usePage().props.auth.user;
const toastStore = useToastStore();
const inputImage = ref(null);
const currentImage = ref(user.profile_picture);
const scrollPosition = ref(0);

const form = useForm({
    username: user.username,
    full_name: user.full_name,
    email_address: user.email_address,
    profile_picture: user.profile_picture,
});

const securityForm = useForm({
    current_password: "",
    new_password: "",
    retype_password: "",
});

const nav = ref([
    {
        label: "Account Settings",
        href: null,
    },
]);

const requestUpdate = () => {
    scrollPosition.value = window.scrollY;
    form.patch(route("profile.update"), {
        onError: (errors) => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            toastStore.addToast({
                type: "success",
                title: "Profile Infomation has been successfully updated",
            });
        },
        onFinish: () => {
            window.scrollTo(0, scrollPosition.value);
        },
    });
};

const initDropArea = () => {
    if (inputImage.value) {
        inputImage.value.click();
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
                currentImage.value = thisImage.image;
                form.profile_picture = thisImage;
            }
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
};

const removeImage = () => {
    currentImage.value = null;
    form.profile_picture = null;
};

const requestChangePassword = () => {
    scrollPosition.value = window.scrollY;
    securityForm.put(route("password.update"), {
        onError: (errors) => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: (data) => {
            toastStore.addToast({
                type: "success",
                title: "Password has been successfully updated",
            });
            securityForm.reset();
        },
        onFinish: () => {
            window.scrollTo(0, scrollPosition.value);
        },
    });
};
</script>

<template>
    <Head title="Account Settings" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        ACCOUNT SETTINGS
                    </h1>
                    <h2
                        class="text-sm text-gray-600 mb-6 dark:text-neutral-400"
                    >
                        Manage and Update Your Information and Settings
                    </h2>
                </div>
            </div>
            <div
                :class="[
                    'bg-white dark:bg-gray-900 mb-5',
                    form.processing ? 'opacity-50' : '',
                ]"
            >
                <div class="flex flex-wrap items-center">
                    <Icon
                        icon="hugeicons:profile"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        Profile Information
                    </h2>
                </div>
                <hr class="my-3 border border-gray-200 dark:border-slate-800" />
                <form @submit.prevent="requestUpdate">
                    <div
                        class="w-full grid grid-cols-12 gap-3 rounded-2xl pl-8 mb-3"
                    >
                        <div class="col-span-10">
                            <InputLabel
                                specialClass="my-2"
                                value="Profile Picture"
                                :required="true"
                            />
                            <div
                                class="bg-gray-100 dark:bg-slate-900 relative shadow w-24 h-24 p-2 rounded-full"
                            >
                                <div
                                    class="w-full h-full cursor-pointer"
                                    @click="initDropArea()"
                                >
                                    <img
                                        v-if="currentImage"
                                        :src="currentImage"
                                        class="w-full h-full rounded-full object-cover"
                                        alt="Olivia J"
                                    />
                                    <div
                                        class="w-full h-full bg-custom-blue rounded-full flex items-center justify-center"
                                        v-else
                                    >
                                        <Icon
                                            icon="solar:user-linear"
                                            class="text-2xl text-white"
                                        />
                                    </div>
                                    <input
                                        ref="inputImage"
                                        accept=".jpeg, .png, .jpg"
                                        hidden
                                        type="file"
                                        @change="handleFileInputChange()"
                                    />
                                </div>
                                <button
                                    type="button"
                                    class="absolute top-2 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-gray-500 rounded-full"
                                    @click="removeImage()"
                                >
                                    <Icon
                                        icon="iconamoon:close-light"
                                        class="text-lg text-white"
                                    />
                                </button>
                            </div>
                        </div>
                        <div class="col-span-10">
                            <InputLabel
                                specialClass="mt-2"
                                for="fullName"
                                value="Full Name"
                                :required="true"
                            />
                            <TextInput
                                id="fullName"
                                width="w-2/3"
                                type="text"
                                v-model="form.full_name"
                                placeholder="Enter full name"
                            />
                            <InputError :message="form.errors.full_name" />
                        </div>
                        <div class="col-span-10">
                            <InputLabel
                                specialClass="mt-2"
                                for="username"
                                value="Username"
                                :required="true"
                            />
                            <TextInput
                                id="username"
                                width="w-2/3"
                                type="text"
                                v-model="form.username"
                                placeholder="Enter username"
                            />
                            <InputError :message="form.errors.username" />
                        </div>
                        <div class="col-span-10">
                            <InputLabel
                                specialClass="mt-2"
                                for="emailAddress"
                                value="Email Address"
                                :required="true"
                            />
                            <TextInput
                                id="emailAddress"
                                width="w-2/3"
                                type="email"
                                v-model="form.email_address"
                                placeholder="Enter email address"
                            />
                            <InputError :message="form.errors.email_address" />
                        </div>
                    </div>
                    <div class="flex justify-start p-3 gap-x-3 pl-8">
                        <button
                            class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            RESET
                        </button>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="bg-black disabled:opacity-50 dark:bg-custom-blue text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide"
                        >
                            SAVE CHANGES
                        </button>
                    </div>
                </form>
            </div>
            <div
                :class="[
                    'bg-white dark:bg-gray-900',
                    securityForm.processing ? 'opacity-50' : '',
                ]"
            >
                <div class="flex items-center">
                    <Icon
                        icon="solar:lock-linear"
                        class="text-xl text-black dark:text-white mr-3"
                    />
                    <h2
                        class="text-md font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        Change Password
                    </h2>
                </div>
                <hr class="my-3 border border-gray-200 dark:border-slate-800" />
                <form @submit.prevent="requestChangePassword">
                    <div
                        class="w-full grid grid-cols-12 gap-3 rounded-2xl pl-8 mb-3"
                    >
                        <div class="col-span-10">
                            <InputLabel
                                specialClass="mt-2"
                                value="Current Password"
                                for="currentPassword"
                                :required="true"
                            />
                            <TextInput
                                id="currentPassword"
                                width="w-2/3"
                                type="password"
                                v-model="securityForm.current_password"
                                placeholder="Enter current password"
                            />
                            <InputError
                                :message="securityForm.errors.current_password"
                            />
                        </div>
                        <div class="col-span-10">
                            <InputLabel
                                specialClass="mt-2"
                                value="New Password"
                                for="newPassword"
                                :required="true"
                            />
                            <TextInput
                                id="newPassword"
                                width="w-2/3"
                                type="password"
                                v-model="securityForm.new_password"
                                placeholder="Enter new password"
                            />
                            <InputError
                                :message="securityForm.errors.new_password"
                            />
                        </div>
                        <div class="col-span-10">
                            <InputLabel
                                specialClass="mt-2"
                                value="Re-type Password"
                                for="retypePassword"
                                :required="true"
                            />
                            <TextInput
                                id="rettypePassword"
                                width="w-2/3"
                                type="password"
                                v-model="securityForm.retype_password"
                                placeholder="Enter retype password"
                            />
                            <InputError
                                :message="securityForm.errors.retype_password"
                            />
                        </div>
                    </div>
                    <div class="flex justify-start p-3 gap-x-3 pl-8">
                        <button
                            type="reset"
                            class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            RESET
                        </button>
                        <button
                            type="submit"
                            :disabled="securityForm.processing"
                            class="bg-black dark:bg-custom-blue disabled:opacity-50 text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white"
                        >
                            SAVE CHANGES
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
