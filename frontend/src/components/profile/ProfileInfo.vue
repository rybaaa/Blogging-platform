<script setup>
import InputComponent from '../general/InputComponent.vue'
import SubmitButton from '../general/SubmitButton.vue'
import { userStore } from '../../stores/user'
import { ref } from 'vue'

const user = userStore()
let form = ref({
  name: user.user.name,
  email: user.user.email,
})
</script>

<template>
  <div class="profileInfo__container">
    <section class="profileInfo">
      <h3 class="profileInfo__header">Edit profile</h3>
      <form class="profileInfo__form" @submit.prevent="user.update(form)">
        <InputComponent
          v-model:value="form.email"
          label="Email"
          name="email"
          type="email"
          placeholder="your-email@email.com"
          :error="user.errors.email"
        />
        <InputComponent
          v-model:value="form.name"
          label="Name"
          name="name"
          type="text"
          placeholder="Your name"
          :error="user.errors.name"
        />
        <SubmitButton @submit="user.update(form)" :type="submit"
          >Update</SubmitButton
        >
      </form>
    </section>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.profileInfo__container {
  background: #f8f9fa;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.profileInfo {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 50px;
  width: 510px;
  min-height: 450px;
  padding: 50px 0 80px;
  @include for-phone-only {
    width: 80%;
  }
}
.profileInfo__header {
  @include text(36px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: normal;
}
.profileInfo__form {
  width: 100%;
}
</style>
