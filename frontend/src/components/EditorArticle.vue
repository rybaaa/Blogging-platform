<script>
export default {
  name: 'EditorArticle',
  props: {
    msg: String,
  },
}
</script>

<template>
  <div class="article">
    <div class="article__image-container">
      <ul class="article__categories">
        <li class="article__category">
          <a href="#" class="article__category-link">ADVENTURE</a>
        </li>
      </ul>
      <div class="article__content">
        <img
          src="@/assets/images/gem.svg"
          alt="gem image"
          class="article__image"
        />
        <time class="article__time">08.08.2021</time>
        <h3 class="article__title">
          Richird Norton photorealistic rendering as real photos
        </h3>
        <p class="article__text">
          Progressively incentivize cooperative systems through technically
          sound functionalities. The credibly productivate seamless data.
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.article {
  border-radius: 5px;
  background: #fff;
  max-width: 310px;
  .article__image-container {
    position: relative;
    background: url('@/assets/images/editorsBg1.png') center center;
    opacity: 0.9;
    height: 350px;
    .article__categories {
      position: absolute;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      right: 20px;
      margin: 0;
      top: 10px;

      .article__category {
        padding: 5px 10px;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.15);
        @include unsetAll();
        z-index: 10;

        &:hover {
          opacity: 0.8;
        }

        .article__category-link {
          padding: 5px 10px;
          border-radius: 8px;
          background: rgba(255, 255, 255, 0.15);
          list-style: none;
          text-decoration: none;
          @include text(10px, 700);
        }
      }
    }
  }
  .article__content {
    display: flex;
    gap: 15px;
    flex-direction: column;
    padding: 120px 0 0 37px;
    .article__image {
      width: 20px;
    }
    .article__time {
      @include text(12px, 400);
      font-family: $secondaryFontFamily;
      color: $textColor3;
    }
    .article__title {
      @include text(18px, 700);
      font-family: $secondaryFontFamily;
      line-height: 25px;
      max-width: 270px;
    }
    .article__text {
      @include text(12px, 400);
      font-family: $secondaryFontFamily;
      color: $textColor3;
      line-height: 20px;
      max-width: 340px;
    }
  }
}
</style>
