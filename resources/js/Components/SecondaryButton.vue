<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button
        :type="type"
        class="bg-gray-100 dark:bg-slate-800 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-xl focus:outline-none tracking-wide hover:bg-black hover:text-white flex items-center justify-center"
    >
        <slot />
    </button>
</template>
