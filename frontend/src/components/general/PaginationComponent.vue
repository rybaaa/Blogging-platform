<script setup>
import { articlesStore } from '@/stores/articles'

defineProps({
  items: Number,
})

const articles = articlesStore()
</script>
<template>
  <div class="paginationComponent">
    <button
      v-for="pagenumber in items"
      :key="pageNumber"
      @click="articles.fetchArticles(pagenumber)"
      class="paginationComponent__button"
    >
      {{ pagenumber }}
    </button>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.paginationComponent {
  background-color: $bgColor;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  gap: 10px;
}

.paginationComponent__button {
  height: 30px;
  width: 30px;
  background: #d4a373;
  @include text(12px, 700);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  border: none;
  outline: none;
  cursor: pointer;
  &:hover {
    opacity: 0.8;
  }
}
</style>
