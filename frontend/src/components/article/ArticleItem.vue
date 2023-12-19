<script setup>
import ArticleCategories from './ArticleCategories.vue'
import ArticleAuthor from './ArticleAuthor.vue'
import { format } from 'date-fns'
import { articlesStore } from '@/stores/articles'
import { userStore } from '@/stores/user'
import update from '@/assets/images/Vector.svg'

const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
})

const articles = articlesStore()
const user = userStore()
</script>

<template>
  <RouterLink
    class="articleItem-link"
    :to="{ name: 'article', params: { id: article.id } }"
    ><div class="articleItem">
      <div
        class="articleItem__image-container"
        :style="{
          background: article.cover_url
            ? `url(${article.cover_url}) center center`
            : `url(${articles.defaultCover}) center center`,
          'background-size': 'cover',
        }"
      >
        <RouterLink
          class="articleItem-link"
          :to="{ name: 'edit article', params: { id: article.id } }"
        >
          <img
            v-if="user.user.id === props.article.author.id"
            :src="update"
            alt="update article"
            class="articleItem__image-update"
          />
        </RouterLink>
        <ArticleCategories
          :tags="props.article.tags"
          class="articleItem__category--card"
        />
      </div>
      <div class="articleItem__content">
        <div class="articleItem__info">
          <time class="articleItem__info-time">{{
            format(new Date(article.created_at), 'dd.MM.yyyy')
          }}</time>
          <img
            v-if="article.premium"
            src="@/assets/images/gem.svg"
            alt="gem image"
            class="articleItem__info-gem"
          />
        </div>
        <h3 class="articleItem__title">
          {{ article.title }}
        </h3>
        <p
          v-html="
            article.content.length > 100
              ? article.content.slice(0, 100) + '...(Click to read more)'
              : article.content
          "
          class="articleItem__text"
        ></p>
        <div class="articleItem__divider"></div>
        <ArticleAuthor :article="article" />
      </div></div
  ></RouterLink>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.articleItem {
  border-radius: 5px;
  background: #fff;
}
.articleItem__image-container {
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
.articleItem__image-update {
  position: absolute;
  top: 20px;
  left: 40px;
  &:hover {
    filter: invert(79%) sepia(7%) saturate(2281%) hue-rotate(342deg)
      brightness(87%) contrast(90%);
  }
}
.articleItem__content {
  padding: 20px;
}
.articleItem__info {
  display: flex;
  justify-content: space-between;
}
.articleItem__info-time {
  @include text(12px, 400);
  font-family: $secondaryFontFamily;
  color: #6c757d;
}

.articleItem__title {
  margin: 15px 0;
  @include text(18px, 700);
  font-family: $secondaryFontFamily;
  color: $textColor2;
  line-height: 25px;
  max-width: 270px;
}
.articleItem__text {
  @include text(12px, 400);
  font-family: $secondaryFontFamily;
  color: #6c757d;
  line-height: 20px;
  max-width: 270px;
  margin: 15px 0;
}
.articleItem__divider {
  border-bottom: 1px solid $textColor3;
}

.articleItem-link {
  @include link();
}
</style>
