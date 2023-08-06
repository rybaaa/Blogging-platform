<script setup>
import { onMounted } from 'vue'
import Articles from '@/api/Articles'
import EditorArticle from '../editor_article/EditorArticle.vue'
import AddArticleFromProfile from '../profile/AddArticleFromProfile.vue'
import { userStore } from '../../stores/user'

const user = userStore()

onMounted(async () => {
  let response = await Articles.index(user.user.id)
  user.user.articles = response.data.data.data
})
</script>

<template>
  <div class="profileArticles__wrapper">
    <section class="profileArticles">
      <h3 class="profileArticles__title">My Articles</h3>
      <div class="profileArticles__list">
        <AddArticleFromProfile />
        <EditorArticle
          v-for="article in user.user.articles"
          :key="article.id"
          :article="article"
          type="profile"
        />
      </div>
    </section>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.profileArticles__wrapper {
  min-height: 600px;
  display: flex;
  flex-direction: column;
  padding: 65px 20px 95px;
  @include containerWidth();
  @include for-phone-only {
    padding: 50px 20px;
  }
}
.profileArticles__title {
  @include text(36px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: normal;
  margin-bottom: 70px;
}

.profileArticles__list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
  grid-column-gap: 20px;
  grid-row-gap: 20px;
  @include for-phone-only {
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  }
}
</style>
