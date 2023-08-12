import { computed, ref } from 'vue'
import { defineStore } from 'pinia'
import { appStore } from './app'
import errorsHandler from '@/utils/errorsHandler'
import Articles from '@/api/Articles'
import cover from '@/assets/images/bg_image.jpg'
import { errorAlert, successAlert } from '../utils/alerts'
import { errorsStore } from './errors'

export const articlesStore = defineStore('articles', () => {
  const app = appStore()
  const errors = errorsStore()

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
  let totalArticles = ref(null)
  let articlesPerPage = ref(null)
  let pages = ref(null)

  //requests

  async function fetchArticles(page) {
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.index(page)
      console.log(response);
      articles.value = response.data.data.data
      totalArticles.value = response.data.data.total
      articlesPerPage.value = response.data.data.per_page
      pages.value = response.data.data.last_page
      window.scrollTo({
        top: 0,
        behavior: 'smooth',
      });
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

  async function createArticle(values){
    console.log(values.content);
    if(!values.content) {
      errorAlert('Please provide a content')
    }
    let content = processContent(values.content)    
    let object = {
      title: values.title,
      content
    }
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.store(object)
      successAlert(response.data.message)
    } catch (error) {
      errorsHandler(error, errors)
    } finally{
      app.setSubmitting('idle')
    }
  }

  function processContent(data) {
    let content = ''
    if(!data.ops.length) return null
    for(let i = 0; i< data.ops.length; i++){
      content += data.ops[i].insert
    }
    return content
  }

  return {
    articles,
    featuredArticle,
    editorsPickArticles,
    fetchArticles,
    fetchArticle,
    relatedArticles,
    currentArticle,
    defaultCover,
    pages,
    createArticle
  }
})
