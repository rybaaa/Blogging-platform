import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/components/views/HomePage.vue'
import ShowArticle from '@/components/views/ShowArticle.vue'
import IndexArticle from '@/components/views/IndexArticle.vue'
import ProfilePage from '@/components/views/ProfilePage.vue'
import EditProfile from '@/components/views/EditProfile.vue'
import ArticleConstructor from '@/components/views/ArticleConstructor.vue'
import ArticleEditConstructor from '@/components/views/ArticleEditConstructor.vue'
import EditSubscription from '@/components/views/EditSubscription.vue'
import PremiumArticles from '@/components/views/PremiumArticles.vue'
import { userStore } from '@/stores/user'
import {  errorAlert } from '@/utils/alerts'
import { errorsStore } from '@/stores/errors'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomePage,
    },
    {
      path: '/article/:id',
      name: 'article',
      component: ShowArticle,
    },
    {
      path: '/articles',
      name: 'articles',
      component: IndexArticle,
    },
    {
      path: '/profile',
      name: 'profile',
      component: ProfilePage,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: '/edit-profile',
      name: 'edit profile',
      component: EditProfile,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: '/new-article',
      name: 'new article',
      component: ArticleConstructor,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: '/edit-article/:id',
      name: 'edit article',
      component: ArticleEditConstructor,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: '/edit-subscription/',
      name: 'edit subscription',
      component: EditSubscription,
      meta: {
        requiresAuth: true,
      },
    },
    {
      path: '/premium-articles/',
      name: 'premium-articles',
      component: PremiumArticles,
      meta: {
        requiresSubscribe: true,
      },
    },
  ],
  scrollBehavior() {
    return { top: 0, behavior: 'smooth' }
  },
})

router.beforeEach(async (to, from, next) => {
  const user = userStore()
  const errors = errorsStore()

  errors.eraseErrors()

  if (localStorage.getItem('token') && !user.isLoggedIn) {
    await user.me()
  }

  if (to.meta.requiresAuth && !user.isLoggedIn) {
    next({ name: 'home' })
  }

  if ((to.meta.requiresSubscribe && !user.isLoggedIn) || (to.meta.requiresSubscribe && !user.user.is_subscriber)) {
    next({ name: 'home' })
    setTimeout(()=>{
      errorAlert('You must be a subscriber to view premium articles')
    }, 1000)
  }
  next()
})

export default router
