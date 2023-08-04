import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/components/views/HomePage.vue';
import ShowArticle from '@/components/views/ShowArticle.vue';
import IndexArticle from '@/components/views/IndexArticle.vue';
import ProfilePage from '@/components/views/ProfilePage.vue'

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
    },
  ],
  scrollBehavior() {
    return { top: 0 };
  },
})

export default router
