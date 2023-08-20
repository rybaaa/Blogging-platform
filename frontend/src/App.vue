<script setup>
import { RouterView, useRoute } from 'vue-router'
import HeaderBar from '@/components/layouts/HeaderBar.vue'
import MainFooter from '@/components/layouts/MainFooter.vue'
import LogIn from '@/components/login/LogIn.vue'
import { modalStore } from './stores/modal'
import RegisterModal from './components/register/RegisterModal.vue'
import GlobalLoader from '@/components/layouts/GlobalLoader.vue'
import SubscriptionModal from './components/subscription_modal/SubscriptionModal.vue'

const modal = modalStore()
const route = useRoute()
</script>

<template>
  <HeaderBar />
  <RouterView :key="route.fullPath" v-slot="{ Component }">
    <template v-if="Component">
      <Transition mode="out-in">
        <KeepAlive>
          <Suspense>
            <!-- main content -->
            <component :is="Component"></component>

            <!-- loading state -->
            <template #fallback>
              <GlobalLoader />
            </template>
          </Suspense>
        </KeepAlive>
      </Transition>
    </template>
  </RouterView>
  <LogIn v-if="modal.isLoginModalOpened" />
  <RegisterModal v-if="modal.isRegisterModalOpened" />
  <SubscriptionModal v-if="modal.isSubscriptionModalOpened" />
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
