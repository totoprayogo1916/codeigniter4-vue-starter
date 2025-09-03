import { defineConfig, loadEnv } from "vite";
import vue from "@vitejs/plugin-vue";
import path from "path";
import Pages from "vite-plugin-pages";
import { build } from "esbuild";

export default defineConfig(() => {
  const env = loadEnv(null, process.cwd());

  return {
    plugins: [vue(), Pages()],
    build: {
      emptyOutDir: false,
      outDir: "public",
      assetsDir: 'build',
      manifest: true,
      minify: true,
      rollupOptions: {
        input: `./${env.VITE_RESOURCES_DIR}/${env.VITE_ENTRY_FILE}`,
      },
    },
	publicDir: false,
    server: {
      origin: env.VITE_ORIGIN,
      port: env.VITE_PORT,
      strictPort: true,
    },
    resolve: {
      alias: {
        "@": path.resolve(__dirname, `./${env.VITE_RESOURCES_DIR}`),
      },
    },
  };
});
