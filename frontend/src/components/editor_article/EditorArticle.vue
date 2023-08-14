<script setup>
import { format } from 'date-fns'
import update from '@/assets/images/Vector.svg'
import { articlesStore } from '@/stores/articles'
import ArticleCategories from '@/components/article/ArticleCategories.vue'

const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
  type: String,
})
const articles = articlesStore()
</script>

<template>
  <div class="editorArticle">
    <RouterLink
      class="editorArticle-link"
      :to="{ name: 'article', params: { id: article.id } }"
    >
      <div
        class="editorArticle__image-container"
        :style="{
          background: article.cover_url
            ? `url(${article.cover_url}) center center`
            : `url(${articles.defaultCover}) center center`,
          'background-size': 'cover',
        }"
      >
        <RouterLink
          class="editorArticle-link"
          :to="{ name: 'edit article', params: { id: article.id } }"
        >
          <img
            v-if="type === 'profile'"
            :src="update"
            alt="update article"
            class="editorArticle__image-update"
          />
        </RouterLink>
        <ArticleCategories
          :tags="props.article.tags"
          class="articleItem__category--card"
        />
        <div class="editorArticle__content">
          <img
            src="@/assets/images/gem.svg"
            alt="gem image"
            class="editorArticle__image"
          />
          <time class="editorArticle__time">{{
            format(new Date(article.created_at), 'dd.MM.yyyy')
          }}</time>
          <h3 class="editorArticle__title">
            {{ article.title }}
          </h3>
          <p class="editorArticle__text">
            {{
              article.content.length > 100
                ? article.content.slice(0, 100) + '...'
                : article.content
            }}
          </p>
        </div>
      </div></RouterLink
    >
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.editorArticle {
  border-radius: 5px;
  background: #fff;
}
.editorArticle__image-container {
  position: relative;
  background-size: cover;
  opacity: 0.9;
  height: 350px;
  width: 100%;
  transition: transform 0.2s ease-in-out;
  &:hover {
    transform: translateY(-3px);
  }
}
.editorArticle__image-update {
  position: absolute;
  top: 20px;
  left: 40px;
  &:hover {
    filter: invert(79%) sepia(7%) saturate(2281%) hue-rotate(342deg)
      brightness(87%) contrast(90%);
  }
}
.editorArticle__categories {
  position: absolute;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  right: 20px;
  margin: 0;
  top: 10px;
}

.editorArticle__category {
  padding: 5px 10px;
  display: inline-flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.15);
  @include unsetAll();
  z-index: 10;

  &:hover {
    opacity: 0.8;
  }
}

.editorArticle__category-link {
  padding: 5px 10px;
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.15);
  list-style: none;
  text-decoration: none;
  @include text(10px, 700);
}

.editorArticle__content {
  display: flex;
  gap: 15px;
  flex-direction: column;
  padding: 120px 0 0 37px;
}
.editorArticle__image {
  width: 20px;
}
.editorArticle__time {
  @include text(12px, 400);
  font-family: $secondaryFontFamily;
  color: $textColor3;
}
.editorArticle__title {
  @include text(18px, 700);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  max-width: 270px;
}
.editorArticle__text {
  @include text(12px, 400);
  font-family: $secondaryFontFamily;
  color: $textColor3;
  line-height: 20px;
  max-width: 340px;
  word-wrap: break-word;
}

.editorArticle-link {
  @include link();
}
</style>
