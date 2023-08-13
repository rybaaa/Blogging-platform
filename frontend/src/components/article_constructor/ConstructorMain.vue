<script setup>
import InputComponent from '../general/InputComponent.vue'
import SubmitButton from '../general/SubmitButton.vue'
import { ref } from 'vue'
import { errorsStore } from '@/stores/errors'
import { articlesStore } from '@/stores/articles'

const props = defineProps({
  type: String,
  article: Object,
})
let form = ref({
  title: props.type === 'new' ? '' : props.article.title,
  content: props.type === 'new' ? '' : props.article.content,
})
let options = {
  theme: 'snow',
  placeholder: 'Add content',
  contentType: 'html',
}
const errors = errorsStore()
const articles = articlesStore()
//v-model:value="form.title"
</script>
<template>
  <div class="constructorMain__container">
    <section class="constructorMain">
      <h3 class="constructorMain__header">
        {{ props.type === 'new' ? 'Add Content' : 'Edit Content' }}
      </h3>
      <form class="constructorMain__form" @submit.prevent="">
        <InputComponent
          v-model:value="form.title"
          label="Title"
          name="title"
          type="text"
          placeholder="Set title"
          :error="errors.errors.title"
        />
        <div class="constructorMain__quillEditor">
          <QuillEditor :options="options" v-model:content="form.content" />
        </div>
        <SubmitButton
          :type="submit"
          @submit="
            props.type === 'new'
              ? articles.createArticle(form)
              : articles.updateArticle(props.article.id, form)
          "
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
</style>
