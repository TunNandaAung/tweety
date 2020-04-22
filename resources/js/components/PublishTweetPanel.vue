<template>
  <div class="border border-blue-400 rounded-lg py-6 px-8 mb-8">
    <form @submit.prevent="submit" @keydown="form.submitted=false">
      <textarea
        name="body"
        class="w-full focus:outline-none focus:placeholder-gray-700"
        placeholder="What's up doc?"
        autofocus
        ref="tweet"
        v-model="form.body"
        @keydown="delete form.errors.body"
      ></textarea>

      <span class="text-xs text-red-600" v-text="form.errors.body[0]" v-if="form.errors.body"></span>

      <hr class="mb-4" />

      <footer class="flex items-center justify-between">
        <img :src="avatar" alt="Your Avatar" class="rounded-full mr-2" width="50" height="50" />

        <div class="flex items-center">
          <div class="mr-6">
            <svg viewBox="0 0 36 36" class="circular-chart h-8 w-8" v-if="!limitExceed">
              <path
                class="circle-bg"
                d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
              />
              <path
                fill="currentColor"
                class="circle"
                :stroke="limitExceed ? '#E53E3E' : '#4299e1'"
                :stroke-dasharray="characterLeft+' 100'"
                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
              />
            </svg>
            <span v-else class="text-sm text-red-600">{{characterLeft}}</span>
          </div>

          <button
            type="submit"
            class="bg-blue-500 rounded-full shadow text-sm px-10 text-white hover:bg-blue-600 h-10 focus:outline-none"
          >Publish</button>
        </div>
      </footer>
    </form>
  </div>
</template>

<script>
import TweetyForm from "./TweetyForm";

export default {
  props: ["user"],
  data() {
    return {
      form: new TweetyForm({
        body: ""
      }),
      limit: 280,
      avatar: this.user.avatar
    };
  },
  computed: {
    characterLeft() {
      return (
        (this.limit - this.form.body.length) *
        (100 / this.limit)
      ).toFixed(0);
    },
    limitExceed() {
      return this.form.body.length > this.limit;
    }
  },
  methods: {
    autosize() {
      let textarea = this.$refs["tweet"];
      setTimeout(() => {
        textarea.style.cssText = "height:auto; padding:0";
        textarea.style.cssText = "height:" + textarea.scrollHeight + "px";
      }, 0);
    },
    async submit() {
      this.form.submit("/tweets").then(response => {
        location = response.data.message;
      });
    }
  }
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