<script setup>
import ConstructorHeader from '@/components/article_constructor/ConstructorHeader.vue'
import ConstructorMain from '@/components/article_constructor/ConstructorMain.vue'
</script>

<template>
  <div class="articleConstructor__container">
    <ConstructorHeader type="Article Editor" />
    <ConstructorMain type="new" />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
</style>
