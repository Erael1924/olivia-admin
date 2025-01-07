import { defineStore } from "pinia";
import { ref, watch } from "vue";

export const useSettingStore = defineStore("setting", () => {
    const sidebar = ref(localStorage.getItem("sidebar") ?? "wide");
    const theme = ref(localStorage.getItem("theme") ?? "light");
    const perPage = ref(
        localStorage.getItem("per_page")
            ? parseInt(localStorage.getItem("per_page")!)
            : 10
    );

    watch(sidebar, () => {
        localStorage.setItem("sidebar", sidebar.value);
    });

    watch(theme, () => {
        localStorage.setItem("theme", theme.value);
    });

    watch(perPage, () => {
        localStorage.setItem("per_page", perPage.value.toString());
    });

    return {
        sidebar,
        theme,
        perPage,
    };
});
