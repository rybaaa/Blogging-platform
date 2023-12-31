import { computed, ref } from 'vue'
import { defineStore } from 'pinia'
import { appStore } from './app'
import errorsHandler from '@/utils/errorsHandler'
import Articles from '@/api/Articles'
import cover from '@/assets/images/bg_image.jpg'
import { errorAlert, successAlert } from '../utils/alerts'
import { errorsStore } from './errors'
import router from '@/router/index'

export const articlesStore = defineStore('articles', () => {
  const app = appStore()
  const errors = errorsStore()

  let articles = ref([])
  let premiumArticles = ref([])
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
  let currentPage = ref(1)

  let uploadedImage = ref(null);

  //requests

  async function fetchArticles(page, id, tag) {
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.index(page, id, tag)
      articles.value = response.data.data.data
      totalArticles.value = response.data.data.total
      articlesPerPage.value = response.data.data.per_page
      pages.value = response.data.data.last_page
      currentPage.value = response.data.data.current_page
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

  async function fetchPremiumArticles(page, tag) {
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.indexPremium(page, tag)
      console.log(response);
      premiumArticles.value = response.data.data.data
      totalArticles.value = response.data.data.total
      articlesPerPage.value = response.data.data.per_page
      pages.value = response.data.data.last_page
      currentPage.value = response.data.data.current_page
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
    console.log(values);
    if(!values.content) {
      errorAlert('Please provide a content')
    }
    let content = processContent(values.content)    
    let object = {
      title: values.title,
      content,
      cover_photo: values.cover,
      tags: values.tags,
      premium:values.premium
    }
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.store(object)
      setTimeout(()=>{
        successAlert(response.data.message)
      }, 1000)
      router.push({ name: 'profile' })
    } catch (error) {
      errorsHandler(error, errors)
    } finally{
      app.setSubmitting('idle')
    }
  }

  async function updateArticle(id, values){
    console.log(values);
    if(!values.content) {
      errorAlert('Please provide a content')
    }
    let content = processContent(values.content)    
    let object = {
      title: values.title,
      content,
      tags: values.tags,
      premium:values.premium
    }
    app.setSubmitting('isLoading')
    try {
      let response = await Articles.update(id, object)
      setTimeout(()=>{
        successAlert(response.data.message)
      }, 1000)
      router.push({ name: 'profile' })
    } catch (error) {
      errorsHandler(error, errors)
    } finally{
      app.setSubmitting('idle')
    }
  }

  function processContent(data) {
    let content = ''
    if(data.hasOwnProperty('ops')){
      if(!data.ops.length) return null
    } else {
      return data
    }
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
    currentPage,
    createArticle,
    updateArticle,
    uploadedImage,
    fetchPremiumArticles,
    premiumArticles
  }
})
