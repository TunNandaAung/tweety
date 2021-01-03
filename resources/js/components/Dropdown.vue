<template>
  <on-click-outside :do="close">
    <div class="dropdown relative">
      <div
        class="dropdown-toggle"
        @click.prevent="isOpen = !isOpen"
        aria-haspopup="true"
        :aria-expended="isOpen"
      >
        <slot name="trigger"></slot>
      </div>

      <transition name="pop-out-quick">
        <ul
          v-show="isOpen"
          class="bg-gray-200 absolute mt-2 -m-6 rounded-xlshadow-lg z-50"
        >
          <slot></slot>
        </ul>
      </transition>
    </div>
  </on-click-outside>
</template>

<script>
import OnClickOutside from "./OnClickOutside";

export default {
  components: { OnClickOutside },
  props: ["classes"],

  data() {
    return {
      isOpen: false,
    };
  },

  methods: {
    close() {
      this.isOpen = false;
    },
  },
};
</script>

<style>
.pop-out-quick-enter-active,
.pop-out-quick-leave-active {
  transition: all 0.4s;
}

.pop-out-quick-enter,
.pop-out-quick-leave-active {
  opacity: 0;
  transform: translateY(-7px);
}
</style>
