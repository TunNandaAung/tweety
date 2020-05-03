<template>
  <div class="loader"></div>
</template>
<script>
import { throttle } from "lodash";

export default {
  props: {
    container: {}
  },

  mounted() {
    window.addEventListener("scroll", this.loadMore);
  },

  methods: {
    loadMore: throttle(function(e) {
      if (this.shouldLoadMore()) {
        this.$emit("ready");
      }
    }, 300),

    shouldLoadMore() {
      let bottomOfWindow =
        window.pageYOffset >=
        document.documentElement.offsetTop + window.innerHeight;

      return bottomOfWindow;
    }
  }
};
</script>
