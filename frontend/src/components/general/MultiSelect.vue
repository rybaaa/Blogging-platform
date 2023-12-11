<script setup>
import Multiselect from '@vueform/multiselect'
import { tagsStore } from '@/stores/tags.js'

const tags = tagsStore()
const props = defineProps({
  selectedTags: Array,
})
const emit = defineEmits(['update'])
const onChange = (value) => {
  console.log(value)
  emit(
    'update',
    value.map((tag) => tag.value)
  )
}
const transformTags = props.selectedTags.map((item) => {
  return { value: item, label: item }
})
</script>

<template>
  <div class="multiSelect__container">
    <span class="multiSelect__title">Tags</span>
    <Multiselect
      @change="onChange"
      class="multiselect-brown"
      v-model="transformTags"
      mode="tags"
      :close-on-select="false"
      :filter-results="false"
      :min-chars="1"
      :resolve-on-load="false"
      :delay="0"
      :searchable="true"
      :object="true"
      :create-option="true"
      :options="
        async function (query) {
          await tags.fetchTags(query)
          return tags.tagTitles
        }
      "
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
