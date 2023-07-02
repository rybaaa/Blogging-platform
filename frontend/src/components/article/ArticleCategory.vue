<script>
export default {
  name: 'ArticleCategory',
}
</script>

<template>
  <ul class="article__categories">
    <li class="article__category">
      <a class="article__category-link" href="#">ADVENTURE</a>
    </li>
    <li class="article__category">
      <a class="article__category-link" href="#">ADVENTURE2</a>
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

  .article__category {
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

    .article__category-link {
      list-style: none;
      text-decoration: none;
      @include text(10px, 700);
    }
  }
}
.article__category--card {
  position: absolute;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  right: 20px;
  margin: 0;
  top: 10px;
}
</style>
