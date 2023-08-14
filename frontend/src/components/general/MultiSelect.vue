<script setup>
import Multiselect from '@vueform/multiselect'
import { ref } from 'vue'
import { tagsStore } from '@/stores/tags.js'

const tags = tagsStore()
const props = defineProps({
  selectedTags: Array,
})
const emit = defineEmits(['update'])
const onChange = (value) => {
  console.log(value)
  //currentTags.value = value
  emit('update', value)
}
</script>

<template>
  <div class="multiSelect__container">
    <span class="multiSelect__title">Tags</span>
    <Multiselect
      v-model="props.selectedTags"
      mode="tags"
      :close-on-select="false"
      :searchable="true"
      :options="tags.tagTitles"
      @change="onChange"
      class="multiselect-brown"
    />
  </div>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>
<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.multiSelect__container {
  margin: 20px 0;
}
.multiSelect__title {
  @include text(12px, 700, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}

.multiselect-brown {
  --ms-tag-bg: #d4a373;
  --ms-tag-color: #fff;
}
.multiselect.is-active {
  box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
}
</style>
