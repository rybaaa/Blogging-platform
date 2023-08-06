<script setup>
import { RouterLink } from 'vue-router'
import { appStore } from '../../stores/app'
import { userStore } from '../../stores/user'

const app = appStore()
const user = userStore()
</script>

<template>
  <header class="header">
    <div class="header__container">
      <h1 class="header__title">RUNO</h1>
      <nav class="header__nav">
        <ul class="header__nav-list">
          <li class="header__nav-item">
            <RouterLink class="header__nav-itemLink" :to="{ name: 'home' }"
              >Home</RouterLink
            >
          </li>
          <li class="header__nav-item">
            <RouterLink class="header__nav-itemLink" :to="{ name: 'articles' }"
              >Articles</RouterLink
            >
          </li>
          <li v-if="!user.isLoggedIn" class="header__nav-item">
            <a class="header__nav-itemLink" @click="app.openRegisterModal"
              >Register</a
            >
          </li>
          <li v-if="!user.isLoggedIn" class="header__nav-item">
            <a class="header__nav-itemLink" @click="app.openLoginModal"
              >Sign in</a
            >
          </li>
          <li v-if="user.isLoggedIn" class="header__nav-item">
            <RouterLink class="header__nav-itemLink" :to="{ name: 'profile' }"
              >Profile</RouterLink
            >
          </li>
          <li v-if="user.isLoggedIn" class="header__nav-item">
            <a class="header__nav-itemLink" @click.prevent="user.logout"
              >Logout</a
            >
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';

.header {
  display: flex;
  justify-content: center;
  background: rgba(0, 0, 0, 0.2);
  position: fixed;
  width: 100%;
  z-index: 20;
}

.header__container {
  height: 80px;
  @include containerWidth();
  display: flex;
  justify-content: space-between;
  align-items: center;

  @include for-destkop-down {
    padding: 0 15px;
  }
}

.header__title {
  @include text(20px, 700);
  font-family: 'Spartan', sans-serif;
  color: #f8f9fa;
}

.header__nav-list {
  display: flex;
  gap: 25px;
  list-style: none;
}

.header__nav-item {
  padding: 6px;
  list-style: none;
  cursor: pointer;
  border-bottom: 2px solid transparent;
  &:hover {
    border-bottom: 2px solid #d4a373;
  }
}

.header__nav-itemLink {
  text-decoration: none;
  @include text(12px, 700);
}
</style>
