<script setup>
import { userStore } from '@/stores/user'
import PremiumGemImage from '@/components/general/PremiumGemImage.vue'
import { modalStore } from '@/stores/modal'

const user = userStore()
const modal = modalStore()
</script>

<template>
  <div class="profileSubscription__wrapper">
    <section
      v-if="user.user.is_subscriber === false"
      class="profileSubscription"
    >
      <div class="profileSubscription__headers">
        <h4 class="profileSubscription__headers-my">My subscription</h4>
        <h5 class="profileSubscription__headers-add">Add subscription</h5>
      </div>
      <div class="profileSubscription__currentWrapper">
        <div class="profileSubscription__current">
          <span class="profileSubscription__current-title"
            >No active subscription
          </span>
          <button class="profileSubscription__current-button">
            Go Premium
          </button>
        </div>
      </div>
    </section>
    <section v-else class="profileSubscription">
      <div class="profileSubscription__headers">
        <h4 class="profileSubscription__headers-my">My subscription</h4>
        <RouterLink
          :to="{ name: 'edit subscription' }"
          class="profileSubscription__link"
        >
          <h5 class="profileSubscription__headers-add">
            Manage subscription
          </h5></RouterLink
        >
      </div>
      <div class="profileSubscription__currentWrapper-existing">
        <div class="profileSubscription__current-existing">
          <div class="profileSubscription__current-container">
            <h4 class="profileSubscription__subscriptionTitle">
              {{ user.user.premiumType }} Premium
            </h4>
            <div class="profileSubscription__subscription-datesWrapper">
              <span class="profileSubscription__subscription-dates"
                >Expiry date:
                {{ user.user.subscription_history[0].end_date }}</span
              >
              <span class="profileSubscription__subscription-dates"
                >Start date:
                {{ user.user.subscription_history[0].start_date }}</span
              >
            </div>
            <h5
              class="profileSubscription__headers-add profileSubscription__subscription-buttonEdit"
            >
              Edit payment
            </h5>
            <h5
              @click="modal.openCancelSubscriptionModal()"
              class="profileSubscription__headers-add profileSubscription__subscription-buttonCancel"
            >
              Cancel subscription
            </h5>
          </div>
          <PremiumGemImage />
        </div>
      </div>
    </section>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.profileSubscription__wrapper {
  background: rgba(229, 229, 229, 0.3);
}
.profileSubscription {
  min-height: 380px;
  @include containerWidth();
  padding: 70px 20px;
  @include for-phone-only {
    padding: 30px;
  }
}
.profileSubscription__headers {
  display: flex;
  justify-content: space-between;
  align-items: center;
  @include for-phone-only {
    flex-direction: column;
    gap: 20px;
  }
}
.profileSubscription__headers-my {
  @include text(36px, 700, $textColor2);
  font-family: $secondaryFontFamily;
  line-height: normal;
  @include for-phone-only {
    font-size: 30px;
  }
}
.profileSubscription__headers-add {
  @include text(17px, 700, $textColor4);
  font-family: $secondaryFontFamily;
  line-height: 20px;
  padding: 10px;
  cursor: pointer;
  &:hover {
    border-radius: 10px;
    color: #fff;
    background-color: $textColor4;
  }
}
.profileSubscription__currentWrapper {
  width: 100%;
  height: 158px;
  border: 1px dashed #495057;
  background: $textColor1;
  margin-top: 50px;
  display: flex;
  align-items: center;
}
.profileSubscription__current {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 38px;
  @include for-phone-only {
    flex-direction: column;
    gap: 20px;
    padding: 0;
  }
}
.profileSubscription__current-container {
  display: flex;
  flex-direction: column;
}
.profileSubscription__current-title {
  @include text(18px, 700, #495057);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.profileSubscription__current-button {
  width: 339px;
  height: 42px;
  background: #d4a373;
  @include text(12px, 700);
  font-family: $secondaryFontFamily;
  text-align: center;
  line-height: 25px;
  border: none;
  outline: none;
  cursor: pointer;
  &:hover {
    opacity: 0.8;
  }
  @include for-phone-only {
    width: 80%;
  }
}
.profileSubscription__currentWrapper-existing {
  width: 100%;
  border: 1px dashed #495057;
  background: $textColor1;
  margin-top: 50px;
  display: flex;
}
.profileSubscription__current-existing {
  width: 100%;
  display: flex;
  padding: 40px;
  justify-content: space-between;
  align-items: center;
  @include for-phone-only {
    flex-direction: column;
    gap: 20px;
    padding: 0;
  }
}
.profileSubscription__subscriptionTitle {
  @include text(24px, 700, #d4a373);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.profileSubscription__subscription-datesWrapper {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin: 25px 0 25px;
}
.profileSubscription__subscription-dates {
  @include text(16px, 700, #495057);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.profileSubscription__subscription-buttonEdit {
  width: 120px;
  padding: 10px 10px 10px 0;
}
.profileSubscription__subscription-buttonCancel {
  @include text(12px, 700, #495057);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  width: 125px;
  padding: 10px 10px 10px 0;
}
.profileSubscription__link {
  @include unsetAll();
}
</style>
