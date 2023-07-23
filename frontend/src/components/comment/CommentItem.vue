<script setup>
import { onMounted } from 'vue'
import { format, intlFormatDistance } from 'date-fns'

const props = defineProps({
  comment: {
    type: Object,
    required: true,
  },
})
onMounted(() => {
  console.log(props.comment)
})
</script>

<template>
  <div class="commentItem">
    <img
      src="@/assets/images/face1.png"
      alt="avatar"
      class="commentItem__img"
    />
    <div class="commentItem__content">
      <h4 class="commentItem__content-title">
        {{ props.comment.author.name }}
      </h4>
      <span class="commentItem__content-date">
        {{
          `${format(
            new Date(props.comment.created_at),
            'dd.MM.yyyy'
          )} - ${intlFormatDistance(
            new Date(props.comment.created_at),
            new Date()
          )}`
        }}</span
      >
      <p class="commentItem__content-text">
        {{ comment.content }}
      </p>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.commentItem {
  border-radius: 21px;
  background: #e7e7e7;
  padding: 30px;
  display: flex;
  gap: 30px;
  max-width: 100%;
}
.commentItem__img {
  width: 50px;
  height: 50px;
}
.commentItem__content {
  display: flex;
  flex-direction: column;
  max-width: 90%;
  @include for-phone-only {
    max-width: 80%;
  }
}
.commentItem__content-title {
  @include text(12px, 700);
  color: #343a40;
  font-family: $secondaryFontFamily;
  line-height: 20px;
}
.commentItem__content-date {
  @include text(12px, 700);
  color: #858585;
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.commentItem__content-text {
  @include text(14px, 400);
  font-family: $secondaryFontFamily;
  color: $textColor2;
  line-height: 25px;
  max-width: 100%;
  word-wrap: break-word;
}
</style>
