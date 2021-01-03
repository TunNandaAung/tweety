<template>
  <div class="border border-blue-400 rounded-xl py-6 px-8 mb-8">
    <form
      @submit.prevent="submit"
      method="POST"
      @keydown="submitted = false"
      enctype="multipart/form-data"
    >
      <vue-tribute :options="tributeOptions">
        <textarea
          name="body"
          id="body"
          class="w-full focus:outline-none focus:placeholder-gray-700"
          placeholder="What's up doc?"
          autofocus
          ref="tweet"
          v-model="body"
          @keydown="delete errors.body"
        ></textarea>
      </vue-tribute>
      <span
        class="text-xs text-red-600"
        v-text="errors.body[0]"
        v-if="errors.body"
      ></span>

      <hr class="mb-4" />

      <div class="rounded-full relative" v-if="imageSrc">
        <img
          :src="imageSrc"
          class="rounded-xl mb-1 h-56 w-full object-cover"
          alt="tweet-image"
        />
        <button
          type="button"
          class="absolute text-white text-right px-4 py-1 bg-black rounded-full"
          style="left: 88%; top: 5%"
          @click="clearImage"
        >
          Clear
        </button>
      </div>

      <span
        class="text-xs text-red-600"
        v-text="errors.image[0]"
        v-if="errors.image"
      ></span>

      <footer class="flex items-center justify-between">
        <img
          :src="avatar"
          alt="Your Avatar"
          class="rounded-full mr-2"
          width="50"
          height="50"
        />

        <div class="flex items-center">
          <div class="mr-6">
            <image-upload :name="'image'" :clear="clear" @loaded="onLoad">
              <slot>
                <button
                  type="button"
                  class="bg-blue-300 focus:outline-none text-white font-bold py-2 px-2 rounded-full"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    class="h-6 w-6 text-blue-500"
                  >
                    <path
                      fill="currentColor"
                      d="M19 2H1a1 1 0 00-1 1v14a1 1 0 001 1h18a1 1 0 001-1V3a1 1 0 00-1-1zm-1 14H2V4h16v12zm-3.685-5.123l-3.231 1.605-3.77-6.101L4 14h12l-1.685-3.123zM13.25 9a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z"
                    />
                  </svg>
                </button>
              </slot>
            </image-upload>
          </div>

          <character-limit-indicator :body="body"></character-limit-indicator>

          <button
            type="submit"
            class="bg-blue-500 rounded-full shadow font-bold text-sm px-10 text-white hover:bg-blue-600 h-10 focus:outline-none"
          >
            Publish
          </button>
        </div>
      </footer>
    </form>
  </div>
</template>

<script>
import TweetyForm from "./TweetyForm";
import ImageUpload from "./ImageUpload";
import VueTribute from "vue-tribute";
import Tribute from "tributejs";
import CharacterLimitIndicator from "./CharacterLimitIndicator";

export default {
  props: ["user"],
  components: {
    ImageUpload,
    VueTribute,
    CharacterLimitIndicator,
  },
  data() {
    return {
      body: "",
      image: null,
      imageSrc: "",
      avatar: this.user.avatar,
      clear: false,
      errors: {},
      tributeOptions: new Tribute({
        values: function (text, cb) {
          axios
            .get("/api/search-friends", {
              params: { username: text },
            })
            .then((response) => cb(response.data));
        },
        lookup: "username",
        selectTemplate: function (item) {
          if (typeof item === "undefined") return null;

          return "@" + item.original.username;
        },
        noMatchTemplate: function () {
          return '<span style:"visibility: hidden;"></span>';
        },
      }),
    };
  },
  methods: {
    autosize() {
      let textarea = this.$refs["tweet"];
      setTimeout(() => {
        textarea.style.cssText = "height:auto; padding:0";
        textarea.style.cssText = "height:" + textarea.scrollHeight + "px";
      }, 0);
    },
    onLoad(image) {
      this.imageSrc = image.src;
      this.image = image.file;
    },
    clearImage() {
      this.imageSrc = "";
      this.image = null;
      this.clear = true;
    },
    submit() {
      let data = this.createFormData();

      axios
        .post("/tweets", data)
        .then((response) => {
          location = response.data.message;
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        });
    },
    createFormData() {
      let data = new FormData();

      data.append("body", this.body);
      if (this.image !== null) {
        data.append("image", this.image);
      }
      return data;
    },
  },
};
</script>

