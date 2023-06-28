<script>
import ArticleItem from '@/components/ArticleItem.vue'
import EditorArticle from '@/components/EditorArticle.vue'

export default {
  name: 'HomePage',
  components: {
    ArticleItem,
    EditorArticle,
  },
}
</script>

<template>
  <main>
    <article class="mainArticle">
      <div class="mainArticle__container">
        <ul class="mainArticle__categories">
          <li class="mainArticle__category">
            <a class="mainArticle__category-link" href="#">ADVENTURE</a>
          </li>
          <li class="mainArticle__category">
            <a class="mainArticle__category-link" href="#">ADVENTURE2</a>
          </li>
        </ul>
        <h2 class="mainArticle__title">
          Richird Norton photorealistic rendering as real photos
        </h2>
        <div class="mainArticle__content">
          <time class="mainArticle__content-time">08.08.2021</time>
          <div class="mainArticle__content-divider"></div>
          <span class="mainArticle__content-description"
            >Progressively incentivize cooperative systems through technically
            sound functionalities. The credibly productivate seamless
            data.</span
          >
        </div>
      </div>
    </article>

    <section class="section">
      <div class="section__container">
        <h2 class="section__title">Popular topics</h2>
        <ul class="section__categories">
          <li class="section__category section__category-active">
            <a href="#" class="section__category-link"></a>All
          </li>
          <li class="section__category">
            <a href="#" class="section__category-link"></a>Adventure
          </li>
          <li class="section__category">
            <a href="#" class="section__category-link"></a>Travel
          </li>
          <li class="section__category">
            <a href="#" class="section__category-link"></a>Fashion
          </li>
          <li class="section__category">
            <a href="#" class="section__category-link"></a>Technology
          </li>
          <li class="section__category">
            <a href="#" class="section__category-link"></a>Branding
          </li>
          <li class="section__category section__category-last">
            <a href="#" class="section__category-link"></a>View all
          </li>
        </ul>
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
    <section class="editorSection">
      <div class="editorSection__container">
        <h2 class="editorSection__title">Editor’s Pick</h2>
        <div class="editorSections">
          <EditorArticle msg="1"></EditorArticle>
          <EditorArticle msg="1"></EditorArticle>
          <EditorArticle msg="1"></EditorArticle>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.mainArticle {
  background: url('@/assets/images/bg_image.jpg') center center;
  background-size: cover;

  .mainArticle__container {
    min-height: 600px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    @include containerWidth();
    .mainArticle__categories {
      @include unsetAll();
      display: flex;
      gap: 20px;

      .mainArticle__category {
        display: inline-flex;
        padding: 5px 10px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.15);

        &:hover {
          opacity: 0.8;
        }

        .mainArticle__category-link {
          list-style: none;
          text-decoration: none;
          @include text(10px, 700);
        }
      }
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

      .mainArticle__content-time {
        @include text(12px, 400);
        font-family: $secondaryFontFamily;
        color: $textColor3;
        padding-top: 3px;
      }

      .mainArticle__content-divider {
        width: 30px;
        border-top: 1px solid $textColor3;
        margin-top: 10px;
      }

      .mainArticle__content-description {
        @include text(12px, 400);
        color: $textColor3;
        line-height: 20px;
        font-family: $secondaryFontFamily;
        max-width: 420px;
      }
    }
  }
}
.section {
  padding: 45px 15px;
  background: #f8f9fa;
  .section__container {
    @include containerWidth();
    .section__title {
      @include text(36px, 700);
      font-family: $secondaryFontFamily;
      color: $textColor2;
      margin-bottom: 30px;
    }
    .section__categories {
      @include unsetAll();
      display: flex;
      margin-bottom: 30px;
      .section__category {
        @include unsetAll();
        @include text(12px, 700);
        color: $textColor2;
        font-family: $secondaryFontFamily;
        line-height: 25px;
        margin-right: 20px;
        &:hover {
          color: #d4a373;
          cursor: pointer;
        }
      }
      .section__category-active {
        color: #d4a373;
      }
      .section__category-last {
        margin-left: auto;
        margin-right: 0;
      }
    }
    .articles {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(310px, 1fr));
      grid-column-gap: 20px;
      grid-row-gap: 50px;
    }
  }
}
.editorSection {
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
</style>
