<script setup>
import { userStore } from '@/stores/user'
import { ref } from 'vue'
import myUpload from 'vue-image-crop-upload'

defineProps({
  type: String,
})

let isUploadFormOpened = ref(false)
let headers = ref({
  Authorization: `Bearer ${localStorage.getItem('token')}`,
})
const cropSuccess = (imageUrl) => {
  user.changeAvatar(imageUrl)
}
const uploadUrl = ref(`${import.meta.env.VITE_API_URL}upload-avatar`)

const user = userStore()
</script>

<template>
  <div class="profileHeader__container">
    <section class="profileHeader">
      <div class="profileHeader__avatarWrapper">
        <img
          :src="
            user.user.avatar === null ? user.defaultAvatar : user.user.avatar
          "
          alt="avatar"
          class="profileHeader__avatar"
          @click="isUploadFormOpened = !isUploadFormOpened"
        />
        <my-upload
          v-model="isUploadFormOpened"
          field="avatar"
          :width="300"
          :height="300"
          lang-type="'en'"
          :url="uploadUrl"
          :headers="headers"
          @crop-success="cropSuccess"
        ></my-upload>
      </div>
      <h2 class="profileHeader__name">{{ user.user.name }}</h2>
      <h4 class="profileHeader__email">
        {{ user.user.email }}
      </h4>
      <span class="profileHeader__divider"></span>
      <RouterLink
        v-if="type === 'profile'"
        class="profileHeader__link"
        :to="{ name: 'edit profile' }"
        ><span class="profileHeader__edit">Edit profile</span>
      </RouterLink>
      <RouterLink v-else class="profileHeader__link" :to="{ name: 'profile' }">
        <span class="profileHeader__edit">Back to profile</span>
      </RouterLink>
      <RouterLink
        class="profileHeader__link"
        :to="{ name: 'edit subscription' }"
      >
        <span class="profileHeader__subscription">Manage subscription</span>
      </RouterLink>
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
  cursor: pointer;
  background: linear-gradient(white, white) padding-box,
    linear-gradient(to right, rgb(230, 226, 29), rgb(231, 39, 5)) border-box;
  border: 4px solid transparent;
  padding: 3px;
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
.profileHeader__link {
  text-decoration: none;
}
</style>
