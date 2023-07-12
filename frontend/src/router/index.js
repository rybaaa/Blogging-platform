import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/components/views/HomePage.vue';
import ShowArticle from '@/components/views/ShowArticle.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomePage,
    },
    {
      path: '/show-article',
      name: 'show-article',
      component: ShowArticle,
    },
  ],
})

export default router
