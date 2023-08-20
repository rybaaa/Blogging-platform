<script setup>
import InputComponent from '@/components/general/InputComponent.vue'
import SubmitButton from '@/components/general/SubmitButton.vue'
import { userStore } from '@/stores/user'
import { ref } from 'vue'
import { errorsStore } from '@/stores/errors'
import SubscriptionPlanToggle from '@/components/general/SubscriptionPlanToggle.vue'
import PurchaseHistory from './PurchaseHistory.vue'

const user = userStore()
const errors = errorsStore()
const form = ref({
  cardNumber: '',
  ccv: '',
  expiryMonth: '',
  expiryYear: '',
  name: '',
  surname: '',
  address: '',
})
let currentPlan = ref('Monthly')
const setCurrentPlan = (title) => {
  currentPlan.value = title
}
</script>

<template>
  <div class="editSubscription__container">
    <section class="editSubscription">
      <h3 class="editSubscription__header">Edit subscription</h3>
      <SubscriptionPlanToggle :plan="currentPlan" @toggle="setCurrentPlan" />
      <form class="profileInfo__form" @submit.prevent="">
        <InputComponent
          v-model:value="form.cardNumber"
          label="Card number"
          name="cardNumber"
          type="text"
          :error="errors.errors.cardNumber"
        />
        <div class="editSubscription__cardInfo">
          <InputComponent
            v-model:value="form.ccv"
            label="CCV"
            name="ccv"
            type="text"
            class="editSubscription__cardInfo-ccv"
            :error="errors.errors.ccv"
          />
          <InputComponent
            v-model:value="form.expiryMonth"
            label="Expiry date"
            name="expiryMonth"
            type="text"
            class="editSubscription__cardInfo-expiryDate"
            :error="errors.errors.expiryMonth"
          />
          <InputComponent
            v-model:value="form.expiryYear"
            label="Year"
            name="expiryYear"
            type="text"
            class="editSubscription__cardInfo-expiryDate"
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
        <SubmitButton :type="submit" @submit="">Go Premium</SubmitButton>
      </form>
      <PurchaseHistory />
    </section>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.editSubscription__container {
  background: #f8f9fa;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.editSubscription {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 510px;
  min-height: 450px;
  padding: 50px 0 80px;
  @include for-phone-only {
    width: 80%;
  }
}
.editSubscription__header {
  @include text(36px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: normal;
  margin-bottom: 40px;
}
.profileInfo__form {
  width: 100%;
}
.editSubscription__cardInfo {
  display: flex;
  gap: 12px;
}
.editSubscription__cardInfo-ccv {
  width: 50%;
}
.editSubscription__cardInfo-expiryDate {
  width: 25%;
}
</style>