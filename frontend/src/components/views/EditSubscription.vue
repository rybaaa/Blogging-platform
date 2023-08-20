<script setup>
import ProfileHeader from '@/components/profile/ProfileHeader.vue'
import SubscriptionForm from '@/components/profile/SubscriptionForm.vue'
</script>

<template>
  <div class="editProfile__container">
    <ProfileHeader />
    <SubscriptionForm />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
</style>
