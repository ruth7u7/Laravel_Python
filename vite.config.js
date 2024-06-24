import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import { react } from 'laravel-mix';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: ['resources/sources/js/app.js'],
            refresh: true,
        }),
    ],
});
