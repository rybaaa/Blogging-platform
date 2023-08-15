import { ref } from 'vue'
import { defineStore } from 'pinia'
import Tags from '@/api/Tags'
import { appStore } from './app'
import { errorsStore } from './errors'
import errorsHandler from '@/utils/errorsHandler'
import { articlesStore } from './articles'


export const tagsStore = defineStore('tags', () => {
  let tags = ref(null)
  let tagTitles = ref([])
  let tagsForCurrentArticle = ref(null)

  const app = appStore()
  const articles = articlesStore()
  const errors = errorsStore()

  //requests

  async function fetchTags(search){
    try {
        const response = await Tags.index(search)
        tags.value = response.data.data.data
        tagTitles.value = tags.value.map((tag) => tag.title)
    } catch (error) {
        errorsHandler(error, errors)
    } finally{
        app.setSubmitting('idle')
    }
  }

  function getTagsForCurrentArticle(){
    return tagsForCurrentArticle.value = articles.currentArticle.tags.map((tag)=>tag.title)
  }

  function setTagsForCurrentArticle(tags){
    tagsForCurrentArticle.value = tags
  }

  return {
    tags,
    fetchTags,
    tagTitles,
    tagsForCurrentArticle,
    getTagsForCurrentArticle,
    setTagsForCurrentArticle
  }
})
