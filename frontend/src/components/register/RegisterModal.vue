<script setup>
import ModalComponent from '@/components/general/ModalComponent.vue'
import InputComponent from '../general/InputComponent.vue'
import { ref } from 'vue'
import SubmitButton from '../general/SubmitButton.vue'
import { errorsStore } from '../../stores/errors'
import { userStore } from '../../stores/user'

const form = ref({
  email: '',
  password: '',
  name: '',
})
const user = userStore()
const errors = errorsStore()
</script>
<template>
  <div class="logIn__wrapper">
    <ModalComponent>
      <h4 class="logIn__title">Register</h4>
      <form @submit.prevent="user.registerUser(form)">
        <InputComponent
          v-model:value="form.email"
          label="Email"
          name="email"
          type="email"
          placeholder="your-email@email.com"
          :error="errors.errors.email"
        />
        <InputComponent
          v-model:value="form.name"
          label="Name"
          name="name"
          type="text"
          placeholder="Your name"
          :error="errors.errors.name"
        />
        <InputComponent
          v-model:value="form.password"
          label="Password"
          name="password"
          type="password"
          :placeholder="'Password'"
          :error="errors.errors.password"
        />
        <SubmitButton @submit="user.registerUser(form)" :type="submit"
          >Register</SubmitButton
        >
      </form>
    </ModalComponent>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.logIn__title {
  @include text(18px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  margin-bottom: 25px;
}
</style>
