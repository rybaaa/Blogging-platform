<script>
import ArticleItem from '@/components/article/ArticleItem.vue'
import EditorSection from '@/components/editor_article/EditorSection.vue'
import ArticleMain from '@/components/article/ArticleMain.vue'
import HomeCategories from '@/components/homepage/HomeCategories.vue'

export default {
  name: 'HomePage',
  components: {
    ArticleItem,
    EditorSection,
    ArticleMain,
    HomeCategories,
  },
}
</script>

<template>
  <main>
    <ArticleMain />
    <section class="section">
      <div class="section__container">
        <HomeCategories />
        <div class="articles">
          <ArticleItem
            title="Dream destinations to visit this year in Paris"
            author="Jennifer Lawrence"
            position="Thinker & Designer"
          ></ArticleItem>
          <ArticleItem
            title="Richird Norton photorealistic rendering as real photos"
            author="David Arthur"
            position="Designer"
          ></ArticleItem>
          <ArticleItem
            title="Dream destinations to visit this year in Paris"
            author="Sarah Lawrence"
            position="Journalist"
          ></ArticleItem>
          <ArticleItem
            title="Dream destinations to visit this year in Paris"
            author="Jennifer Lawrence"
            position="Thinker & Designer"
          ></ArticleItem>
          <ArticleItem
            title="Art of Seasons: 40+ Bright Illustrations by Nature"
            author="David Tomas"
            position="Thinkers"
          ></ArticleItem>
          <ArticleItem
            title="The Anatomy of a Web Page and Basic Elements"
            author="Jennifer Lawrence"
            position="Thinker & Designer"
          ></ArticleItem>
          <ArticleItem
            title="Types of Contrast in User Interface Design"
            author=" Andrey Edison"
            position="Thinker & Designer"
          ></ArticleItem>
          <ArticleItem
            title="Dream destinations to visit this year in Paris"
            author="Sean Anderson"
            position="Thinker & Designer"
          ></ArticleItem>
        </div>
      </div>
    </section>
    <EditorSection />
  </main>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.section {
  padding: 45px 15px;
  background: $bgColor;
  .section__container {
    @include containerWidth();
    .articles {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
      grid-column-gap: 20px;
      grid-row-gap: 50px;
    }
  }
}
</style>
