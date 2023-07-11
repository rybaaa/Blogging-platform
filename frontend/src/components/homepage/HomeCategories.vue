<script>
export default {
  name: 'HomeCategories',
}
</script>

<template>
  <div class="homeCategories">
    <h2 class="homeCategories__title">Popular topics</h2>
    <ul class="homeCategories__list">
      <li class="homeCategories__category homeCategories__category-active">
        <a href="#" class="homeCategories__category-link"></a>All
      </li>
      <li class="homeCategories__category">
        <a href="#" class="homeCategories__category-link"></a>Adventure
      </li>
      <li class="homeCategories__category">
        <a href="#" class="homeCategories__category-link"></a>Travel
      </li>
      <li class="homeCategories__category">
        <a href="#" class="homeCategories__category-link"></a>Fashion
      </li>
      <li class="homeCategories__category">
        <a href="#" class="homeCategories__category-link"></a>Technology
      </li>
      <li class="homeCategories__category">
        <a href="#" class="homeCategories__category-link"></a>Branding
      </li>
      <li class="homeCategories__category homeCategories__category-last">
        <a href="#" class="homeCategories__category-link"></a>View all
      </li>
    </ul>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.homeCategories__title {
  @include text(36px, 700);
  font-family: $secondaryFontFamily;
  color: $textColor2;
  margin-bottom: 30px;
}
.homeCategories__list {
  @include unsetAll();
  display: flex;
  margin-bottom: 30px;
  @include for-phone-only {
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
  }
}
.homeCategories__category {
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
  @include for-phone-only {
    margin: 0;
  }
}
.homeCategories__category-active {
  color: #d4a373;
}
.homeCategories__category-last {
  margin-left: auto;
  margin-right: 0;
  @include for-phone-only {
    margin: 0;
  }
}
</style>
