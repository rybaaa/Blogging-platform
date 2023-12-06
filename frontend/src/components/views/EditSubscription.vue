<script setup>
import ProfileHeader from '@/components/profile/ProfileHeader.vue'
import SubscriptionForm from '@/components/profile/SubscriptionForm.vue'
import { userStore } from '@/stores/user'

const user = userStore()

await user.fetchUserSubscriptions()
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
