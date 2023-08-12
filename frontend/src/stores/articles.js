import { computed, ref } from 'vue'
import { defineStore } from 'pinia'
import { appStore } from './app'
import errorsHandler from '@/utils/errorsHandler'
import Articles from '@/api/Articles'
import cover from '@/assets/images/bg_image.jpg'

export const articlesStore = defineStore('articles', () => {
  const app = appStore()

  let articles = ref([])
  let currentArticle = ref(null)
  let editorsPickArticles = computed(() => {
    return articles.value.slice(0, 3)
  })
  let featuredArticle = computed(() => {
    return articles.value[0]
  })

  let relatedArticles = computed(() => {
    return articles.value.length > 0
      ? articles.value.slice(0, 3)
      : fetchArticles()
  })

  let defaultCover = ref(cover)

  //requests

  async function fetchArticles() {
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.index()
      articles.value = response.data.data.data
    } catch (error) {
      errorsHandler(error)
    } finally {
      app.setSubmitting('idle')
    }
  }

  async function fetchArticle(id) {
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.show(id)
      currentArticle.value = response.data.data
      currentArticle.value.comments.reverse()
    } catch (error) {
      errorsHandler(error)
    } finally {
      app.setSubmitting('idle')
    }
  }

  return {
    articles,
    featuredArticle,
    editorsPickArticles,
    fetchArticles,
    fetchArticle,
    relatedArticles,
    currentArticle,
    defaultCover
  }
})
