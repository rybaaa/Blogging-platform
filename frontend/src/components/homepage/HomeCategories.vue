<script setup>
import { tagsStore } from '@/stores/tags'
import { articlesStore } from '@/stores/articles'
import { ref } from 'vue'

const props = defineProps({
  page: String,
})

const tags = tagsStore()
const articles = articlesStore()
let activeTag = ref('All')

await tags.fetchTags()
const filterArticlesByTag = async (tag) => {
  props.page === 'premium'
    ? await articles.fetchPremiumArticles(1, tag)
    : await articles.fetchArticles(1, null, tag)
  if (!tag) {
    activeTag.value = 'All'
  } else {
    activeTag.value = tag
  }
}
</script>

<template>
  <div class="homeCategories">
    <h2 class="homeCategories__title">Popular topics</h2>
    <ul class="homeCategories__list">
      <li class="homeCategories__category">
        <a
          @click="filterArticlesByTag()"
          :class="{
            'homeCategories__category-link': true,
            'homeCategories__category-active': activeTag === 'All',
          }"
          href="#"
          >All</a
        >
      </li>
      <li
        class="homeCategories__category"
        v-for="tag in tags.tags"
        :key="tag.id"
      >
        <a
          @click="filterArticlesByTag(tag.title)"
          :class="{
            'homeCategories__category-link': true,
            'homeCategories__category-active': activeTag === tag.title,
          }"
          href="#"
          >{{ tag.title }}</a
        >
      </li>
    </ul>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.homeCategories__title {
  @include text(36px, 700);
  font-family: $secondaryFontFamily;
  color: $textColor2;
  margin-bottom: 30px;
}
.homeCategories__list {
  @include unsetAll();
  display: flex;
  margin-bottom: 30px;
  flex-wrap: wrap;
  @include for-phone-only {
    justify-content: space-between;
    gap: 10px;
  }
}
.homeCategories__category {
  @include unsetAll();
  @include text(12px, 700);
  color: $textColor2;
  font-family: $secondaryFontFamily;
  line-height: 25px;
  margin-right: 20px;
  @include for-phone-only {
    margin: 0;
  }
}
.homeCategories__category-link {
  @include unsetAll();
  @include text(12px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  text-transform: capitalize;
  cursor: pointer;
  &:hover {
    color: #d4a373;
  }
}
.homeCategories__category-active {
  color: #d4a373;
}
.homeCategories__category-last {
  margin-left: auto;
  margin-right: 0;
  @include for-phone-only {
    margin: 0;
  }
}
</style>
