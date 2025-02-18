import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/bootstrap/bootstrap.scss'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/state',  // Customize the output directory
        emptyOutDir: true,        // Clear the output directory before building
    },
});
