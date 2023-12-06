<script setup>
defineProps({
  type: String,
})
</script>

<template>
  <div class="constructorHeader__container">
    <section class="constructorHeader">
      <h2 class="constructorHeader__title">{{ type }}</h2>
      <span class="constructorHeader__divider"></span>
      <RouterLink class="constructorHeader__link" :to="{ name: 'profile' }">
        <span class="constructorHeader__link-edit">Back to profile</span>
      </RouterLink>
    </section>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.constructorHeader__container {
  background-color: #3e3e3e;
}
.constructorHeader {
  min-height: 359px;
  display: flex;
  flex-direction: column;
  @include containerWidth();
  align-items: center;
  text-align: center;
  padding: 145px 0 35px;
  gap: 40px;
}

.constructorHeader__title {
  @include text(36px, 700);
  font-family: $secondaryFontFamily;
  line-height: normal;
}
.constructorHeader__divider {
  width: 31px;
  border: 2px solid $textColor4;
}
.constructorHeader__link {
  @include text(12px, 700, $textColor4);
  font-family: $secondaryFontFamily;
  line-height: 20px;
  cursor: pointer;
  padding: 5px;
  text-decoration: none;
  &:hover {
    border-radius: 10px;
    color: #fff;
    background-color: $textColor4;
  }
}
</style>
