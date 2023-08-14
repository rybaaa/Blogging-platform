<script setup>
import InputComponent from '../general/InputComponent.vue'
import SubmitButton from '../general/SubmitButton.vue'
import { ref, computed, watch } from 'vue'
import { errorsStore } from '@/stores/errors'
import { articlesStore } from '@/stores/articles'
import myUpload from 'vue-image-crop-upload'
import MultiSelect from '@/components/general/MultiSelect.vue'
import { tagsStore } from '@/stores/tags.js'

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
})

const options = {
  theme: 'snow',
  placeholder: 'Add content',
  contentType: 'html',
}

const isUploadFormOpened = ref(false)

function updateSelectedTags(tags) {
  form.value.tags = tags
}

const cropSuccess = (coverImage) => {
  form.value.cover = coverImage
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
  const articleData = {
    title: form.value.title,
    content: form.value.content,
    cover: form.value.cover,
    tags: form.value.tags,
  }
  console.log(articleData)

  if (props.type === 'new') {
    articles.createArticle(articleData)
  } else {
    articles.updateArticle(props.article.id, articleData)
  }
}

await tags.fetchTags()
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
          <QuillEditor
            :options="options"
            v-model:content="form.content"
            :content="form.content"
          />
        </div>
        <MultiSelect
          :selectedTags="selectedTags"
          @update="updateSelectedTags"
        />
        <div
          @click="isUploadFormOpened = !isUploadFormOpened"
          class="constructorMain__articleCover"
          :style="{
            background: articleCover
              ? `url(${form.cover}) center center`
              : `url(https://www.learningaboutelectronics.com/images/Upload-photo-image.png) center center`,
            'background-size': 'cover',
          }"
        >
          <span class="constructorMain__articleCover-label"
            >Click here to upload article cover</span
          >
          <my-upload
            v-model="isUploadFormOpened"
            field="cover"
            lang-type="'en'"
            @crop-success="cropSuccess"
          ></my-upload>
        </div>
        <SubmitButton
          :type="submit"
          class="constructorMain__button"
          @submit="handleSubmit"
          >{{ props.type === 'new' ? 'Add' : 'Update' }}</SubmitButton
        >
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
  margin: 50px 0;
  height: 150px;
}

.constructorMain__articleCover {
  width: 300px;
  height: 200px;
  cursor: pointer;
}
.constructorMain__articleCover-label {
  @include text(14px, 400, $textColor2);
  font-family: $secondaryFontFamily;
}
.constructorMain__button {
  margin: 20px 0;
}
</style>
