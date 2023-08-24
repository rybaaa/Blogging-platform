<script setup>
import { modalStore } from '@/stores/modal'
import { userStore } from '@/stores/user'

const modal = modalStore()
const user = userStore()
</script>

<template>
  <div class="premiumAlert__wrapper">
    <div class="premiumAlert">
      <div class="premiumAlert__imageWrapper">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          viewBox="0 0 16 16"
          fill="none"
          class="premiumAlert__image"
        >
          <path
            d="M12.1431 1.71436C12.2816 1.71436 12.4102 1.78114 12.4901 1.8914L12.5212 1.94125L14.8108 6.23424L14.8353 6.29276L14.8419 6.31436L14.8516 6.35853L14.8569 6.40881L14.8557 6.46561L14.8573 6.42864C14.8573 6.4887 14.845 6.5459 14.8227 6.59784L14.8062 6.6319L14.783 6.66996L14.7529 6.7091L8.34299 14.117C8.28579 14.1938 8.20745 14.2445 8.12237 14.2688L8.08922 14.2769L8.03357 14.2846L8.00008 14.2858L7.94259 14.2819L7.89397 14.2727L7.83494 14.2533L7.82025 14.2464C7.76865 14.2236 7.72122 14.1896 7.68157 14.1449L1.2406 6.70081L1.20511 6.65076L1.17773 6.59756L1.15791 6.54081L1.14469 6.4659L1.14453 6.3931L1.15302 6.3367L1.1585 6.3143L1.17787 6.25938L1.1935 6.22698L3.47921 1.94125C3.54438 1.81905 3.66385 1.73698 3.79873 1.71838L3.85736 1.71436H12.1431ZM10.2322 6.85721H5.76648L8.00077 12.6629L10.2322 6.85721ZM4.84879 6.85721H2.50822L6.72134 11.7246L4.84879 6.85721ZM13.4905 6.85721H11.1516L9.28134 11.7206L13.4905 6.85721ZM5.72819 2.57093H4.11393L2.28479 6.00007H4.81336L5.72819 2.57093ZM9.38477 2.57093H6.61505L5.70022 6.00007H10.2991L9.38477 2.57093ZM11.8859 2.57093H10.2716L11.1865 6.00007H13.7139L11.8859 2.57093Z"
            fill="white"
          />
        </svg>
      </div>
      <div class="premiumAlert__titleWrapper">
        <h4 class="premiumAlert__title">Premium article</h4>
      </div>
      <p class="premiumAlert__description">
        This article is available to premium members only. If you are a premium
        member already, you can Log in to view the content. If not, you can
        become a premium user today by registering.
      </p>
      <div class="premiumAlert__buttons">
        <button
          v-if="!user.isLoggedIn"
          @click="modal.openLoginModal"
          class="premiumAlert__button premiumAlert__button-orange"
        >
          Log In
        </button>

        <button
          v-if="!user.isLoggedIn"
          @click="modal.openRegisterModal"
          class="premiumAlert__button premiumAlert__button-black"
        >
          Register
        </button>
        <button
          v-if="!user.user.is_subscriber && user.isLoggedIn"
          @click="modal.openSubscriptionModal"
          class="premiumAlert__button premiumAlert__button-black"
        >
          Go Premium
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.premiumAlert__wrapper {
  display: flex;
  justify-content: center;
  margin-top: 60px;
}
.premiumAlert {
  position: relative;
  border: 1px solid #495057;
  background: #f8f9fa;
  width: 450px;
  height: 171px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.premiumAlert__imageWrapper {
  position: absolute;
  top: -48px;
  left: 50%;
  transform: translateX(-50%);
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: #d4a373;
}
.premiumAlert__image {
  position: absolute;
  top: 5px;
  left: 50%;
  transform: translateX(-50%);
}
.premiumAlert__titleWrapper {
  position: absolute;
  top: -19px;
  left: 50%;
  transform: translateX(-50%);
  width: 164px;
  height: 34px;
  background: #f8f9fa;
  display: flex;
  justify-content: center;
  align-items: center;
}
.premiumAlert__title {
  @include text(18px, 700, #495057);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.premiumAlert__description {
  @include text(14px, 400, #495057);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  width: 392px;
  text-align: center;
}
.premiumAlert__buttons {
  position: absolute;
  bottom: -25px;
  display: flex;
  gap: 45px;
}
.premiumAlert__button {
  width: 126px;
  height: 42px;
  @include text(12px, 700);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  cursor: pointer;
  border: none;
  outline: none;
  transition: transform 0.2s ease-in-out;
  &:hover {
    transform: translateY(-3px);
  }
}
.premiumAlert__button-orange {
  background: #d4a373;
}
.premiumAlert__button-black {
  background: #495057;
}
</style>
