import { ref } from 'vue'
import { defineStore } from 'pinia'

export const modalStore = defineStore('modal', () => {
  let isLoginModalOpened = ref(false)
  let isRegisterModalOpened = ref(false)
  let isSubscriptionModalOpened = ref(false)
  let isCancelSubscriptionOpened = ref(false)
  
  function openLoginModal() {
    isLoginModalOpened.value = true
  }

  function closeModal() {
    isLoginModalOpened.value = false
    isRegisterModalOpened.value = false
    isSubscriptionModalOpened.value = false
    isCancelSubscriptionOpened.value = false
  }

  function openRegisterModal() {
    isRegisterModalOpened.value = true
  }

  function openSubscriptionModal(){
    isSubscriptionModalOpened.value = true
  }

  function openCancelSubscriptionModal(){
    isCancelSubscriptionOpened.value = true
  }

  return {
    isLoginModalOpened,
    openLoginModal,
    closeModal,
    isRegisterModalOpened,
    openRegisterModal,
    isSubscriptionModalOpened,
    openSubscriptionModal,
    isCancelSubscriptionOpened,
    openCancelSubscriptionModal
  }
})
