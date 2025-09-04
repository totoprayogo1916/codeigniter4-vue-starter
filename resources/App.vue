<script setup>
import { useRoute } from "vue-router";
import { computed } from "vue";

import AuthLayout from "@/layouts/AuthLayout.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";

const route = useRoute();

const layouts = {
  auth: AuthLayout,
  default: DefaultLayout,
};

// ambil langsung dari komponen matched
const layout = computed(() => {
  const comp = route.matched[0]?.components?.default;
  const layoutName =
    (comp && comp.meta?.layout) || route.meta.layout || "default";
  return layouts[layoutName] || layouts.default;
});
</script>

<template>
  <component :is="layout">
    <RouterView v-slot="{ Component }">
      <Transition appear>
        <component :is="Component" />
      </Transition>
    </RouterView>
  </component>
</template>
