<script>
import ArticleCategory from '@/components/article/ArticleCategory.vue'
import ArticleAuthor from '@/components/article/ArticleAuthor.vue'
import EditorSection from '@/components/editor_article/EditorSection.vue'

export default {
  name: 'ShowArticle',
  components: { ArticleCategory, ArticleAuthor, EditorSection },
}
</script>

<template>
  <article>
    <section class="mainArticle">
      <div class="mainArticle__container">
        <h2 class="mainArticle__title">
          Richird Norton photorealistic rendering as real photos
        </h2>
        <div class="mainArticle__content">
          <span class="mainArticle__content-description"
            >Progressively incentivize cooperative systems through technically
            sound functionalities. The credibly productivate seamless
            data.</span
          >
          <span class="mainArticle__content-author">
            By Jennifer Lawrence
          </span>
        </div>
      </div>
    </section>
    <section class="articleContent">
      <div class="articleContent__container">
        <p>
          Seamlessly syndicate cutting-edge architectures rather than
          collaborative collaboration and idea-sharing. Proactively incubate
          visionary interfaces whereas premium benefits. Seamlessly negotiate
          ubiquitous leadership skills rather than parallel ideas. Dramatically
          visualize superior interfaces for best-of-breed alignments.
          Synergistically formulate performance based users through customized
          relationships. Interactively deliver cross-platform ROI via granular
          systems. Intrinsicly enhance effective initiatives vis-a-vis
          orthogonal outsourcing. Rapidiously monetize market-driven
          opportunities with multifunctional users. Collaboratively enhance
          visionary opportunities through revolutionary schemas. Progressively
          network just in time customer service without real-time scenarios.
        </p>
        <p>
          Synergistically drive e-business leadership with unique synergy.
          Compellingly seize market positioning ROI and bricks-and-clicks
          e-markets. Proactively myocardinate timely platforms through
          distributed ideas. Professionally optimize enabled core competencies
          for leading-edge sources. Professionally enhance stand-alone
          leadership with innovative synergy. Rapidiously generate backend
          experiences vis-a-vis long-term high-impact relationships.
          Authoritatively supply market-driven mindshare and bricks-and-clicks
          opportunities. Holisticly create diverse innovation through adaptive
          communities. Efficiently empower seamless meta-services with impactful
          opportunities. Distinctively transition virtual outsourcing with
          focused e-tailers.
        </p>
        <blockquote>
          “ Monotonectally seize superior mindshare rather than efficient
          technology. ”
        </blockquote>
        <p>
          Compellingly enhance seamless resources through competitive content.
          Continually actualize 24/365 alignments for resource-leveling
          platforms. Energistically enhance high standards in models and
          professional expertise. Intrinsicly iterate extensible metrics for
          prospective opportunities. Continually develop leading-edge
          experiences through quality e-services.
        </p>
      </div>
      <div class="articleContent__info">
        <ArticleCategory class="article__category-showArticle" />
        <ArticleAuthor
          class="articleContent__author"
          author="By Jennifer Lawrence "
          position="Thinker & Designer"
        />
      </div>

      <EditorSection title="Related posts" class="editorSection-showArticle" />
    </section>
  </article>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
.mainArticle {
  background: url('@/assets/images/blogImage2.png') center center;
  background-size: cover;

  .mainArticle__container {
    min-height: 600px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    @include containerWidth();
    align-items: center;
    text-align: center;

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
    }
  }
}
.articleContent {
  background-color: $bgColor;
  .articleContent__container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    @include containerWidth();
    padding: 100px 15px 50px 15px;
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
    margin-bottom: 50px;
  }
}
</style>
