<script setup>
import ArticleCategories from '@/components/article/ArticleCategories.vue'
import ArticleAuthor from '@/components/article/ArticleAuthor.vue'
import EditorSection from '@/components/editor_article/EditorSection.vue'
import { ref, onMounted, watch } from 'vue'
import Articles from '@/api/Articles'
import { useRoute } from 'vue-router'

let article = ref(null)
let articles = ref([])
const route = useRoute()

onMounted(async () => {
  await fetchArticle(route.params.id)
  await fetchRelatedArticles()
})
watch(
  () => route.params.id,
  async () => {
    await fetchArticle(route.params.id)
  }
)
async function fetchArticle(id) {
  let response = await Articles.show(id)
  article.value = response.data.data
}
async function fetchRelatedArticles() {
  let response = await Articles.index()
  articles.value = response.data.data.slice(0, 3)
}
</script>

<template>
  <article v-if="article">
    <section class="mainArticle">
      <div class="mainArticle__container">
        <h2 class="mainArticle__title">
          {{ article.title }}
        </h2>
        <div class="mainArticle__content">
          <span class="mainArticle__content-author">
            By {{ article.author.name }}
          </span>
        </div>
      </div>
    </section>
    <section class="articleContent">
      <div class="articleContent__container">
        <p>
          {{ article.content }}
        </p>
        <div class="articleContent__info">
          <ArticleCategories class="articleCategory-showArticle" />
          <ArticleAuthor
            class="articleContent__author"
            :author="article.author.name"
            :email="article.author.email"
          />
        </div>
      </div>
      <EditorSection
        title="Related posts"
        :articles="articles"
        class="editorSection-showArticle"
      />
    </section>
  </article>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
.mainArticle {
  background: url('@/assets/images/blogImage2.png') center center;
  background-size: cover;
}

.mainArticle__container {
  min-height: 600px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  @include containerWidth();
  align-items: center;
  text-align: center;
}

.mainArticle__title {
  @include text(36px, 700);
  font-family: $secondaryFontFamily;
  max-width: 530px;
  margin: 15px 0;
}

.mainArticle__content {
  display: flex;
  gap: 10px;
  flex-direction: column;
}

.mainArticle__content-description {
  @include text(12px, 400);
  color: $textColor3;
  line-height: 20px;
  font-family: $secondaryFontFamily;
  max-width: 420px;
}
.mainArticle__content-author {
  @include text(12px, 700);
  color: $textColor3;
  line-height: 20px;
  font-family: $secondaryFontFamily;
}

.articleContent {
  background-color: $bgColor;
}
.articleContent__container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  @include containerWidth();
  max-width: 860px;
  padding: 100px 15px 50px 15px;
  @include for-phone-only {
    padding: 20px 15px;
  }
  p {
    @include text(14px, 400);
    color: $textColor2;
    font-family: $secondaryFontFamily;
    line-height: 25px;
    max-width: 860px;
  }
  blockquote {
    @include unsetAll;
    @include text(36px, 700);
    color: #d4a373;
    font-family: $secondaryFontFamily;
    max-width: 860px;
  }
}
.articleContent__info {
  @include containerWidth();
  @include for-phone-only {
    margin: 0;
    padding: 0 15px;
  }
}
</style>
