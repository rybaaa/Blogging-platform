<script setup>
import ModalComponent from '@/components/general/ModalComponent.vue'
import InputComponent from '../general/InputComponent.vue'
import { ref } from 'vue'
import SubmitButton from '../general/SubmitButton.vue'
import { userStore } from '../../stores/user'

const form = ref({
  email: '',
  password: '',
})
const user = userStore()
</script>
<template>
  <div class="logIn__wrapper">
    <ModalComponent>
      <h4 class="logIn__title">Log in</h4>
      <InputComponent
        v-model:value="form.email"
        label="Email"
        name="email"
        type="email"
        :placeholder="'your-email@email.com'"
        :error="user.errors.email"
      />
      <InputComponent
        v-model:value="form.password"
        label="Password"
        name="password"
        type="password"
        :placeholder="'Password'"
        :error="user.errors.password"
      />
      <SubmitButton @submit="user.login(form)" :type="submit"
        >Log in</SubmitButton
      >
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
