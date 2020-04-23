<template>
  <div>
    <div class="rounded-full">
      <img :src="avatar" width="50" height="50" class="mb-1" />
    </div>

    <image-upload name="avatar" class="mr-1 mt-4" @loaded="onLoad"></image-upload>
  </div>
</template>

<script>
import ImageUpload from "./ImageUpload";

export default {
  props: ["user"],

  components: { ImageUpload },

  data() {
    return {
      avatar: this.user.avatar
    };
  },

  methods: {
    onLoad(avatar) {
      this.avatar = avatar.src;
    }
  }
};
</script>
