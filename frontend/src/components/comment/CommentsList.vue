<script setup>
import { ref } from 'vue'
import CommentItem from './CommentItem.vue'
import Comments from '@/api/Comments'
import { useRoute } from 'vue-router'
import { userStore } from '@/stores/user'
import { errorsStore } from '@/stores/errors'
import errorsHandler from '@/utils/errorsHandler'
import { appStore } from '@/stores/app'

defineProps({
  comments: {
    type: Object,
    required: true,
  },
})

let commentText = ref('')
const route = useRoute()
const emit = defineEmits(['addNewComment'])
const user = userStore()
const errors = errorsStore()
const app = appStore()

const sendComment = async () => {
  app.setSubmitting('isLoading')
  try {
    let response = await Comments.store({
      content: commentText.value,
      article_id: route.params.id,
    })
    emit('addNewComment', response.data.data)
    commentText.value = ''
  } catch (errorMsg) {
    errorsHandler(errorMsg, errors)
  } finally {
    app.setSubmitting('idle')
  }
}

const changeValue = (event) => {
  commentText.value = event.target.value
  errors.eraseErrors()
}
</script>

<template>
  <div class="commentsList__container">
    <h3 class="commentsList__title">Comments:</h3>
    <form class="commentsList__form" @submit.prevent="sendComment">
      <img
        :src="user.user.avatar === null ? user.defaultAvatar : user.user.avatar"
        alt="avatar"
        class="commentsList__img"
      />
      <textarea
        :value="commentText"
        type="text"
        placeholder="Write a comment..."
        class="commentsList__input"
        @input="changeValue"
      ></textarea>
      <p class="commentsList__error">
        {{
          errors.errors.message
            ? errors.errors.message
            : errors.errors.content
            ? errors.errors.content[0]
            : ''
        }}
      </p>
      <button type="submit" class="commentsList__button">Send</button>
    </form>
    <div v-if="comments.length" class="commentsList__list">
      <CommentItem
        v-for="comment in comments"
        :comment="comment"
        :key="comment.id"
      />
    </div>
    <span v-else class="commentsList__noComment">No comments yet</span>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.commentsList__container {
  margin-top: 47px;
}
.commentsList__title {
  @include text(18px, 700);
  color: $textColor2;
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.commentsList__img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
.commentsList__form {
  position: relative;
  margin-top: 24px;
  border-radius: 21px;
  background: #e7e7e7;
  height: 103px;
  display: flex;
  align-items: center;
  padding: 30px;
  gap: 33px;
}
.commentsList__input {
  border-radius: 21px;
  height: 45px;
  background: $bgColor;
  padding: 9px 20px;
  width: 100%;
  max-width: 712px;
  @include text(14px, 400);
  color: $textColor2;
  font-family: $secondaryFontFamily;
  line-height: 25px;
  resize: none;
  border: none;
  outline: none;
}
.commentsList__error {
  position: absolute;
  bottom: 0;
  @include text(12px, 700);
  color: red;
}
.commentsList__button {
  position: absolute;
  right: 40px;
  width: 62px;
  height: 29px;
  border-radius: 21px;
  background: #d4a373;
  padding: 2px 17px;
  @include text(12px, 400);
  font-family: $secondaryFontFamily;
  text-align: center;
  line-height: 25px;
  border: none;
  &:hover {
    cursor: pointer;
    opacity: 0.8;
  }
}
.commentsList__list {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-top: 16px;
}
.commentsList__noComment {
  display: block;
  text-align: center;
  @include text(30px, 700);
  color: $textColor2;
  margin-top: 30px;
}
</style>
