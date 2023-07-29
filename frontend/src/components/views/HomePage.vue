<script setup>
import ArticleItem from '@/components/article/ArticleItem.vue'
import EditorSection from '@/components/editor_article/EditorSection.vue'
import ArticleMain from '@/components/article/ArticleMain.vue'
import HomeCategories from '@/components/homepage/HomeCategories.vue'
import { computed, onMounted, ref } from 'vue'
import Articles from '@/api/Articles'

let articles = ref([])
let editorsPickArticles = ref([])

onMounted(async () => {
  let response = await Articles.index()
  articles.value = response.data.data.data
  editorsPickArticles.value = response.data.data.data.slice(0, 3)
})

let featuredArticle = computed(() => {
  return articles.value[0]
})
</script>

<template>
  <main>
    <ArticleMain v-if="featuredArticle" :article="featuredArticle" />
    <section class="section">
      <div class="section__container">
        <HomeCategories />
        <div class="articles">
          <ArticleItem
            v-for="article in articles"
            :article="article"
            :key="article.id"
          />
        </div>
      </div>
    </section>
    <EditorSection title="Editor’s Pick" :articles="editorsPickArticles" />
  </main>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.section {
  padding: 45px 15px;
  background: $bgColor;
}
.section__container {
  @include containerWidth();
}
.articles {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
  grid-column-gap: 20px;
  grid-row-gap: 50px;
  @include for-tablet-down {
    grid-template-columns: repeat(2, 1fr);
  }
  @include for-phone-only {
    grid-template-columns: repeat(1, 1fr);
  }
}
</style>
