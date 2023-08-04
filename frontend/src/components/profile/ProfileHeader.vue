<script setup></script>

<template>
  <div class="profileHeader__container">
    <section class="profileHeader">
      <div class="profileHeader__avatarWrapper">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/2048px-Mercedes-Logo.svg.png"
          alt="avatar"
          class="profileHeader__avatar"
        />
      </div>
      <h2 class="profileHeader__name">Name</h2>
      <h4 class="profileHeader__email">123@test.com</h4>
      <span class="profileHeader__divider"></span>
      <span class="profileHeader__edit">Edit profile</span>
      <span class="profileHeader__subscription">Manage subscription</span>
    </section>
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.profileHeader__container {
  background-color: #3e3e3e;
}
.profileHeader {
  min-height: 550px;
  display: flex;
  flex-direction: column;
  @include containerWidth();
  align-items: center;
  text-align: center;
  padding: 145px 0 35px;
}

.profileHeader__avatar {
  width: 129px;
  height: 129px;
  border-radius: 129px;
  box-shadow: 0px 10px 5px 0px rgba(10, 10, 10, 0.25);
}
.profileHeader__name {
  margin: 25px 0;
  @include text(36px, 700);
  font-family: $secondaryFontFamily;
  line-height: normal;
}
.profileHeader__email {
  @include text(12px, 700);
  font-family: $secondaryFontFamily;
  line-height: 20px;
}
.profileHeader__divider {
  width: 31px;
  border: 2px solid $textColor4;
  margin: 40px 0;
}
.profileHeader__edit {
  @include text(12px, 700, $textColor4);
  font-family: $secondaryFontFamily;
  line-height: 20px;
  cursor: pointer;
  padding: 5px;
  &:hover {
    border-radius: 10px;
    color: #fff;
    background-color: $textColor4;
  }
}
.profileHeader__subscription {
  @include text(12px, 700, $textColor4);
  font-family: $secondaryFontFamily;
  line-height: 20px;
  cursor: pointer;
  padding: 5px;
  &:hover {
    border-radius: 10px;
    color: #fff;
    background-color: $textColor4;
  }
}
</style>
