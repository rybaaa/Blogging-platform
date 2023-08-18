import { ref } from 'vue'
import { defineStore } from 'pinia'

export const modalStore = defineStore('modal', () => {
  let isLoginModalOpened = ref(false)
  let isRegisterModalOpened = ref(false)

  function openLoginModal() {
    isLoginModalOpened.value = true
  }

  function closeModal() {
    isLoginModalOpened.value = false
    isRegisterModalOpened.value = false
  }

  function openRegisterModal() {
    isRegisterModalOpened.value = true
  }

  return {
    isLoginModalOpened,
    openLoginModal,
    closeModal,
    isRegisterModalOpened,
    openRegisterModal,
  }
})