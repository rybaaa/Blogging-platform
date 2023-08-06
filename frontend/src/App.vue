<script setup>
import { RouterView } from 'vue-router'
import HeaderBar from '@/components/layouts/HeaderBar.vue'
import MainFooter from '@/components/layouts/MainFooter.vue'
import LogIn from '@/components/login/LogIn.vue'
import { appStore } from './stores/app'
import RegisterModal from './components/register/RegisterModal.vue'
import { userStore } from './stores/user'
import { onMounted } from 'vue'

const app = appStore()
const user = userStore()

onMounted(async () => {
  if (localStorage.getItem('token')) {
    await user.me()
  }
})
</script>

<template>
  <HeaderBar />
  <RouterView v-if="user.isLoggedIn" />
  <LogIn v-if="app.isLoginModalOpened" />
  <RegisterModal v-if="app.isRegisterModalOpened" />
  <MainFooter />
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
