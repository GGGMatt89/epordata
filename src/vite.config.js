import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from "@rollup/plugin-inject";

export default defineConfig({
    plugins: [
        inject({
            $: 'jquery',
            jQuery: 'jquery',
        }),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/db_app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
      host: "0.0.0.0",
      hot: true,
      hmr: {
        clientPort: 5173,
      },
      port: 5173,
      watch: {
        usePolling: true,
      },
    },
});
