<script>
export default {
  name: 'ArticleAuthor',
  props: {
    author: String,
    position: String,
  },
}
</script>

<template>
  <div class="article__author-container">
    <img
      src="@/assets/images/face1.png"
      alt="author face"
      class="article__author-image"
    />
    <div class="article__author-content">
      <h4 class="article__author-title">{{ author }}</h4>
      <p class="article__author-description">{{ position }}</p>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
.article__author-container {
  padding-top: 20px;
  display: flex;
  gap: 17px;
  align-items: center;
  .article__author-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    height: 100%;
    .article__author-title {
      @include text(12px, 700);
      line-height: 20px;
      font-family: $secondaryFontFamily;
      color: $textColor2;
    }
    .article__author-description {
      @include text(12px, 400);
      line-height: 20px;
      font-family: $secondaryFontFamily;
      color: $textColor2;
    }
  }
}
.articleContent__author {
  padding: 0;
  padding: 50px 0;
  border-top: 1px solid #c4c4c4;
  border-bottom: 1px solid #c4c4c4;
}
</style>
