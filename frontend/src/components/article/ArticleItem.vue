<script>
import ArticleCategory from './ArticleCategory.vue'
import ArticleAuthor from './ArticleAuthor.vue'
export default {
  name: 'ArticleItem',
  props: {
    title: String,
    author: String,
    position: String,
  },
  components: { ArticleCategory, ArticleAuthor },
}
</script>

<template>
  <RouterLink class="articleItem-link" :to="{ name: 'show-article' }"
    ><div class="articleItem">
      <div class="articleItem__image-container">
        <img
          src="@/assets/images/blogImage1.png"
          alt="article picture"
          class="articleItem__image"
        />
        <ArticleCategory class="articleItem__category--card" />
      </div>
      <div class="articleItem__content">
        <div class="articleItem__info">
          <time class="articleItem__info-time">08.08.2021</time>
          <img
            src="@/assets/images/gem.svg"
            alt="gem image"
            class="articleItem__info-gem"
          />
        </div>
        <h3 class="articleItem__title">
          {{ title }}
        </h3>
        <p class="articleItem__text">
          Progressively incentivize cooperative systems through technically
          sound functionalities. The credibly productivate seamless data.
        </p>
        <div class="articleItem__divider"></div>
        <ArticleAuthor :author="author" :position="position" />
      </div></div
  ></RouterLink>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.articleItem {
  border-radius: 5px;
  background: #fff;
  .articleItem__image-container {
    position: relative;
    background: #000;
    opacity: 0.9;
    .articleItem__image {
      width: 100%;
    }
  }
  .articleItem__content {
    padding: 20px;
    .articleItem__info {
      display: flex;
      justify-content: space-between;
      .articleItem__info-time {
        @include text(12px, 400);
        font-family: $secondaryFontFamily;
        color: #6c757d;
      }
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
  }
}
.articleItem-link {
  text-decoration: none;
  &:hover {
    cursor: pointer;
    text-decoration: underline #000;
  }
}
</style>
