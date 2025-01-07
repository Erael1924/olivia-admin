<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Icon } from "@iconify/vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    username: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login.request"), {
        onFinish: () => form.reset("password"),
    });
};

const isPasswordShown = ref(false);
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 font-medium text-sm text-green-600"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="w-full">
                <InputLabel
                    for="username"
                    value="Username"
                />

                <TextInput
                    id="username"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.username"
                    required
                    autofocus
                    autocomplete="username"
                />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password"
                    value="Password"
                />

                <div class="relative flex items-center">
                    <Icon
                        :icon="
                            isPasswordShown
                                ? 'solar:eye-closed-outline'
                                : 'solar:eye-outline'
                        "
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer dark:text-white"
                        @click="isPasswordShown = !isPasswordShown"
                    />
                    <TextInput
                        id="password"
                        :type="isPasswordShown ? 'text' : 'password'"
                        specialClass="pr-10 mb-1"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                </div>

                <InputError
                    class="mt-2"
                    :message="form.errors.password"
                />
            </div>
            <InputError
                class="mt-2"
                :message="form.errors.username"
            />

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remember"
                    />
                    <span
                        class="ms-2 text-sm text-gray-600 dark:text-neutral-400"
                    >
                        Remember me
                    </span>
                </label>
            </div>

            <div class="mt-5 text-center">
                <button
                    class="w-full bg-black dark:bg-custom-blue text-white px-4 py-2 text-sm font-semibold rounded-xl focus:outline-none tracking-wide hover:opacity-75 text-center mb-2"
                    :disabled="form.processing"
                >
                    LOGIN
                </button>
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 dark:text-neutral-400 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
