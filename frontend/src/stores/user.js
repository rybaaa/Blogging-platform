import { ref } from 'vue'
import { defineStore } from 'pinia'
import User from '../api/User'
import { appStore } from './app';
import { successAlert, errorAlert } from '../utils/alerts';


export const userStore = defineStore('user', () => {
    let errors = ref({
        email: '',
        password: '',
        name: ''
    })
    const app = appStore()

  async function registerUser(values) {
    app.setSubmitting('isLoading')
    eraseErrors()
    try{
        const response = await User.register(values)
        localStorage.setItem('token', response.data.token)
        app.closeModal()
        successAlert('You have been registered!')
      }
    catch (error){
        setErrors(error)
        errorAlert('Error occured')
    }
    finally{
        app.setSubmitting('idle')
    }
  }

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

  return { registerUser, errors }
})
