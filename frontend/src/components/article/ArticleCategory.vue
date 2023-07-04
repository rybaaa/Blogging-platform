<script>
export default {
  name: 'ArticleCategory',
}
</script>

<template>
  <ul class="article__categories">
    <li class="articleCategory">
      <a class="articleCategory-link" href="#">ADVENTURE</a>
    </li>
    <li class="articleCategory">
      <a class="articleCategory-link" href="#">ADVENTURE2</a>
    </li>
  </ul>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.article__categories {
  @include unsetAll();
  display: flex;
  gap: 20px;

  .articleCategory {
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

    .articleCategory-link {
      list-style: none;
      text-decoration: none;
      @include text(10px, 700);
    }
  }
}
.articleItem__category--card {
  position: absolute;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  right: 20px;
  margin: 0;
  top: 10px;
}
.articleCategory-showArticle {
  margin: 50px 0;
  .articleCategory {
    display: inline-flex;
    padding: 5px 10px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    border-radius: 5px;
    border: 1px solid #e5e5e5;
    &:hover {
      opacity: 0.8;
    }
    .articleCategory-link {
      list-style: none;
      text-decoration: none;
      @include text(10px, 700);
      color: #6c757d;
    }
  }
  @include for-phone-only {
    margin: 20px 0;
  }
}
</style>
