<script setup>
import ModalComponent from '@/components/general/ModalComponent.vue'
import InputComponent from '@/components/general/InputComponent.vue'
import { ref } from 'vue'
import SubmitButton from '@/components/general/SubmitButton.vue'
import { errorsStore } from '@/stores/errors'
import { userStore } from '@/stores/user'
import SubscriptionPlanToggle from '@/components/general/SubscriptionPlanToggle.vue'

const form = ref({
  cardNumber: '',
  ccv: '',
  expiryMonth: '',
  expiryYear: '',
  name: '',
  surname: '',
  address: '',
})
const user = userStore()
const errors = errorsStore()

let currentPlan = ref('Monthly')
const setCurrentPlan = (title) => {
  currentPlan.value = title
}

const submitForm = () => {
  let params = {
    name: form.value.name,
    surname: form.value.surname,
    subscription_plan_id: currentPlan.value === 'Monthly' ? 1 : 2,
    credit_card_number: form.value.cardNumber,
    ccv: form.value.ccv,
    expiry_date: `${form.value.expiryMonth}/${form.value.expiryYear}`,
    address: form.value.address,
  }
  user.makeSubscription(params)
}
</script>
<template>
  <div class="subscriptionModal__wrapper">
    <ModalComponent>
      <h4 class="subscriptionModal__title">Choose plan</h4>
      <SubscriptionPlanToggle :plan="currentPlan" @toggle="setCurrentPlan" />
      <form @submit.prevent="submitForm">
        <InputComponent
          v-model:value="form.cardNumber"
          label="Card number"
          name="credit_card_number"
          type="text"
          :error="errors.errors.cardNumber"
        />
        <div class="subscriptionModal__cardInfo">
          <InputComponent
            v-model:value="form.ccv"
            label="CCV"
            name="ccv"
            type="text"
            class="subscriptionModal__cardInfo-ccv"
            :error="errors.errors.ccv"
          />
          <InputComponent
            v-model:value="form.expiryMonth"
            label="Expiry date"
            name="expiry_date"
            type="text"
            placeholder="MM"
            class="subscriptionModal__cardInfo-expiryDate"
            :error="errors.errors.expiry_date"
          />
          <InputComponent
            v-model:value="form.expiryYear"
            label="Year"
            name="expiryYear"
            type="text"
            placeholder="YY"
            class="subscriptionModal__cardInfo-expiryDate"
            :error="errors.errors.expiryYear"
          />
        </div>
        <InputComponent
          v-model:value="form.name"
          label="Name"
          name="name"
          type="text"
          placeholder="Your name"
          :error="errors.errors.name"
        />
        <InputComponent
          v-model:value="form.surname"
          label="Surname"
          name="surname"
          type="text"
          placeholder="Your surname"
          :error="errors.errors.surname"
        />
        <InputComponent
          v-model:value="form.address"
          label="Address - optional"
          name="address"
          type="text"
          :error="errors.errors.address"
        />
        <SubmitButton @submit="submitForm" :type="submit"
          >Go premium</SubmitButton
        >
      </form>
    </ModalComponent>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.subscriptionModal__title {
  @include text(18px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  margin-bottom: 25px;
}
.subscriptionModal__cardInfo {
  display: flex;
  gap: 12px;
}
.subscriptionModal__cardInfo-ccv {
  width: 142px;
}
.subscriptionModal__cardInfo-expiryDate {
  width: 62px;
}
.subscriptionModal__cardInfo-expiryDate > .inputComponent__label {
  color: red;
}
</style>
