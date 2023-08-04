<script setup>
import plus from '@/assets/images/plus.svg'
</script>

<template>
  <div class="addArticleFromProfile__container">
    <div class="addArticleFromProfile__wrapper">
      <img :src="plus" alt="plus sign" class="addArticleFromProfile__image" />
      <h4 class="addArticleFromProfile__title">Add new article</h4>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.addArticleFromProfile__container {
  width: 420px;
  height: 350px;
  border-radius: 5px;
  border: 2px dashed #ddd;
  background: $textColor1;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  &:hover {
    background: #ada6a6;
  }
  @include for-phone-only {
    width: 300px;
  }
}
.addArticleFromProfile__wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 25px;
}
.addArticleFromProfile__image {
  width: 67px;
  height: 67px;
}
.addArticleFromProfile__title {
  @include text(18px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
</style>
