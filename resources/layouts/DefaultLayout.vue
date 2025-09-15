<template>
  <!-- <Navbar /> -->

  <div class="main-layout">
    <aside class="sidebar">
      <router-link to="/">Home</router-link>
      <router-link to="/about">About</router-link>
      <router-link to="/login">Login</router-link>
    </aside>
    <main class="content">
      <RouterView />
    </main>
  </div>
</template>

<script setup>
// import Navbar from '@/components/Navbar.vue'
</script>