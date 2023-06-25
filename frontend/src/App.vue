<script setup>
import { RouterView } from 'vue-router'
import HeaderBar from './components/HeaderBar.vue'
</script>

<template>
  <HeaderBar/>
  <RouterView />
</template>

<style lang="scss">
@import '@/assets/sass/style.scss';
</style>

<style scoped>
body{
  margin: 0;
}
</style>
