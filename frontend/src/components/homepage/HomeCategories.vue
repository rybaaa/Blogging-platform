<script>
export default {
  name: 'HomeCategories',
}
</script>

<template>
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
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

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
</style>
