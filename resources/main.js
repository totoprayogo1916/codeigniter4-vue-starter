import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";
import routes from "~pages"; // Auto-generated routes

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// ambil title dari komponen aktif
router.afterEach((to) => {
  const nearestWithTitle = to.matched
    .slice()
    .reverse()
    .find((r) => r.components?.default?.title);

  if (nearestWithTitle) {
    document.title = `${nearestWithTitle.components.default.title} | My App`;
  } else {
    document.title = "My App";
  }
});

createApp(App).use(router).mount("#app");
