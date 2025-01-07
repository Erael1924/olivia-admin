<script setup lang="ts">
import PermissionItem from "@/Pages/Role/PermissionItem.vue";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

const moduleToggle = ref([]);

interface Permission {
    id: number;
    module: String;
    children?: Permission[];
}

interface Props {
    permissions: Permission;
    // index: number | any;
    // parentIndex: number | any;
    // mainParentIndex: number | any;
    level: number | any;
    selectedPermission: any;
    // parentDisabled?: Boolean;
    // role: any;
}
const props = defineProps<Props>();
const isOpen = ref<number | null>(null);

const toggle = (index: number) => {
    isOpen.value = isOpen.value === index ? null : index;
};

const update = (id: number) => {
    console.log("BEFORE", props.selectedPermission);
    if (props.selectedPermission.includes(id)) {
        const index = props.selectedPermission.indexOf(id);
        if (index !== -1) {
            props.selectedPermission.splice(index, 1);
        }
    } else {
        props.selectedPermission.push(id);
    }
    console.log("AFTER", props.selectedPermission);
};
const isPermissionSelected = (permissionId: any) => {
    return props.selectedPermission.includes(permissionId);
};
</script>

<template>
    <div class="accordion-item">
        <div
            :class="[
                'w-full accordion-header text-left px-3 py-2 bg-gray-100 dark:bg-slate-700',
            ]"
            :style="{ 'padding-left': 30 * props.level + 'px' }"
        >
            <div class="flex justify-between gap-x-2 items-center">
                <div
                    @click="toggle(permissions.id)"
                    class="flex flex-row gap-x-2 items-center w-full cursor-pointer"
                >
                    <Icon
                        v-if="
                            permissions.children && permissions.children.length
                        "
                        class="cursor-pointer text-black dark:text-white"
                        :icon="
                            isOpen === permissions.id
                                ? 'solar:alt-arrow-up-line-duotone'
                                : 'solar:alt-arrow-down-line-duotone'
                        "
                    />
                    <h2 class="text-md dark:text-white">
                        {{ permissions.module }}
                    </h2>
                </div>
                <Switch
                    :class="
                        isPermissionSelected(permissions.id)
                            ? 'bg-black'
                            : 'bg-gray-500'
                    "
                    @click="update(permissions.id)"
                    class="relative inline-flex h-[16px] w-[36px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                >
                    <span class="sr-only">
                        {{ permissions.module }}
                    </span>
                    <span
                        aria-hidden="true"
                        :class="
                            isPermissionSelected(permissions.id)
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
                v-show="isOpen === permissions.id"
                class="accordion-content rounded-b-2xl"
            >
                <div
                    v-for="(permission, ndx) in permissions.children"
                    :key="ndx"
                >
                    <PermissionItem
                        :permissions="permission"
                        :selectedPermission="selectedPermission"
                        :level="props.level + 1"
                    />
                </div>
            </div>
        </transition>
    </div>
</template>
