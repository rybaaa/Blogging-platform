import { ref } from 'vue'
import { defineStore } from 'pinia'


export const errorsStore = defineStore('errors', () => {
    let errors = ref({
        email: '',
        password: '',
        name: ''
    })

    function eraseErrors(){
    errors.value.email = ''
    errors.value.password = ''
    errors.value.name = ''
  }

  function setErrors(e){
    errors.value.email = e.response.data.errors.email? e.response.data.errors.email[0] : ''
    errors.value.name = e.response.data.errors.name? e.response.data.errors.name[0] : ''
    errors.value.password = e.response.data.errors.password? e.response.data.errors.password[0] : ''
  }

  return {errors, eraseErrors, setErrors }
})
