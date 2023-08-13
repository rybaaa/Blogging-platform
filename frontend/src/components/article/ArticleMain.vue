<script setup>
import { articlesStore } from '@/stores/articles'
import ArticleCategories from './ArticleCategories.vue'

defineProps({
  article: {
    type: Object,
    required: true,
  },
})
import { format } from 'date-fns'

const articles = articlesStore()
</script>

<template>
  <article
    :style="{
      background: article.cover_url
        ? `url(${article.cover_url}) center center`
        : `url(${articles.defaultCover}) center center`,
      'background-size': 'cover',
    }"
  >
    <div class="articleMain__container">
      <ArticleCategories :tags="article.tags" />
      <h2 class="articleMain__title">
        <RouterLink
          class="articleMain-link"
          :to="{ name: 'article', params: { id: article.id } }"
        >
          {{ article.title }}
        </RouterLink>
      </h2>
      <div class="articleMain__content">
        <time class="articleMain__content-time">{{
          format(new Date(article.created_at), 'H:mm')
        }}</time>
        <div class="articleMain__content-divider"></div>
        <span class="articleMain__content-description">{{
          article.content
        }}</span>
      </div>
    </div>
  </article>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.articleMain {
  background: url('@/assets/images/bg_image.jpg') center center;
  background-size: cover;
}

.articleMain__container {
  min-height: 600px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  @include containerWidth();
  @include for-phone-only {
    align-items: center;
    text-align: center;
  }
  @include for-destkop-down {
    padding: 0 15px;
  }
}

.articleMain__title {
  @include text(36px, 700);
  font-family: $secondaryFontFamily;
  max-width: 530px;
  margin: 15px 0;
}

.articleMain__content {
  display: flex;
  gap: 10px;
  @include for-phone-only {
    flex-direction: column;
    text-align: center;
    align-items: center;
    padding: 0 20px;
  }
}

.articleMain__content-time {
  @include text(12px, 400);
  font-family: $secondaryFontFamily;
  color: $textColor3;
  padding-top: 3px;
}

.articleMain__content-divider {
  width: 30px;
  border-top: 1px solid $textColor3;
  margin-top: 10px;
}

.articleMain__content-description {
  @include text(12px, 400);
  color: $textColor3;
  line-height: 20px;
  font-family: $secondaryFontFamily;
  max-width: 420px;
}

.articleMain-link {
  @include link();
  color: $textColor1;
}
</style>
