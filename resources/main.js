import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";
import routes from "~pages"; // Auto-generated routes

import AuthLayout from "@/layouts/AuthLayout.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";

import '@/scss/app.scss'

// Import all of Bootstrap’s JS
import * as bootstrap from 'bootstrap'

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// sinkronisasi meta dari komponen ke route.meta
router.beforeEach((to, from, next) => {
  const pageComp = to.matched[0]?.components?.default;
  if (pageComp) {
    const { title, meta } = pageComp;
    if (title) {
      to.meta.title = title;
    }
    if (meta?.layout) {
      to.meta.layout = meta.layout;
    }
  }

  // fallback default kalau tidak ada
  if (!to.meta.layout) {
    to.meta.layout = "default";
  }
  next();
});

// title handler
router.afterEach((to) => {
  if (to.meta?.title) {
    document.title = `${to.meta.title} | My App`;
  } else {
    document.title = "My App";
  }
});

const app = createApp(App);

app.config.globalProperties.$layouts = {
  auth: AuthLayout,
  default: DefaultLayout,
};

app.use(router);

router.isReady().then(() => {
  app.mount("#app");
});

window.bootstrap = bootstrap
