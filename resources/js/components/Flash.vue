<template>
  <transition name="slide-fade" mode="out-in">
    <div
      :class="classes"
      style="right: 25px; bottom: 25px"
      role="alert"
      v-show="show"
      v-text="body"
      class="rounded-xl"
    ></div>
  </transition>
</template>

<script>
export default {
  props: ["message"],

  data() {
    return {
      body: this.message,
      level: "success",
      show: false,
    };
  },

  computed: {
    classes() {
      let defaults = ["fixed", "p-4", "border", "text-white"];

      if (this.level === "success")
        defaults.push("bg-green-500", "border-green-600");
      if (this.level === "warning")
        defaults.push("bg-yellow-500", "border-yellow-600");
      if (this.level === "danger")
        defaults.push("bg-red-500", "border-red-600");

      return defaults;
    },
  },

  created() {
    if (this.message) {
      this.flash();
    }

    window.events.$on("flash", (data) => this.flash(data));
  },

  methods: {
    flash(data) {
      if (data) {
        this.body = data.message;
        this.level = data.level;
      }

      this.show = true;

      this.hide();
    },

    hide() {
      setTimeout(() => {
        this.show = false;
      }, 3000);
    },
  },
};
</script>
<style scoped>
.slide-fade-enter {
  transform: translateX(10px);
  opacity: 0;
}

.slide-fade-leave-to {
  transform: translateX(-10px);
  opacity: 0;
}

.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.2s ease;
}
</style>