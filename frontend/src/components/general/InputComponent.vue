<script setup>
defineProps({
  value: String,
  name: String,
  type: String,
  label: String,
})
//import { appStore } from '../../stores/app'

//const modal = appStore()
</script>
<template>
  <div class="inputComponent__group">
    <label :for="name" class="inputComponent__label">{{ label }}</label>
    <input
      :value="value"
      :type="type"
      :name="name"
      class="inputComponent__input"
    />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.inputComponent__group {
  display: flex;
  flex-direction: column;
  margin-bottom: 25px;
}
.inputComponent__label {
  @include text(12px, 700, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.inputComponent__input {
  height: 42px;
  background: #fff;
  @include text(12px, 500, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  padding: 7px 14px;
  border: 1px solid #495057;
  outline: none;
}
</style>
