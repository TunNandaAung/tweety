<template>
  <div>
    <slot></slot>
  </div>
</template>

<script>
import { throttle } from "lodash";

export default {
  mounted() {
    let el = this.$el;
    let originalOffsetTop = this.$el;

    window.addEventListener(
      "scroll",
      throttle(function() {
        console.log(window.scrollY >= originalOffsetTop);
        el.classList[window.scrollY >= originalOffsetTop ? "add" : "remove"](
          "is-fixed-to-top"
        );
      }, 300)
    );
  }
};
</script>