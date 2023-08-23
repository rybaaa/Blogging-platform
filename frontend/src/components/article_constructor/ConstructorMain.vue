<script setup>
import InputComponent from '../general/InputComponent.vue'
import SubmitButton from '../general/SubmitButton.vue'
import { ref, computed, onMounted } from 'vue'
import { errorsStore } from '@/stores/errors'
import { articlesStore } from '@/stores/articles'
import MultiSelect from '@/components/general/MultiSelect.vue'
import { tagsStore } from '@/stores/tags.js'
import { QuillEditor } from '@vueup/vue-quill'
import InputImage from '@/components/general/InputImage.vue'
import CustomCheckbox from '@/components/general/CustomCheckbox.vue'

const props = defineProps({
  type: String,
  article: Object,
})

const errors = errorsStore()
const articles = articlesStore()
const tags = tagsStore()

const articleCover = ref(props.article?.cover_url || null)
const form = ref({
  title: props.type === 'new' ? '' : props.article.title,
  content: props.type === 'new' ? '' : props.article.content,
  cover: props.type === 'new' ? articleCover : props.article.cover_url,
  tags: [],
  isPremium: props.type === 'new' ? false : props.article.premium,
})
const isUploadFormOpened = ref(false)

function updateSelectedTags(tags) {
  form.value.tags = tags
}

function getTagsForCurrentArticle() {
  return props.article.tags.map((tag) => tag.title)
}

const selectedTags = computed({
  get: () => {
    return props.type === 'new' ? form.value.tags : getTagsForCurrentArticle()
  },
  set: (newTags) => {
    form.value.tags = newTags
  },
})
const handleSubmit = () => {
console.log(form.value.isPremium)

  const articleData = {
    title: form.value.title,
    content: form.value.content,
    cover: articles.uploadedImage ?? form.value.cover,
    tags: form.value.tags,
    premium: form.value.isPremium,
  }
  console.log(articleData)

  if (props.type === 'new') {
    articles.createArticle(articleData)
  } else {
    articles.updateArticle(props.article.id, articleData)
  }
}

const setPremium = () => {
  form.value.isPremium = !form.value.isPremium
}

onMounted(async () => {
  await tags.fetchTags()
  let qlEditorElement = document.querySelector('.ql-editor')
  qlEditorElement.innerHTML = form.value.content
})
</script>
<template>
  <div class="constructorMain__container">
    <section class="constructorMain">
      <h3 class="constructorMain__header">
        {{ props.type === 'new' ? 'Add Content' : 'Edit Content' }}
      </h3>
      <form class="constructorMain__form" @submit.prevent="handleSubmit">
        <InputComponent
          v-model:value="form.title"
          label="Title"
          name="title"
          type="text"
          placeholder="Set title"
          :error="errors.errors.title"
        />
        <div class="constructorMain__quillEditor">
          <label class="constructorMain__quillEditor-label">Content</label>
          <quill-editor
            v-model:content="form.content"
            content-type="html"
            theme="snow"
          ></quill-editor>
        </div>
        <MultiSelect
          :selectedTags="selectedTags"
          @update="updateSelectedTags"
        />
        <div
          @click="isUploadFormOpened = !isUploadFormOpened"
          class="constructorMain__articleCover"
        >
          <label class="constructorMain__articleCover-label"
            >Article cover:</label
          >
          <InputImage v-if="!props.article" />
        </div>
        <CustomCheckbox
          :value="form.isPremium"
          title="Premium article"
          @changeValue="setPremium"
          class="constructorMain__checkbox"
        />
        <div class="constructorMain__buttonWrapper">
          <SubmitButton
            :type="submit"
            class="constructorMain__button"
            @submit="handleSubmit"
            >{{ props.type === 'new' ? 'Add new' : 'Update' }}</SubmitButton
          >
        </div>
      </form>
    </section>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.constructorMain__container {
  background: #f8f9fa;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.constructorMain {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  @include containerWidth();
  min-height: 450px;
  padding: 50px 0 80px;
  @include for-phone-only {
    width: 80%;
  }
}
.constructorMain__header {
  @include text(36px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: normal;
}
.constructorMain__form {
  width: 100%;
}

.constructorMain__quillEditor {
  margin: 20px 0 20px;
}
.constructorMain__quillEditor-label {
  @include text(12px, 700, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}

.constructorMain__articleCover-label {
  @include text(12px, 700, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.constructorMain__buttonWrapper {
  display: flex;
  justify-content: center;
}
.constructorMain__button {
  width: 320px;
  margin: 20px 0 50px 0;
}
.constructorMain__checkbox {
  margin-top: 10px;
}
</style>
