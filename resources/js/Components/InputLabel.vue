<script setup>
defineProps({
    value: {
        type: String,
    },
    required: {
        type: Boolean,
        default: false,
    },
    specialClass: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <label
        class="block font-medium text-sm text-gray-900 dark:text-neutral-400"
        :class="[specialClass]"
    >
        <span v-if="value">{{ value }}</span>
        <span v-if="required">*</span>
        <span v-else><slot /></span>
    </label>
</template>
