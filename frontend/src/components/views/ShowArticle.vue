<script setup>
import ArticleCategories from '@/components/article/ArticleCategories.vue'
import ArticleAuthor from '@/components/article/ArticleAuthor.vue'
import EditorSection from '@/components/editor_article/EditorSection.vue'
import { useRoute } from 'vue-router'
import CommentsList from '@/components/comment/CommentsList.vue'
import { articlesStore } from '@/stores/articles'
import { userStore } from '@/stores/user'
import PremiumAlert from '@/components/general/PremiumAlert.vue'

const articles = articlesStore()
const route = useRoute()
const user = userStore()

await articles.fetchArticle(route.params.id)

function addNewComment(comment) {
  articles.currentArticle.comments.unshift(comment)
}
console.log(articles.currentArticle.premium, !user.is_subscriber)
</script>

<template>
  <article>
    <section
      :style="{
        background:
          articles.currentArticle.cover_url === null
            ? `url(${articles.defaultCover}) center center`
            : `url(${articles.currentArticle.cover_url}) center center`,
        'background-size': 'cover',
      }"
    >
      <div class="mainArticle__container">
        <h2 class="mainArticle__title">
          {{ articles.currentArticle.title }}
        </h2>
        <div class="mainArticle__content">
          <span class="mainArticle__content-author">
            By {{ articles.currentArticle.author.name }}
          </span>
        </div>
      </div>
    </section>
    <section class="articleContent">
      <div class="articleContent__container">
        <p
          :class="{
            articleContent__content:
              articles.currentArticle.premium && !user.user.is_subscriber,
          }"
          v-html="articles.currentArticle.content"
        ></p>
        <PremiumAlert
          v-if="articles.currentArticle.premium && !user.user.is_subscriber"
        />
        <div class="articleContent__info">
          <ArticleCategories
            :tags="articles.currentArticle.tags"
            class="articleCategory-showArticle"
          />
          <ArticleAuthor
            class="articleContent__author"
            :article="articles.currentArticle"
          />
        </div>
        <CommentsList
          :comments="articles.currentArticle.comments"
          @addNewComment="addNewComment"
        />
      </div>
      <EditorSection
        title="Related posts"
        :articles="articles.relatedArticles"
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
.articleContent__content {
  position: relative;
  display: inline-block;
}

.articleContent__content::after {
  content: '';
  position: absolute;
  bottom: 0;
  right: -10px; /* Adjust this value to control the width of the blurred area */
  width: 1000px; /* Adjust this value to control the width of the blurred area */
  height: 100%;
  background: linear-gradient(
    to right,
    rgba(255, 255, 255, 0),
    rgba(255, 255, 255, 1)
  );
  filter: blur(
    10px
  ); /* Adjust this value to control the intensity of the blur */
}
</style>
