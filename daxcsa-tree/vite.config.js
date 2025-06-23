import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
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
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js',
    },
  },
  build: {
    outDir: 'dist',        // <- carpeta de salida
    emptyOutDir: true,     // <- limpia ./dist antes de generar
    manifest: true,        // <- genera manifest.json si lo necesitas
    rollupOptions: {
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
    },
  },
});
