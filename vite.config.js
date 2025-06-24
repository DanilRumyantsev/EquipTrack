// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

// Импортируем обёртку от Quasar
import { quasar, transformAssetUrls } from "@quasar/vite-plugin";

export default defineConfig({
    plugins: [
        vue({
            // Чтобы автоматически загружать изображения и т.д.
            template: {
                transformAssetUrls,
            },
        }),

        // Подключаем плагин Quasar
        quasar(),

        // Laravel Vite Plugin
        laravel({
            input: ["resources/js/app.js", "resources/css/app.css"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
});
