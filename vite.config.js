import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    optimizeDeps: {
        include: [
            "tinymce",
            "tinymce/themes/silver",
            "tinymce/icons/default",
            "tinymce/plugins/image",
            "tinymce/plugins/link",
            "tinymce/plugins/code",
        ],
    },
});
