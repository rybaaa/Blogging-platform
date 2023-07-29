import { ref } from 'vue'
import { defineStore } from 'pinia'

export const appStore = defineStore('app', () => {
  let isLoginModalOpened = ref(false)

  function openLoginModal() {
    isLoginModalOpened.value = true
  }

  function closeLoginModal() {
    isLoginModalOpened.value = false
  }

  return { isLoginModalOpened, openLoginModal, closeLoginModal }
})
