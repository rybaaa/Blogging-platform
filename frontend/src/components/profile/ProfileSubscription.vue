<script setup>
import { userStore } from '@/stores/user'

const user = userStore()
</script>

<template>
  <div class="profileSubscription__wrapper">
    <section v-if="user.user.premiumType === null" class="profileSubscription">
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
        <h5 class="profileSubscription__headers-add">Manage subscription</h5>
      </div>
      <div class="profileSubscription__currentWrapper-existing">
        <div class="profileSubscription__current-existing">
          <div class="profileSubscription__current-container">
            <h4 class="profileSubscription__subscriptionTitle">
              {{ user.user.premiumType }} Premium
            </h4>
            <div class="profileSubscription__subscription-datesWrapper">
              <span class="profileSubscription__subscription-dates"
                >Expiry date: 11.11.2022</span
              >
              <span class="profileSubscription__subscription-dates"
                >Start date: 11.12.2022</span
              >
            </div>
            <h5
              class="profileSubscription__headers-add profileSubscription__subscription-buttonEdit"
            >
              Edit payment
            </h5>
            <h5
              class="profileSubscription__headers-add profileSubscription__subscription-buttonCancel"
            >
              Cancel subscription
            </h5>
          </div>
          <div class="profileSubscription__imageWrapper">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="156"
              height="156"
              viewBox="0 0 156 156"
              fill="none"
              class="profileSubscription__imageBackground"
            >
              <circle cx="78" cy="78" r="78" fill="#495057" />
            </svg>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="106"
              height="106"
              viewBox="0 0 106 106"
              fill="none"
              class="profileSubscription__image"
            >
              <path
                d="M80.2215 11.7856C81.1317 11.7856 81.9769 12.2245 82.5018 12.949L82.7064 13.2765L97.7502 41.4842L97.9112 41.8687L97.9548 42.0106L98.0186 42.3009L98.0535 42.6313L98.0457 43.0045L98.0562 42.7616C98.0562 43.1562 97.9751 43.532 97.8283 43.8733L97.7201 44.0971L97.5677 44.3472L97.3698 44.6044L55.2527 93.2794C54.8769 93.784 54.3621 94.1167 53.803 94.2766L53.5853 94.3296L53.2195 94.3802L52.9995 94.3881L52.6218 94.3626L52.3023 94.3021L51.9144 94.1749L51.8179 94.1291C51.4789 93.9792 51.1673 93.7558 50.9067 93.4626L8.58533 44.5499L8.35213 44.221L8.17225 43.8715L8.04204 43.4986L7.95515 43.0064L7.9541 42.528L8.0099 42.1575L8.0459 42.0103L8.17319 41.6494L8.27584 41.4366L23.2945 13.2765C23.7227 12.4735 24.5076 11.9343 25.3939 11.8121L25.7792 11.7856H80.2215ZM67.666 45.5776H38.3233L53.004 83.7249L67.666 45.5776ZM32.2935 45.5776H16.9144L44.5974 77.5598L32.2935 45.5776ZM89.075 45.5776H73.7072L61.4182 77.5335L89.075 45.5776ZM38.0718 17.4139H27.465L15.4463 39.9456H32.0607L38.0718 17.4139ZM62.0978 17.4139H43.899L37.8879 39.9456H68.1053L62.0978 17.4139ZM78.532 17.4139H67.925L73.9362 39.9456H90.5431L78.532 17.4139Z"
                fill="#D4A373"
              />
            </svg>
          </div>
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
.profileSubscription__imageWrapper {
  position: relative;
  height: 156px;
  width: 156px;
  margin-right: 200px;
  @include for-phone-only {
    display: none;
  }
}
.profileSubscription__imageBackground {
  position: absolute;
}
.profileSubscription__image {
  position: absolute;
  top: 30px;
  left: 25px;
}
</style>
