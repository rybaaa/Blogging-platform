<script setup>
import ModalComponent from '@/components/general/ModalComponent.vue'
import InputComponent from '@/components/general/InputComponent.vue'
import { ref } from 'vue'
import SubmitButton from '@/components/general/SubmitButton.vue'
import { errorsStore } from '@/stores/errors'
import { userStore } from '@/stores/user'

const form = ref({
  plan: 'Monthly',
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
</script>
<template>
  <div class="subscriptionModal__wrapper">
    <ModalComponent>
      <h4 class="subscriptionModal__title">Choose plan</h4>
      <div class="subscriptionModal__plan">
        <button
          class="subscriptionModal__plan-button"
          :class="{
            'subscriptionModal__plan-currentButton': currentPlan === 'Monthly',
          }"
          @click="setCurrentPlan('Monthly')"
        >
          Monthly
        </button>
        <button
          class="subscriptionModal__plan-button"
          :class="{
            'subscriptionModal__plan-currentButton': currentPlan === 'Yearly',
          }"
          @click="setCurrentPlan('Yearly')"
        >
          Yearly
        </button>
        <div v-if="currentPlan === 'Monthly'" class="subscriptionModal__prices">
          <div class="subscriptionModal__period">
            <span class="subscriptionModal__period-digits">20€ </span>
            <span class="subscriptionModal__period-letters">per month</span>
          </div>
          <div class="subscriptionModal__period">
            <span class="subscriptionModal__period-letters">Total: </span>
            <span class="subscriptionModal__period-digits">20€</span>
          </div>
        </div>
        <div v-else class="subscriptionModal__prices">
          <div class="subscriptionModal__period">
            <span class="subscriptionModal__period-digits">15€ </span>
            <span class="subscriptionModal__period-letters">per month</span>
          </div>
          <div class="subscriptionModal__period">
            <span class="subscriptionModal__period-letters">Total: </span>
            <span class="subscriptionModal__period-digits">180€</span>
          </div>
        </div>
      </div>
      <form @submit.prevent="">
        <InputComponent
          v-model:value="form.cardNumber"
          label="Card number"
          name="cardNumber"
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
            name="expiryMonth"
            type="text"
            class="subscriptionModal__cardInfo-expiryDate"
            :error="errors.errors.expiryMonth"
          />
          <InputComponent
            v-model:value="form.expiryYear"
            label="Year"
            name="expiryYear"
            type="text"
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
        <SubmitButton @submit="" :type="submit">Go premium</SubmitButton>
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
.subscriptionModal__plan-button {
  width: 50%;
  height: 44px;
  background: #d9d9d9;
  border: none;
  outline: none;
  @include text(12px, 700, #818181);
  color: #818181;
  font-family: $secondaryFontFamily;
  line-height: 25px;
  cursor: pointer;
  &:hover {
    opacity: 0.8;
  }
}
.subscriptionModal__plan-currentButton {
  background: #d4a373;
  color: #fff;
}
.subscriptionModal__prices {
  margin: 20px 0 20px;
  display: flex;
  justify-content: space-between;
}
.subscriptionModal__period-digits {
  @include text(16px, 700, $textColor4);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.subscriptionModal__period-letters {
  @include text(13px, 700, #888);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
</style>
