<template>
    <!-- whitespace-nowrap px-3 py-4 text-sm text-gray-500 -->
    <td
        :class="[
            'p-3 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200',
            customClass,
        ]"
    >
        <slot></slot>
    </td>
</template>

<script setup lang="ts">
defineProps({
    customClass: {
        type: String,
        required: false,
        default: "",
    },
});
</script>

<style scoped></style>
