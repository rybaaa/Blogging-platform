import './assets/main.css'
import 'vue3-toastify/dist/index.css'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import Vue3Toasity from 'vue3-toastify'
import { QuillEditor } from '@vueup/vue-quill'

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(Vue3Toasity, {
  autoClose: 5000,
})
app.component('QuillEditor', QuillEditor)
app.mount('#app')
