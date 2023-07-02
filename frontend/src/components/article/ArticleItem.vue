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
  <div class="article">
    <div class="article__image-container">
      <img
        src="@/assets/images/blogImage1.png"
        alt="article picture"
        class="article__image"
      />
      <ArticleCategory class="article__category--card" />
    </div>
    <div class="article__content">
      <div class="article__info">
        <time class="article__info-time">08.08.2021</time>
        <img
          src="@/assets/images/gem.svg"
          alt="gem image"
          class="article__info-gem"
        />
      </div>
      <h3 class="article__title">
        {{ title }}
      </h3>
      <p class="article__text">
        Progressively incentivize cooperative systems through technically sound
        functionalities. The credibly productivate seamless data.
      </p>
      <div class="article__divider"></div>
      <ArticleAuthor :author="author" :position="position" />
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.article {
  border-radius: 5px;
  background: #fff;
  .article__image-container {
    position: relative;
    background: #000;
    opacity: 0.9;
    .article__image {
      width: 100%;
    }
  }
  .article__content {
    padding: 20px;
    .article__info {
      display: flex;
      justify-content: space-between;
      .article__info-time {
        @include text(12px, 400);
        font-family: $secondaryFontFamily;
        color: #6c757d;
      }
    }
    .article__title {
      margin: 15px 0;
      @include text(18px, 700);
      font-family: $secondaryFontFamily;
      color: $textColor2;
      line-height: 25px;
      max-width: 270px;
    }
    .article__text {
      @include text(12px, 400);
      font-family: $secondaryFontFamily;
      color: #6c757d;
      line-height: 20px;
      max-width: 270px;
      margin: 15px 0;
    }
    .article__divider {
      border-bottom: 1px solid $textColor3;
    }
  }
}
</style>