<template>
  <div class="about">
    <h1>Selamat datang di about</h1>
    <p>Ini adalah halaman about.vue (route "/").</p>
    <router-link to="/">Ke halaman utama</router-link>
  </div>
</template>

<script>
export default {
  title: "About"
}
</script>

<style scoped>
.about {
  text-align: left;
  margin-top: 90px;
}
</style>
