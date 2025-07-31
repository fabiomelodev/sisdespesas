import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/css/filament.css"],
            refresh: true,
        }),
        VitePWA({
            registerType: "autoUpdate",
            manifest: {
                name: "Minha Aplicação",
                short_name: "App",
                start_url: "/",
                display: "standalone",
                background_color: "#ffffff",
                theme_color: "#0d6efd",
                icons: [
                    {
                        src: "/images/icons/icon-192x192.png",
                        sizes: "192x192",
                        type: "image/png",
                    },
                    {
                        src: "/images/icons/icon-512x512.png",
                        sizes: "512x512",
                        type: "image/png",
                    },
                ],
            },
        }),
    ],
});
