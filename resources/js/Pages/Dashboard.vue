<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeaderLayout from "@/Layouts/HeaderLayout.vue";
import { useSettingStore } from "@/Stores/settings";
import { Icon } from "@iconify/vue";
import { Head } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";
import { ref } from "vue";
import ApexCharts from "vue3-apexcharts";

const settingStore = useSettingStore();
const { theme } = storeToRefs(settingStore);
const barChartInstance = ref(null);

const chartOptions = ref({
    chart: {
        height: 300,
        type: "area",
        toolbar: { show: false },
        zoom: { enabled: false },
    },
    series: [
        {
            name: "2023",
            data: [
                18000, 51000, 60000, 38000, 88000, 50000, 40000, 52000, 88000,
                80000, 60000, 70000,
            ],
        },
        {
            name: "2022",
            data: [
                27000, 38000, 60000, 77000, 40000, 50000, 49000, 29000, 42000,
                27000, 42000, 50000,
            ],
        },
    ],
    legend: { show: false },
    dataLabels: { enabled: false },
    stroke: { curve: "smooth", width: 2 },
    grid: { borderColor: "#6D6D6D", strokeDashArray: 2 },
    fill: {
        type: "gradient",
        gradient: {
            type: "vertical",
            shadeIntensity: 1,
            opacityFrom: 0.1,
            opacityTo: 0.8,
        },
    },
    xaxis: {
        type: "category",
        tickPlacement: "on",
        categories: [
            "15 January",
            "15 February",
            "15 March",
            "15 April",
            "15 May",
            "15 June",
            "15 July",
            "15 August",
            "15 September",
            "15 October",
            "15 November",
            "15 December",
        ],
        axisBorder: { show: false },
        axisTicks: { show: false },
        axisBorder: { color: theme.value == "light" ? "#3D3D3D" : "#FFFFFF" }, // Dark gray for axis border
        axisTicks: { color: theme.value == "light" ? "#3D3D3D" : "#FFFFFF" }, // Dark gray for axis ticks
        crosshairs: { stroke: { dashArray: 0 }, dropShadow: { show: false } },
        tooltip: { enabled: false },
        labels: {
            style: {
                fontSize: "13px",
                fontFamily:
                    'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                fontWeight: 400,
                background: "#2C2C2C",
                color: theme.value == "light" ? "#000000" : "#FFFFFF",
            },
            formatter: (title) => {
                let t = title;
                if (t) {
                    const newT = t.split(" ");
                    t = `${newT[1].slice(0, 3)}`;
                }
                return t;
            },
        },
    },
    yaxis: {
        labels: {
            align: "left",
            minWidth: 0,
            style: {
                fontSize: "13px",
                fontFamily:
                    'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                fontWeight: 400,
            },
            formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
        },
    },
    tooltip: {
        x: { format: "MMMM yyyy" },
        y: {
            formatter: (value) =>
                `$${value >= 1000 ? `${value / 1000}k` : value}`,
            style: {
                color: "#FFFFFF", // White for tooltip text
            },
        },
        style: {
            background: "#2C2C2C", // Dark gray for tooltip background
            fontSize: "12px",
        },
    },
    colors: ["#9ca3af", "#465c9d"],
    responsive: [
        {
            breakpoint: 568,
            options: {
                chart: { height: 300 },
                labels: {
                    style: {
                        colors: "#9ca3af",
                        fontSize: "11px",
                        fontFamily:
                            'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                        fontWeight: 400,
                    },
                    offsetX: -2,
                    formatter: (title) => title.slice(0, 3),
                },
                yaxis: {
                    labels: {
                        align: "left",
                        minWidth: 0,
                        maxWidth: 140,
                        style: {
                            colors: "#9ca3af",
                            fontSize: "11px",
                            fontFamily:
                                'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                            fontWeight: 400,
                        },
                        formatter: (value) =>
                            value >= 1000 ? `${value / 1000}k` : value,
                    },
                },
            },
        },
    ],
});

const chartSeries = ref([
    {
        name: "2023",
        data: [
            18000, 51000, 60000, 38000, 88000, 50000, 40000, 52000, 88000,
            80000, 60000, 70000,
        ],
    },
    {
        name: "2022",
        data: [
            27000, 38000, 60000, 77000, 40000, 50000, 49000, 29000, 42000,
            27000, 42000, 50000,
        ],
    },
]);

const bubbleChartOptions = {
    chart: {
        type: "bubble",
        height: "100%",
        toolbar: {
            show: false,
        },
        zoom: {
            enabled: false,
        },
    },
    series: [
        { data: [[5, 6, 63]] },
        { data: [[8, 4, 27]] },
        { data: [[10, 9, 10]] },
    ],
    dataLabels: {
        style: {
            fontSize: "20px",
            fontFamily:
                'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
            fontWeight: "400",
            colors: ["#fff", "#fff", "#fff"],
        },
        formatter: (value) => (value ? `${value}%` : ""),
    },
    fill: {
        opacity: 1,
    },
    legend: {
        show: false,
    },
    stroke: {
        width: 5,
    },
    plotOptions: {
        bubble: {
            zScaling: false,
            minBubbleRadius: 40,
        },
    },
    grid: {
        show: false,
        padding: {
            top: 0,
            bottom: 0,
            left: 0,
            right: 0,
        },
    },
    xaxis: {
        min: 0,
        max: 15,
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        min: 0,
        max: 15,
        labels: {
            show: false,
        },
    },
    tooltip: {
        enabled: false,
    },
    states: {
        hover: {
            filter: {
                type: "none",
            },
        },
    },
    colors: ["#465c9d", "#8E92A2", "#000000"],
};

const bubbleChartSeries = [
    { data: [[5, 6, 30]] },
    { data: [[8, 4, 10]] },
    { data: [[10, 9, 60]] },
];

const barChartOptions = {
    chart: {
        type: "bar",
        height: 300,
        toolbar: {
            show: false,
        },
        zoom: {
            enabled: false,
        },
    },
    series: [
        {
            name: "Sales",
            data: [23000, 44000, 55000, 57000],
        },
    ],
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "40px",
            borderRadius: 5,
        },
    },
    legend: {
        show: false,
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 8,
        colors: ["transparent"],
    },
    xaxis: {
        categories: ["Women", "Men", "Kids", "Home & Lifestyle"],
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        crosshairs: {
            show: false,
        },
        labels: {
            style: {
                colors: "#9ca3af",
                fontSize: "10px",
                fontFamily:
                    'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                fontWeight: 400,
            },
            offsetX: -2,
            formatter: (title) => title.slice(0, 5),
        },
    },
    yaxis: {
        labels: {
            align: "left",
            minWidth: 0,
            maxWidth: 140,
            style: {
                colors: "#9ca3af",
                fontSize: "13px",
                fontFamily:
                    'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                fontWeight: 400,
            },
            formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
        },
    },
    states: {
        hover: {
            filter: {
                type: "darken",
                value: 0.9,
            },
        },
    },
    tooltip: {
        y: {
            formatter: (value) =>
                `$${value >= 1000 ? `${value / 1000}k` : value}`,
        },
        custom: function (props) {
            const { categories } = props.ctx.opts.xaxis;
            const { dataPointIndex } = props;
            const title = categories[dataPointIndex];
            const newTitle = `${title}`;

            return buildTooltip(props, {
                title: newTitle,
                mode: "dark",
                hasTextLabel: true,
                wrapperExtClasses: "min-w-28",
                labelDivider: ":",
                labelExtClasses: "ms-2",
            });
        },
    },
    colors: ["#465c9d"],
    responsive: [
        {
            breakpoint: 568,
            options: {
                chart: {
                    height: 300,
                },
                plotOptions: {
                    bar: {
                        columnWidth: "30px",
                    },
                },
                stroke: {
                    width: 8,
                },
                labels: {
                    style: {
                        colors: "#9ca3af",
                        fontSize: "11px",
                        fontFamily:
                            'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                        fontWeight: 400,
                    },
                    offsetX: -2,
                    formatter: (title) => title.slice(0, 3),
                },
                yaxis: {
                    labels: {
                        align: "left",
                        minWidth: 0,
                        maxWidth: 140,
                        style: {
                            colors: "#9ca3af",
                            fontSize: "11px",
                            fontFamily:
                                'Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                            fontWeight: 400,
                        },
                        formatter: (value) =>
                            value >= 1000 ? `${value / 1000}k` : value,
                    },
                },
            },
        },
    ],
};

const barChartSeries = [
    {
        name: "Sales",
        data: [230000, 440000, 570000, 530000],
    },
];

function buildTooltip(props, options) {
    return `<div>${options.title}</div>`;
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <HeaderLayout></HeaderLayout>
        <div class="w-full grid grid-cols-12 gap-4 mb-4">
            <div
                class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8"
            >
                <div
                    class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-x-4 gap-y-4 mb-4"
                >
                    <div class="w-full bg-gray-900 rounded-2xl p-4 shadow">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-md text-white">Total Sales</h2>
                            <Icon
                                icon="iconamoon:arrow-top-right-1-thin"
                                class="text-2xl text-white"
                            />
                        </div>
                        <h1 class="text-2xl text-white mb-2">$436.48K</h1>
                        <div>
                            <span
                                class="bg-gray-100 text-black text-xs shadow-md px-2 py-1 rounded-full"
                            >
                                +28%
                            </span>
                            <span class="text-white text-xs ml-2">
                                +23.6K this month
                            </span>
                        </div>
                    </div>
                    <div
                        class="w-full bg-custom-blue dark:bg-custom-blue rounded-2xl p-4 shadow"
                    >
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-md text-white">Total Profits</h2>
                            <Icon
                                icon="iconamoon:arrow-top-right-1-thin"
                                class="text-2xl text-white"
                            />
                        </div>
                        <h1 class="text-2xl text-white mb-2">$257.32K</h1>
                        <div>
                            <span
                                class="bg-gray-100 text-black text-xs shadow-md px-2 py-1 rounded-full"
                            >
                                +18%
                            </span>
                            <span class="text-white text-xs ml-2">
                                +17.6K this month
                            </span>
                        </div>
                    </div>
                    <div
                        class="w-full bg-gray-400 dark:bg-slate-800 rounded-2xl p-4 shadow"
                    >
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-md text-white">Total Orders</h2>
                            <Icon
                                icon="iconamoon:arrow-top-right-1-thin"
                                class="text-2xl text-white"
                            />
                        </div>
                        <h1 class="text-2xl text-white mb-2">50.24K</h1>
                        <div>
                            <span
                                class="bg-gray-100 text-black text-xs shadow-md px-2 py-1 rounded-full"
                            >
                                +25%
                            </span>
                            <span class="text-white text-xs ml-2">
                                +23.6K this month
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full bg-white dark:bg-gray-900 rounded-2xl p-4 shadow mb-4"
                >
                    <div class="mb-5 flex items-center justify-between">
                        <h2 class="text-md text-black dark:text-white">
                            Sales Monitoring
                        </h2>
                        <div
                            class="bg-gray-100 dark:bg-slate-900 rounded-full flex flex-wrap mr-2 p-1"
                        >
                            <button
                                class="bg-gray-200 dark:bg-gray-900 text-black dark:text-white px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black"
                            >
                                Daily
                            </button>
                            <button
                                class="text-black dark:text-slate-400 px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black dark:hover:bg-gray-900 dark:hover:text-white"
                            >
                                Weekly
                            </button>
                            <button
                                class="text-black dark:text-slate-400 px-4 py-2 text-xs font-semibold rounded-full focus:outline-none tracking-wide hover:bg-gray-200 hover:text-black dark:hover:bg-gray-900 dark:hover:text-white"
                            >
                                Monthly
                            </button>
                        </div>
                    </div>
                    <!-- End Legend Indicator -->

                    <ApexCharts
                        type="area"
                        :options="chartOptions"
                        :series="chartSeries"
                        height="300"
                    />
                    <div class="flex justify-center items-center gap-x-4">
                        <div class="inline-flex items-center">
                            <span
                                class="size-2.5 inline-block bg-gray-900 dark:bg-white rounded-full me-2"
                            ></span>
                            <span
                                class="text-[13px] text-gray-600 dark:text-neutral-400"
                            >
                                Sales
                            </span>
                        </div>
                        <div class="inline-flex items-center">
                            <span
                                class="size-2.5 inline-block bg-custom-blue rounded-full me-2"
                            ></span>
                            <span
                                class="text-[13px] text-gray-600 dark:text-neutral-400"
                            >
                                Profit
                            </span>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full bg-white dark:bg-gray-900 rounded-2xl p-4 shadow"
                >
                    <div
                        class="mb-5 flex items-center justify-between text-black dark:text-white"
                    >
                        <h2 class="text-md">Top Products</h2>
                        <Icon
                            icon="iconamoon:arrow-top-right-1-thin"
                            class="text-2xl"
                        />
                    </div>
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div
                                class="p-1.5 min-w-full inline-block align-middle"
                            >
                                <div
                                    class="border rounded-lg overflow-hidden dark:border-slate-800"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-200 dark:divide-slate-800"
                                    >
                                        <thead>
                                            <tr
                                                class="text-xs font-medium text-gray-500 uppercase dark:text-slate-400"
                                            >
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-start"
                                                >
                                                    Product Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-center"
                                                >
                                                    Review
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-center"
                                                >
                                                    Sold
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3 text-center"
                                                >
                                                    Profit
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 dark:divide-slate-800"
                                        >
                                            <tr
                                                class="text-sm text-gray-800 dark:text-neutral-200"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap font-medium"
                                                >
                                                    Urban Chic High-Waisted
                                                    Trousers
                                                </td>
                                                <td
                                                    class="px-6 py-4 text-center text-sm text-gray-800 dark:text-neutral-200"
                                                >
                                                    <span
                                                        class="flex flex-wrap justify-center items-center"
                                                    >
                                                        <Icon
                                                            icon="solar:star-bold"
                                                            class="text-md text-yellow-500 mr-2"
                                                        />
                                                        5.0
                                                    </span>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    202.2K
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    $453.45K
                                                </td>
                                            </tr>

                                            <tr
                                                class="text-sm text-gray-800 dark:text-neutral-200"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap font-medium"
                                                >
                                                    Urban Chic High-Waisted
                                                    Trousers
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    <span
                                                        class="flex flex-wrap justify-center items-center"
                                                    >
                                                        <Icon
                                                            icon="solar:star-bold"
                                                            class="text-md text-yellow-500 mr-2"
                                                        />
                                                        5.0
                                                    </span>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    183.2K
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    $346.82K
                                                </td>
                                            </tr>

                                            <tr
                                                class="text-sm text-gray-800 dark:text-neutral-200"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap font-medium"
                                                >
                                                    Classic Fit Button-Down
                                                    Shirt
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    <span
                                                        class="flex flex-wrap justify-center items-center"
                                                    >
                                                        <Icon
                                                            icon="solar:star-bold"
                                                            class="text-md text-yellow-500 mr-2"
                                                        />
                                                        4.8
                                                    </span>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    202.2K
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    $320.34K
                                                </td>
                                            </tr>

                                            <tr
                                                class="text-sm text-gray-800 dark:text-neutral-200"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap font-medium"
                                                >
                                                    Minimalist Leather Crossbody
                                                    Bag
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    <span
                                                        class="flex flex-wrap justify-center items-center"
                                                    >
                                                        <Icon
                                                            icon="solar:star-bold"
                                                            class="text-md text-yellow-500 mr-2"
                                                        />
                                                        4.5
                                                    </span>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    99.2K
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    $189.73K
                                                </td>
                                            </tr>

                                            <tr
                                                class="text-sm text-gray-800 dark:text-neutral-200"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap font-medium"
                                                >
                                                    Essential Cotton V-Neck Tee
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    <span
                                                        class="flex flex-wrap justify-center items-center"
                                                    >
                                                        <Icon
                                                            icon="solar:star-bold"
                                                            class="text-md text-yellow-500 mr-2"
                                                        />
                                                        5.0
                                                    </span>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    202.2K
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center"
                                                >
                                                    $176.93K
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-4 xl:col-span-4"
            >
                <div
                    class="w-full bg-white dark:bg-gray-900 dark:text-white rounded-2xl p-4 shadow text-center mb-4"
                >
                    <div
                        class="flex items-center justify-between mb-4 dark:text-white"
                    >
                        <h2 class="text-md">Customers Volume</h2>
                        <Icon
                            icon="iconamoon:arrow-top-right-1-thin"
                            class="text-2xl"
                        />
                    </div>
                    <div class="flex justify-center">
                        <div class="w-72 h-44">
                            <svg
                                viewBox="0 0 100 50"
                                class="w-full h-full"
                            >
                                <!-- Background arc -->
                                <path
                                    class="gauge-path stroke-gray-100 dark:stroke-slate-900"
                                    d="M10 40 A30 30 0 0 1 90 40"
                                />
                                <!-- Foreground arc -->
                                <path
                                    class="gauge-path stroke-black dark:stroke-white"
                                    stroke-dasharray="70, 100"
                                    d="M10 40 A30 30 0 0 1 90 40"
                                />
                                <!-- Center text -->
                                <text
                                    x="50%"
                                    y="50%"
                                    text-anchor="middle"
                                    :fill="theme == 'light' ? 'black' : 'white'"
                                    font-size="12"
                                    dy=".3em"
                                >
                                    13.2K
                                </text>
                                <text
                                    x="50%"
                                    y="70%"
                                    class="new-customer"
                                >
                                    New Customer
                                </text>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm">
                        The customer volume has increased of
                        <span
                            class="bg-[#8E92A2] dark:bg-white text-white dark:text-black text-xs shadow-md px-2 py-1 rounded-full"
                        >
                            +25%
                        </span>
                    </p>
                </div>
                <div
                    class="w-full bg-white dark:bg-gray-900 rounded-2xl p-4 shadow mb-4"
                >
                    <h2 class="text-md text-black dark:text-white">Device</h2>
                    <div>
                        <ApexCharts
                            type="bubble"
                            :options="bubbleChartOptions"
                            :series="bubbleChartSeries"
                            height="200"
                        />
                        <div class="flex justify-center items-center gap-x-4">
                            <div class="inline-flex items-center">
                                <span
                                    class="size-2.5 inline-block bg-gray-900 dark:bg-white rounded-full me-2"
                                ></span>
                                <span
                                    class="text-[13px] text-gray-600 dark:text-neutral-400"
                                >
                                    Desktop
                                </span>
                            </div>
                            <div class="inline-flex items-center">
                                <span
                                    class="size-2.5 inline-block bg-[#1e3a8a] rounded-full me-2"
                                ></span>
                                <span
                                    class="text-[13px] text-gray-600 dark:text-neutral-400"
                                >
                                    Mobile
                                </span>
                            </div>
                            <div class="inline-flex items-center">
                                <span
                                    class="size-2.5 inline-block bg-[#8E92A2] rounded-full me-2"
                                ></span>
                                <span
                                    class="text-[13px] text-gray-600 dark:text-neutral-400"
                                >
                                    Others
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full bg-white dark:bg-gray-900 rounded-2xl p-4 shadow"
                >
                    <h2 class="text-md text-black dark:text-white mb-3">
                        Sales per Collection
                    </h2>
                    <div>
                        <ApexCharts
                            type="bar"
                            :options="barChartOptions"
                            :series="barChartSeries"
                            height="300"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.gauge-path {
    fill: none;
    stroke-width: 10;
}

.new-customer {
    font-size: 4px;
    fill: black;
    text-anchor: middle;
}
</style>
