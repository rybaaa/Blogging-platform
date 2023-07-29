<script setup>
defineProps({
  type: {
    type: String,
    default: 'button',
  },
})
const emit = defineEmits(['submit'])
</script>
<template>
  <button @click="emit('submit')" :type="type" class="submitButton">
    <slot></slot>
  </button>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.submitButton {
  height: 42px;
  width: 100%;
  background: #d4a373;
  @include text(12px, 700);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  border: none;
  outline: none;
  cursor: pointer;
  &:hover {
    opacity: 0.8;
  }
}
</style>
