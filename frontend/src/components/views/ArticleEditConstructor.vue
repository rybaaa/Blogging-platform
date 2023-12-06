<script setup>
import ConstructorHeader from '@/components/article_constructor/ConstructorHeader.vue'
import ConstructorMain from '@/components/article_constructor/ConstructorMain.vue'
import { articlesStore } from '@/stores/articles'
import { useRoute } from 'vue-router'

const articles = articlesStore()

const route = useRoute()

await articles.fetchArticle(route.params.id)
</script>

<template>
  <div class="articleConstructor__container">
    <ConstructorHeader :type="articles.currentArticle.title" />
    <ConstructorMain type="Edit content" :article="articles.currentArticle" />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
</style>
