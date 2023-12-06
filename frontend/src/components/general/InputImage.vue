<script setup>
import { useImageUpload } from '@/utils/useImageUpload.js'

let { imageUrl, handleImageSelected } = useImageUpload()
</script>

<template>
  <div class="inputImage__container">
    <form class="inputImage__form">
      <img v-show="imageUrl" :src="imageUrl" class="inputImage__image" />
      <div>
        <input
          class="inputImage__button"
          type="file"
          accept="image/*"
          @change="handleImageSelected"
        />
      </div>
    </form>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.inputImage__container {
  display: flex;
  height: 90%;
}

.inputImage__message {
  width: 100px;
  height: 100px;
}

.inputImage__image {
  width: 100%;
  height: 300px;
}

.inputImage__button {
  @include text(12px, 700, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
</style>
