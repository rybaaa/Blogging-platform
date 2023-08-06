import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/components/views/HomePage.vue';
import ShowArticle from '@/components/views/ShowArticle.vue';
import IndexArticle from '@/components/views/IndexArticle.vue';
import ProfilePage from '@/components/views/ProfilePage.vue'
import EditProfile from '@/components/views/EditProfile.vue'
import { userStore } from '../stores/user';

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
      meta:{
        requiresAuth: true
      }
    },
    {
      path: '/edit-profile',
      name: 'edit profile',
      component: EditProfile,
      meta:{
        requiresAuth: true
      }
    },
  ],
  scrollBehavior() {
    return { top: 0 };
  },
})

router.beforeEach(async (to, from, next) => {
  const user = userStore()

  if(localStorage.getItem('token') && !user.isLoggedIn){
    await user.me()
  }

  if(to.meta.requiresAuth && !user.isLoggedIn){
    next({name:'home'})
  }
  next()
})

export default router
