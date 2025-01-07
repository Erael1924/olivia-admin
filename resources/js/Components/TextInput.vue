<script setup>
import { onMounted, ref } from "vue";
defineProps({
    specialClass: {
        type: String,
        default: "",
    },
    width: {
        type: String,
        default: "w-full",
    },
    backgroundColor: {
        type: String,
        default: "bg-gray-100 dark:bg-slate-700",
    },
});

const model = defineModel({
    type: String,
    required: true,
    value: String,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        :class="[width, specialClass, backgroundColor]"
        class="mt-1 border-none px-4 py-2 text-xs rounded-xl text-black dark:text-white"
        v-model="model"
        ref="input"
    />
</template>
