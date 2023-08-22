<script setup>
import ModalComponent from '@/components/general/ModalComponent.vue'
import InputComponent from '../general/InputComponent.vue'
import { ref } from 'vue'
import SubmitButton from '../general/SubmitButton.vue'
import { errorsStore } from '../../stores/errors'
import { userStore } from '../../stores/user'
import CustomCheckbox from '../general/CustomCheckbox.vue'

const form = ref({
  email: '',
  password: '',
  name: '',
})
let isPremium = ref(false)
const user = userStore()
const errors = errorsStore()

const setPremium = () => {
  isPremium.value = !isPremium.value
}
</script>
<template>
  <div class="registerModal__wrapper">
    <ModalComponent>
      <h4 class="registerModal__title">Register</h4>
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
        <CustomCheckbox
          :value="isPremium"
          title="I want Premium"
          @changeValue="setPremium"
        />
        <SubmitButton
          @submit="user.registerUser(form, isPremium)"
          :type="submit"
          >Register</SubmitButton
        >
      </form>
    </ModalComponent>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.registerModal__title {
  @include text(18px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  margin-bottom: 25px;
}
</style>
