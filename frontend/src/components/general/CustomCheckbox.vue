<script setup>
defineProps({
  title: String,
  value: Boolean,
})
const emit = defineEmits(['changeValue'])
</script>
<template>
  <div class="customCheckbox__wrapper">
    <input
      class="customCheckbox__checkbox"
      type="checkbox"
      name="premium"
      :checked="isPremium"
      @change="emit('changeValue')"
    />
    <label class="customCheckbox__checkbox-label" for="premium"
      >I want Premium</label
    >
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.customCheckbox__wrapper {
  margin-bottom: 28px;
  display: flex;
  gap: 14px;
  align-items: center;
}
.customCheckbox__checkbox {
  width: 20px;
  height: 20px;
  flex-shrink: 0;
  fill: #fff;
  stroke-width: 1px;
  stroke: #495057;
  cursor: pointer;
}
.customCheckbox__checkbox-label {
  @include text(11px, 500, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
</style>
