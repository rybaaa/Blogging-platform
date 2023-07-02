<script>
import ArticleCategory from './ArticleCategory.vue'
export default {
  name: 'ArticleMain',
  components: { ArticleCategory },
}
</script>

<template>
  <article class="mainArticle">
    <div class="mainArticle__container">
      <ArticleCategory />
      <h2 class="mainArticle__title">
        Richird Norton photorealistic rendering as real photos
      </h2>
      <div class="mainArticle__content">
        <time class="mainArticle__content-time">08.08.2021</time>
        <div class="mainArticle__content-divider"></div>
        <span class="mainArticle__content-description"
          >Progressively incentivize cooperative systems through technically
          sound functionalities. The credibly productivate seamless data.</span
        >
      </div>
    </div>
  </article>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.mainArticle {
  background: url('@/assets/images/bg_image.jpg') center center;
  background-size: cover;

  .mainArticle__container {
    min-height: 600px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    @include containerWidth();

    .mainArticle__title {
      @include text(36px, 700);
      font-family: $secondaryFontFamily;
      max-width: 530px;
      margin: 15px 0;
    }

    .mainArticle__content {
      display: flex;
      gap: 10px;

      .mainArticle__content-time {
        @include text(12px, 400);
        font-family: $secondaryFontFamily;
        color: $textColor3;
        padding-top: 3px;
      }

      .mainArticle__content-divider {
        width: 30px;
        border-top: 1px solid $textColor3;
        margin-top: 10px;
      }

      .mainArticle__content-description {
        @include text(12px, 400);
        color: $textColor3;
        line-height: 20px;
        font-family: $secondaryFontFamily;
        max-width: 420px;
      }
    }
  }
}
</style>
