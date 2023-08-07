import { ref } from 'vue'
import { defineStore } from 'pinia'

export const appStore = defineStore('app', () => {
  let status = ref('idle')

  function setSubmitting(value){
    status.value = value
  }

  return { status, setSubmitting }
})
