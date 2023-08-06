<script setup>
import ProfileHeader from '../profile/ProfileHeader.vue'
import ProfileInfo from '../profile/ProfileInfo.vue'
</script>

<template>
  <div class="editProfile__container">
    <ProfileHeader />
    <ProfileInfo />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
</style>
