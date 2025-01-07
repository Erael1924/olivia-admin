import { createInertiaApp } from "@inertiajs/vue3";
import "@vuepic/vue-datepicker/dist/main.css";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createPinia } from "pinia";
import { createApp, h } from "vue";
import VSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import VueApexCharts from "vue3-apexcharts";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import "../css/app.css";
import "./bootstrap";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueApexCharts)
            .use(createPinia())
            .component("v-select", VSelect)
            .component("QuillEditor", QuillEditor)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
