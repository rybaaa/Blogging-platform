<script setup>
import ProfileHeader from '../profile/ProfileHeader.vue'
import ProfileSubscription from '../profile/ProfileSubscription.vue'
import ProfileArticles from '../profile/ProfileArticles.vue'
import PaginationComponent from '@/components/general/PaginationComponent.vue'
import { userStore } from '@/stores/user'

const user = userStore()

await user.fetchUserArticles(1, user.user.id)
await user.fetchUserSubscriptions()
</script>

<template>
  <div>
    <ProfileHeader type="profile" />
    <ProfileArticles />
    <PaginationComponent
      :items="user.user.articles.last_page"
      purpose="profile"
    />
    <ProfileSubscription />
  </div>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
</style>
