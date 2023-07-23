<script setup>
import ArticleItem from '@/components/article/ArticleItem.vue'
import HomeCategories from '@/components/homepage/HomeCategories.vue'
import { onMounted, ref } from 'vue'
import Articles from '@/api/Articles'

let articles = ref([])

onMounted(async () => {
  let response = await Articles.index()
  articles.value = response.data.data
})
</script>

<template>
  <main>
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
