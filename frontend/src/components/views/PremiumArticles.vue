<script setup>
import ArticleItem from '@/components/article/ArticleItem.vue'
import HomeCategories from '@/components/homepage/HomeCategories.vue'
import { articlesStore } from '@/stores/articles'
import PaginationComponent from '@/components/general/PaginationComponent.vue'
import PremiumGemImage from '@/components/general/PremiumGemImage.vue'

const articles = articlesStore()

await articles.fetchArticles()
</script>

<template>
  <main>
    <div class="premiumArticles__container">
      <section class="premiumArticles">
        <PremiumGemImage place="premiumPage" />
        <h2 class="premiumArticles__header">Premium articles</h2>
        <p class="premiumArticles__description">
          Explain what the HTTP protocol in general What is the difference
          between HTTP GET and POST methods? When would you use each? Is HTTP
          stateless? What does that mean? What are HTTP status codes? Can you
          give some examples of commonly used status codes and their meanings?
          What is the difference between HTTP and HTTPS? Why is HTTPS important
          for secure communication?
        </p>
      </section>
    </div>
    <section class="section">
      <div class="section__container">
        <HomeCategories />
        <div class="articles">
          <ArticleItem
            v-for="article in articles.articles"
            :article="article"
            :key="article.id"
          />
        </div>
      </div>
      <PaginationComponent :items="articles.pages" />
    </section>
  </main>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.premiumArticles__container {
  background-color: #3e3e3e;
}
.premiumArticles {
  min-height: 520px;
  display: flex;
  flex-direction: column;
  @include containerWidth();
  align-items: center;
  text-align: center;
  padding: 145px 0 35px;
}
.premiumArticles__header {
  @include text(36px, 700);
  font-family: $secondaryFontFamily;
  line-height: normal;
  margin: 25px 0;
}
.premiumArticles__description {
  @include text(12px, 400, #e5e5e5);
  font-family: $secondaryFontFamily;
  line-height: 20px;
  width: 420px;
  @include for-phone-only {
    width: 300px;
  }
}
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
