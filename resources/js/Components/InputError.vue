<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div
        v-show="message"
        class="mt-1"
    >
        <p class="text-xs text-red-600">
            {{ message }}
        </p>
    </div>
</template>
