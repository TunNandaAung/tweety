<template>
  <modal
    :name="'add-reply-' + id"
    classes="p-4 bg-white shadow-lg rounded-xl w-64"
    height="auto"
    @before-open="beforeOpen"
  >
    <div class="flex justify-end">
      <button
        @click.prevent="$modal.hide(`add-reply-${id}`)"
        class="focus:outline-none bg-transparent p-1 hover:bg-blue-300 text-center rounded-full"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 text-blue-500 hover:text-blue-600"
        >
          <path
            fill="currentColor"
            d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
	            c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
	            l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
	            C14.817,13.62,14.817,14.38,14.348,14.849z"
          />
        </svg>
      </button>
    </div>

    <div class="mb-4 ml-4">
      <div class="flex">
        <div class="mr-2 flex-shrink-0">
          <img
            :src="owner.avatar"
            alt
            class="rounded-full mr-2"
            width="50"
            height="50"
          />
        </div>

        <div class="flex-1">
          <h5 class="font-bold mb-4">{{ owner.name }}</h5>
          <div class="mb-4">
            <p v-html="parentBody"></p>
          </div>
        </div>
      </div>

      <p class="text-gray-600 bg-white">
        Replying to
        <span class="text-blue-500">{{ "@" + owner.username }}</span>
      </p>
    </div>

    <form
      class="p-4"
      @submit.prevent="submit"
      method="POST"
      @keydown="submitted = false"
      enctype="multipart/form-data"
    >
      <input name="parent_id" type="hidden" :value="parentID" v-if="parentID" />
      <vue-tribute :options="tributeOptions">
        <textarea
          name="body"
          id="body"
          class="w-full focus:outline-none placeholder-blue-800 focus:placeholder-black bg-white mb-4"
          placeholder="Add a reply..."
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

      <!-- <hr class="mb-4" />

          <div class="rounded-full relative" v-if="imageSrc">
            <img :src="imageSrc" class="rounded-xl mb-1 h-56 w-full object-cover" alt="tweet-image" />
            <button
              type="button"
              class="absolute text-white text-right px-4 py-1 bg-black rounded-full"
              style="left:88%;top:5%"
              @click="clearImage"
            >Clear</button>
          </div>

      <span class="text-xs text-red-600" v-text="errors.image[0]" v-if="errors.image"></span>-->

      <footer class="flex items-center justify-between">
        <img
          :src="avatar"
          alt="Your Avatar"
          class="rounded-full mr-2"
          width="50"
          height="50"
        />

        <div class="flex items-center">
          <!-- <div class="mr-6">
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
          </div>-->

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
  </modal>
</template>

<script>
import VueTribute from "vue-tribute";
import Tribute from "tributejs";
import CharacterLimitIndicator from "../components/CharacterLimitIndicator";

export default {
  components: { VueTribute, CharacterLimitIndicator },
  props: ["id"],
  data() {
    return {
      body: "",
      tweetID: "",
      avatar: window.App.user.avatar,
      parentID: null,
      parentBody: "",
      owner: "",
      isRoot: false,
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
  computed: {
    replyingTo() {
      return this.owner.username === window.App.user.username || this.isRoot
        ? ""
        : "@" + this.owner.username + " ";
    },
  },
  methods: {
    beforeOpen(event) {
      this.tweetID = event.params.tweetID;
      this.parentID = event.params.parentID;
      this.parentBody = event.params.parentBody;
      this.owner = event.params.owner;
      this.isRoot = event.params.isRoot;
    },
    submit() {
      let data = this.createFormData();

      axios
        .post(`/tweets/${this.tweetID}/reply`, data)
        .then(({ data }) => {
          this.body = "";
          this.$modal.hide(`add-reply-${this.id}`);

          flash("Your reply has been posted");
          this.$emit("created", data);
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        });
    },
    createFormData() {
      let data = new FormData();

      data.append("body", this.replyingTo + this.body);
      if (this.image !== null) {
        data.append("image", this.image);
      }

      if (this.parentID !== null) {
        data.append("parent_id", this.parentID);
      }

      return data;
    },
  },
};
</script>

<style scoped>
.circular-chart {
  display: block;
  margin: 10px auto;
}

.circle {
  fill: none;
  stroke-width: 4;
  stroke-linecap: round;
  animation: progress 1s ease-out forwards;
}
.circle-bg {
  fill: none;
  stroke: #e2e8f0;
  stroke-width: 5;
}

@keyframes progress {
  0% {
    stroke-dasharray: 0 100;
  }
}
.percentage {
  fill: #666;
  text-anchor: middle;
}
</style>
