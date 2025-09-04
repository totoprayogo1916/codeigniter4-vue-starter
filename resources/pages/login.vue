<template>
  <div class="login">
    <h1>Selamat datang di Login</h1>
    <p>Ini adalah halaman login.vue (route "/login").</p>
    <router-link to="/">Ke halaman utama</router-link>
  </div>
</template>

<script>
export default {
  title: "Login",
  meta: {
      layout: "auth",
  }
};
</script>
