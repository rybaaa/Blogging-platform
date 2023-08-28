<script setup>
const props = defineProps({
  plan: String,
})
const emit = defineEmits(['toggle'])
</script>
<template>
  <div class="subscriptionPlanToggle__wrapper">
    <div class="subscriptionPlanToggle__plan">
      <button
        class="subscriptionPlanToggle__plan-button"
        :class="{
          'subscriptionPlanToggle__plan-currentButton':
            props.plan === 'Monthly',
        }"
        @click="emit('toggle', 'Monthly')"
      >
        Monthly
      </button>
      <button
        class="subscriptionPlanToggle__plan-button"
        :class="{
          'subscriptionPlanToggle__plan-currentButton': props.plan === 'Yearly',
        }"
        @click="emit('toggle', 'Yearly')"
      >
        Yearly
      </button>
      <div
        v-if="props.plan === 'Monthly'"
        class="subscriptionPlanToggle__prices"
      >
        <div class="subscriptionPlanToggle__period">
          <span class="subscriptionPlanToggle__period-digits">20€ </span>
          <span class="subscriptionPlanToggle__period-letters">per month</span>
        </div>
        <div class="subscriptionPlanToggle__period">
          <span class="subscriptionPlanToggle__period-letters">Total: </span>
          <span class="subscriptionPlanToggle__period-digits">20€</span>
        </div>
      </div>
      <div v-else class="subscriptionPlanToggle__prices">
        <div class="subscriptionPlanToggle__period">
          <span class="subscriptionPlanToggle__period-digits">15€ </span>
          <span class="subscriptionPlanToggle__period-letters">per month</span>
        </div>
        <div class="subscriptionPlanToggle__period">
          <span class="subscriptionPlanToggle__period-letters">Total: </span>
          <span class="subscriptionPlanToggle__period-digits">180€</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.subscriptionPlanToggle__wrapper {
  width: 100%;
}
.subscriptionPlanToggle__plan-button {
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
.subscriptionPlanToggle__plan-currentButton {
  background: #d4a373;
  color: #fff;
}
.subscriptionPlanToggle__prices {
  margin: 20px 0 20px;
  display: flex;
  justify-content: space-between;
}
.subscriptionPlanToggle__period-digits {
  @include text(16px, 700, $textColor4);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
.subscriptionPlanToggle__period-letters {
  @include text(13px, 700, #888);
  font-family: $secondaryFontFamily;
  line-height: 25px;
}
</style>
