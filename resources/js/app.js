import "./bootstrap";
import "../css/app.css";

import { createApp, h, reactive } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import 'leaflet/dist/leaflet.css';

// Define reactive state for theme (default: light)
const themeState = reactive({
    isDarkMode: false
});

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => h(App, props)
        })
        .use(plugin)
        .use(ZiggyVue);

        // Watch for changes in the theme and toggle class on body element
        app.config.globalProperties.$toggleTheme = () => {
            themeState.isDarkMode = !themeState.isDarkMode;
            document.body.classList.toggle("dark-mode", themeState.isDarkMode);
            // Save theme to localStorage
            localStorage.setItem("darkMode", themeState.isDarkMode);
        };

        // Load theme from localStorage on app mount
        const savedTheme = localStorage.getItem("darkMode");
        if (savedTheme === "true") {
            themeState.isDarkMode = true;
            document.body.classList.add("dark-mode");
        }

        return app.mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
