<script setup>
import ModalComponent from '@/components/general/ModalComponent.vue'
import InputComponent from '../general/InputComponent.vue'
import { ref } from 'vue'
import SubmitButton from '../general/SubmitButton.vue'

let email = ref('')
let password = ref('')
let name = ref('')
const register = () => {
  alert(email.value + '-' + password.value)
}
</script>
<template>
  <div class="logIn__wrapper">
    <ModalComponent>
      <h4 class="logIn__title">Register</h4>
      <InputComponent
        :value="email"
        label="Email"
        name="email"
        type="email"
        :placeholder="'your-email@email.com'"
      />
      <InputComponent
        :value="name"
        label="Name"
        name="name"
        type="text"
        :placeholder="'Your name'"
      />
      <InputComponent
        :value="password"
        label="Password"
        name="password"
        type="password"
        :placeholder="'Password'"
      />
      <SubmitButton @submit="register" :type="submit">Log in</SubmitButton>
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
