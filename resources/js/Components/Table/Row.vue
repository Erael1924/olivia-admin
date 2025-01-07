<template>
    <tr
        v-for="(row, index) in data1"
        :key="index"
        ref="tableBody"
        :class="index % 2 == 0 ? '' : 'bg-gray-100 dark:bg-gray-700'"
    >
        <slot
            :index="index"
            :row="row"
        ></slot>
    </tr>
</template>

<script setup lang="ts" generic="Data">
import { inject, ref } from "vue";

const tableBody = ref<HTMLInputElement>();

const data1 = inject("somedata");
</script>

<style scoped></style>
