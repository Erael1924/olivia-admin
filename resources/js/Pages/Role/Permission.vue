<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import PermissionItem from "@/Pages/Role/PermissionItem.vue";
import { useToastStore } from "@/Stores/toast";
import { Icon } from "@iconify/vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    result: Object,
    role_id: Object,
});

const toastStore = useToastStore();
const rolePermissionIDs = ref([]);
rolePermissionIDs.value = props.result.allowed.map(
    (permission) => permission.id
);
const isOpen = ref(null);

const toggle = (index) => {
    isOpen.value = isOpen.value === index ? null : index;
};

const form = useForm({
    permissions: [],
});

const updatePermissions = () => {
    form.permissions = rolePermissionIDs.value;
    form.put(route("permissions.update", { id: props.role_id }), {
        preserveScroll: true,
        onError: () => {
            toastStore.addToast({
                type: "error",
                title: "There was a problem with your submission. Please try again.",
            });
        },
        onSuccess: () => {
            toastStore.addToast({
                type: "success",
                title: "Role Permissions has been successfully updated.",
            });
            form.role_name = null;
            form.description = null;
            form.status = null;
        },
    });
};

const update = (id) => {
    if (rolePermissionIDs.value.includes(id)) {
        const index = rolePermissionIDs.value.indexOf(id);
        if (index !== -1) {
            rolePermissionIDs.value.splice(index, 1);
        }
    } else {
        rolePermissionIDs.value.push(id);
    }
};

const nav = ref([
    {
        label: "Role Settings",
        href: "roles",
    },
    {
        label: "Assign Permission",
        href: null,
    },
]);

const isPermissionSelected = (permissionId) => {
    return rolePermissionIDs.value.includes(permissionId);
};
</script>

<template>
    <Head title="Assign Permission" />

    <AuthenticatedLayout>
        <HeaderLayout :nav="nav"></HeaderLayout>
        <div
            class="w-full h-full bg-white dark:bg-gray-900 p-5 rounded-2xl shadow"
        >
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="font-bold text-lg dark:text-white">
                        Assign Permission
                    </h1>
                    <h2
                        class="text-sm text-gray-600 mb-6 dark:text-neutral-400"
                    >
                        Define and configure permissions to control what users
                        can view and modify within the system.
                    </h2>
                </div>
                <div
                    class="filter-action mb-5 flex flex-wrap items-center gap-x-2"
                >
                    <Link
                        :href="route('roles')"
                        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-center"
                    >
                        <Icon
                            icon="bitcoin-icons:arrow-left-outline"
                            class="mr-2"
                        />
                        BACK
                    </Link>
                    <PrimaryButton @click="updatePermissions">
                        SAVE
                        <Icon
                            icon="bitcoin-icons:arrow-right-outline"
                            class="ml-2"
                        />
                    </PrimaryButton>
                </div>
            </div>
            <div class="accordion">
                <div
                    v-for="(item, index) in result.permissions"
                    :key="index"
                    class="accordion-item mb-3"
                >
                    <div
                        :class="[
                            'w-full accordion-header text-left px-3 py-2',
                            isOpen === item.id
                                ? 'bg-gray-200 dark:bg-slate-800 rounded-t-2xl'
                                : 'bg-gray-100 dark:bg-slate-700 rounded-2xl',
                        ]"
                    >
                        <div class="flex justify-between gap-x-2 items-center">
                            <div
                                @click="toggle(item.id)"
                                class="flex flex-row gap-x-2 items-center w-full cursor-pointer"
                            >
                                <Icon
                                    v-if="item.children && item.children.length"
                                    class="cursor-pointer text-black dark:text-white"
                                    :icon="
                                        isOpen === index
                                            ? 'solar:alt-arrow-up-line-duotone'
                                            : 'solar:alt-arrow-down-line-duotone'
                                    "
                                />
                                <h2 class="text-md dark:text-white">
                                    {{ item.module }}
                                </h2>
                            </div>
                            <Switch
                                :class="
                                    isPermissionSelected(item.id)
                                        ? 'bg-black'
                                        : 'bg-gray-500'
                                "
                                @click="update(item.id)"
                                class="relative inline-flex h-[16px] w-[36px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                            >
                                <span class="sr-only">
                                    {{ item.module }}
                                </span>
                                <span
                                    aria-hidden="true"
                                    :class="
                                        isPermissionSelected(item.id)
                                            ? 'translate-x-5'
                                            : 'translate-x-0'
                                    "
                                    class="pointer-events-none inline-block h-[12px] w-[12px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
                                />
                            </Switch>
                        </div>
                    </div>
                    <transition name="accordion-transition">
                        <div
                            v-show="isOpen === item.id"
                            class="accordion-content rounded-b-2xl overflow-hidden bg-gray-100"
                        >
                            <div
                                v-for="(permission, ndx) in item.children"
                                :key="ndx"
                            >
                                <PermissionItem
                                    :permissions="permission"
                                    :level="1"
                                    :selectedPermission="rolePermissionIDs"
                                />
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
