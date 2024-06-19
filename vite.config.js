import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { react } from 'laravel-mix';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
