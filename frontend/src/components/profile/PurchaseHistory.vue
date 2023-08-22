<script setup>
import { ref } from 'vue'
import { isBefore, format } from 'date-fns'
import { userStore } from '@/stores/user'

let purchasesList = ref([
  { id: 1646, start: '10.10.2022', end: '10.11.2023' },
  { id: 234, start: '10.09.2022', end: '10.10.2022' },
])
let isHistoryOpened = ref(false)
const toggle = () => {
  isHistoryOpened.value = !isHistoryOpened.value
}
const isEarlier = (date) => {
  console.log(format(new Date(date), 'dd,MM,yyyy'))
  return isBefore(new Date(), new Date(date))
}

const user = userStore()
</script>
<template>
  <div class="purchaseHistory__container">
    <div class="purchaseHistory__header">
      <h4 class="purchaseHistory__header-title">Purchase history</h4>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="9"
        height="9"
        viewBox="0 0 9 9"
        fill="none"
        @click="toggle"
        class="purchaseHistory__header-image"
      >
        <g clip-path="url(#clip0_2414_332)">
          <path
            d="M9 2.88966L4.49993 7.48218L-5.52184e-07 2.88966L1.40497 1.5176L4.49993 4.67618L7.59503 1.5176L9 2.88966Z"
            fill="#818181"
          />
        </g>
        <defs>
          <clipPath id="clip0_2414_332">
            <rect
              width="9"
              height="9"
              fill="white"
              transform="translate(9 9) rotate(-180)"
            />
          </clipPath>
        </defs>
      </svg>
    </div>
    <div class="purchaseHistory__tableHeader">
      <span class="purchaseHistory__tableHeader-title">Transaction id</span>
      <span class="purchaseHistory__tableHeader-title">Start</span>
      <span class="purchaseHistory__tableHeader-title">End</span>
      <span class="purchaseHistory__tableHeader-title">Status</span>
    </div>
    <ul v-if="isHistoryOpened" class="purchaseHistory__list">
      <li
        v-for="item in user.user.subscription_history"
        :key="item.id"
        class="purchaseHistory__list-item"
      >
        <div class="purchaseHistory__list-itemWrapper">
          <div class="purchaseHistory__divider"></div>
          <div class="purchaseHistory__list-wrapper">
            <span
              class="purchaseHistory__list-itemInfo purchaseHistory__list-itemId"
              >{{ item.id }}</span
            >
            <span class="purchaseHistory__list-itemInfo">{{
              item.start_date.slice(0, 10)
            }}</span>
            <span class="purchaseHistory__list-itemInfo">{{
              item.end_date.slice(0, 10)
            }}</span>
            <span
              class="purchaseHistory__list-itemInfo"
              :class="{
                'purchaseHistory__list-active': item.is_active,
              }"
              >{{ item.is_active ? 'Active' : 'Ended' }}
            </span>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.purchaseHistory__container {
  background: #efefef;
  width: 100%;
  padding: 20px;
  margin-top: 80px;
}
.purchaseHistory__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.purchaseHistory__header-title {
  @include text(16px, 700, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}

.purchaseHistory__header-image {
  cursor: pointer;
}
.purchaseHistory__tableHeader {
  display: flex;
  justify-content: space-between;
  margin-top: 23px;
}
.purchaseHistory__tableHeader-title {
  @include text(12px, 700, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.purchaseHistory__divider {
  border: 1px solid #d2d2d2;
  margin: 15px 0;
}
.purchaseHistory__list {
  display: flex;
  flex-direction: column;
  padding: 0;
}
.purchaseHistory__list-itemWrapper {
  display: flex;
  flex-direction: column;
  width: 100%;
}
.purchaseHistory__list-wrapper {
  display: flex;
  justify-content: space-between;
}
.purchaseHistory__list-item {
  @include unsetAll();
  display: flex;
  justify-content: space-between;
}
.purchaseHistory__list-itemInfo {
  @include text(12px, 400, #818181);
  font-family: $secondaryFontFamily;
  line-height: 25px;
  width: 25%;
  text-align: end;
}
.purchaseHistory__list-itemId {
  text-align: start;
}
.purchaseHistory__list-active {
  color: $textColor4;
}
</style>
