<script>
import EditorArticle from './EditorArticle.vue'
export default {
  name: 'EditorSection',
  props: {
    title: String,
  },
  components: { EditorArticle },
}
</script>

<template>
  <section class="editorSection">
    <div class="editorSection__container">
      <h2 class="editorSection__title">{{ title }}</h2>
      <div class="editorSections">
        <EditorArticle></EditorArticle>
        <EditorArticle></EditorArticle>
        <EditorArticle></EditorArticle>
      </div>
    </div>
  </section>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
.editorSection {
  background: $bgColor;
  padding: 45px 15px 150px 15px;
  .editorSection__container {
    @include containerWidth();
    .editorSection__title {
      @include text(36px, 700);
      font-family: $secondaryFontFamily;
      color: $textColor2;
      margin-bottom: 70px;
    }
    .editorSections {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
      grid-column-gap: 20px;
      grid-row-gap: 50px;
    }
  }
}
.editorSection-showArticle {
  padding: 0;
  background: rgba(229, 229, 229, 0.3);
  .editorSection__container {
    padding: 100px 70px;
    .editorSection__title {
      @include text(18px, 700);
      font-family: $secondaryFontFamily;
      color: $textColor2;
      margin-bottom: 50px;
    }
  }
}
</style>
