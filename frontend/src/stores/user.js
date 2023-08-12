import { ref } from 'vue'
import { defineStore } from 'pinia'
import User from '@/api/User'
import { appStore } from './app'
import { successAlert, errorAlert } from '../utils/alerts'
import { errorsStore } from './errors'
import { modalStore } from './modal'
import errorsHandler from '@/utils/errorsHandler'
import router from '@/router/index'
import mercedes from '@/assets/images/mercedes.png'

export const userStore = defineStore('user', () => {
  let user = ref({
    id: null,
    name: null,
    email: null,
    avatar: null,
    articles: null,
  })
  let isLoggedIn = ref(false)
  let defaultAvatar = ref(mercedes)

  const app = appStore()
  const modal = modalStore()
  const errors = errorsStore()

  //requests

  async function registerUser(values) {
    app.setSubmitting('isLoading')
    errors.eraseErrors()
    try {
      const response = await User.register(values)
      localStorage.setItem('token', response.data.token)
      modal.closeModal()
      successAlert('You have been registered!')
    } catch (error) {
      errorsHandler(error, errors)
    } finally {
      app.setSubmitting('idle')
    }
  }

  async function login(params) {
    app.setSubmitting('isLoading')
    errors.eraseErrors()
    try {
      const response = await User.login(params)
      localStorage.setItem('token', response.data.token)
      modal.closeModal()
      isLoggedIn.value = true
      successAlert('You logged in!')
      me()
    } catch (error) {
      errorsHandler(error, errors)
    } finally {
      app.setSubmitting('idle')
    }
  }

  async function me() {
    app.setSubmitting('isLoading')
    try {
      const response = await User.me()
      setUserInfo(
        response.data.id,
        response.data.name,
        response.data.email,
        response.data.avatar
      )
      isLoggedIn.value = true
    } catch (error) {
      errorAlert('You are not logged in!')
    } finally {
      app.setSubmitting('idle')
    }
  }

  async function logout() {
    app.setSubmitting('isLoading')
    try {
      const response = await User.logout()
      successAlert(response.data.message)
      localStorage.removeItem('token')
      setUserInfo(null, null, null, null, null)
      isLoggedIn.value = false
      router.push({ name: 'home' })
    } catch (error) {
      errorAlert('Something went wrong')
    } finally {
      app.setSubmitting('idle')
    }
  }

  async function update(data) {
    app.setSubmitting('isLoading')
    try {
      const response = await User.update(user.value.id, data)
      updateUserInfo(response.data.data.name, response.data.data.email)
      successAlert(response.data.message)
    } catch (error) {
      errorAlert(error.response.data.message)
      errors.setErrors(error)
    } finally {
      app.setSubmitting('idle')
    }
  }

  //updating state

  function setUserInfo(id, name, email, avatar, articles) {
    user.value.id = id
    user.value.email = email
    user.value.name = name
    user.value.avatar = avatar
    user.value.articles = articles
  }

  function updateUserInfo(name, email) {
    user.value.email = email
    user.value.name = name
  }

  function changeAvatar(avatar) {
    user.value.avatar = avatar
  }

  return {
    registerUser,
    login,
    user,
    isLoggedIn,
    me,
    logout,
    update,
    changeAvatar,
    defaultAvatar
  }
})
