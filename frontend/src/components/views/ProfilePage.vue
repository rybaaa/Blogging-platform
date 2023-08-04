<script setup>
import ProfileHeader from '../profile/ProfileHeader.vue'
import ProfileSubscription from '../profile/ProfileSubscription.vue'
import ProfileArticles from '../profile/ProfileArticles.vue'
</script>

<template>
  <div class="profilePage__container">
    <ProfileHeader />
    <ProfileArticles />
    <ProfileSubscription />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.profilePage__container {
}
</style>
