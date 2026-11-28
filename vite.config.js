import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        chunkSizeWarningLimit: 3000,
    },
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
                silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'if-function'],
            },
        },
        devSourcemap: true,
    },
    plugins: [
        laravel({
            input: ['resources/scss/public.scss', 'resources/scss/admin.scss', 'resources/js/public.js', 'resources/js/admin.js', 'resources/js/admin/theme-switcher.ts'],
            refresh: true,
            assets: ['resources/images/**'],
        }),
        vue({
            template: {
                compilerOptions: {
                    isCustomElement: (tag) => tag.startsWith('cropper-'),
                },
            },
        }),
    ],
    resolve: {
        dedupe: ['@codemirror/autocomplete', '@codemirror/language', '@codemirror/state', '@codemirror/view', '@lezer/common', '@lezer/highlight'],
        preserveSymlinks: true, // false = resolve symlinks (this is the default but be explicit)
    },
    server: {
        watch: {
            followSymlinks: true, // make the HMR watcher follow symlinks
        },
    },
});
