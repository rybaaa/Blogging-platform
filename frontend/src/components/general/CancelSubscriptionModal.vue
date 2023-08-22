<script setup>
import ModalComponent from '@/components/general/ModalComponent.vue'
import { modalStore } from '@/stores/modal'
import { userStore } from '@/stores/user'

const modal = modalStore()
const user = userStore()
</script>
<template>
  <div class="cancelSubscriptionModal__wrapper">
    <ModalComponent>
      <h4 class="cancelSubscriptionModal__title">
        Are you sure you want to cancel subscription?
      </h4>
      <div class="cancelSubscriptionModal__buttons">
        <button
          @click="user.deleteSubscription"
          class="cancelSubscriptionModal__button cancelSubscriptionModal__button-yes"
        >
          Yes
        </button>
        <button
          @click="modal.closeModal"
          class="cancelSubscriptionModal__button cancelSubscriptionModal__button-no"
        >
          No
        </button>
      </div>
    </ModalComponent>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.cancelSubscriptionModal__buttons {
  margin-top: 20px;
}
.cancelSubscriptionModal__button {
  width: 50%;
  height: 44px;
  @include text(12px, 700);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  border: none;
  outline: none;
  cursor: pointer;
  &:hover {
    opacity: 0.8;
  }
}
.cancelSubscriptionModal__button-yes {
  background: #495057;
}
.cancelSubscriptionModal__button-no {
  background: #d4a373;
}
.cancelSubscriptionModal__title {
  @include text(13px, 700, #495057);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  margin-bottom: 25px;
  width: 90%;
}
</style>
