<template>
    <button
        :type="type"
        class="bg-black dark:bg-custom-blue text-white dark:text-white px-4 py-2 text-xs font-semibold rounded-xl focus:outline-none tracking-wide hover:opacity-75 flex items-center justify-center"
    >
        <slot />
    </button>
</template>
<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>
