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
  <div class="articleAuthor">
    <img
      src="@/assets/images/face1.png"
      alt="author face"
      class="articleAuthor__image"
    />
    <div class="articleAuthor__content">
      <h4 class="articleAuthor__title">{{ author }}</h4>
      <p class="articleAuthor__description">{{ position }}</p>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
.articleAuthor {
  padding-top: 20px;
  display: flex;
  gap: 17px;
  align-items: center;
}
.articleAuthor__content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 5px;
  height: 100%;
}
.articleAuthor__title {
  @include text(12px, 700);
  line-height: 20px;
  font-family: $secondaryFontFamily;
  color: $textColor2;
}
.articleAuthor__description {
  @include text(12px, 400);
  line-height: 20px;
  font-family: $secondaryFontFamily;
  color: $textColor2;
}
.articleContent__author {
  padding: 0;
  padding: 50px 0;
  border-top: 1px solid #c4c4c4;
  border-bottom: 1px solid #c4c4c4;
}
</style>
