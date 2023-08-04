<script setup></script>

<template>
  <div class="profileSubscription__wrapper">
    <section class="profileSubscription">
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
</style>
