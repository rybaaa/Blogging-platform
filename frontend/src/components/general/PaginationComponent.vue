<script setup>
import { articlesStore } from '@/stores/articles'
import { userStore } from '@/stores/user'

defineProps({
  items: Number,
  purpose: String,
})

const classesForAllArticles = (pagenumber) => {
  return pagenumber === articles.currentPage
    ? 'paginationComponent__button-current'
    : ''
}
const classesForProfile = (pagenumber) => {
  return pagenumber === user.user.articles.current_page
    ? 'paginationComponent__button-current'
    : ''
}
const articles = articlesStore()
const user = userStore()
</script>
<template>
  <div class="paginationComponent">
    <button
      v-for="pagenumber in items"
      :key="pageNumber"
      @click="
        purpose === 'profile'
          ? user.fetchUserArticles(pagenumber, user.user.id)
          : articles.fetchArticles(pagenumber)
      "
      class="paginationComponent__button"
      :class="
        purpose === 'profile'
          ? classesForProfile(pagenumber)
          : classesForAllArticles(pagenumber)
      "
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

.paginationComponent__button-current {
  background: #ffffff;
  color: #d4a373;
}
</style>
