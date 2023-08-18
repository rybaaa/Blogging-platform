import { ref } from 'vue'
import { defineStore } from 'pinia'

export const errorsStore = defineStore('errors', () => {
  let errors = ref({})

  function eraseErrors() {
    errors.value = {}
  }

  function setErrors(newErrors) {
    errors.value = newErrors
  }

  function getError(key) {
    return errors.value[key]? errors.value[key][0] : null
  }

  return { errors, eraseErrors, setErrors, getError }
})
