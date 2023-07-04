<script setup>
import { RouterView } from 'vue-router'
import HeaderBar from '@/components/layouts/HeaderBar.vue'
import FooterApp from '@/components/layouts/FooterApp.vue'
</script>

<template>
  <HeaderBar />
  <RouterView />
  <FooterApp />
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&family=Lora:wght@400;700&family=Roboto:wght@400;700&display=swap');

body {
  margin: 0;
}
h1,
h2,
h3,
h4,
h5 {
  margin: 0;
}
p {
  margin: 0;
}
* {
  box-sizing: border-box;
}
</style>
