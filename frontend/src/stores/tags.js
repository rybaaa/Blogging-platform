import { ref } from 'vue'
import { defineStore } from 'pinia'
import Tags from '@/api/Tags'
import { appStore } from './app'
import { errorsStore } from './errors'
import errorsHandler from '@/utils/errorsHandler'


export const tagsStore = defineStore('tags', () => {
  let tags = ref(null)

  const app = appStore()
  const errors = errorsStore()

  //requests

  async function fetchTags(){
    try {
        const response = await Tags.index()
        tags.value = response.data.data.data
    } catch (error) {
        errorsHandler(error, errors)
    } finally{
        app.setSubmitting('idle')
    }
  }

  return {
    tags,
    fetchTags
  }
})
