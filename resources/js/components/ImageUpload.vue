<template>
  <div class="overflow-hidden relative mb-">
    <slot>
      <button
        type="button"
        class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
      >Choose File</button>
    </slot>
    <input
      class="cursor-pointer opacity-0 absolute block right-0 top-0"
      type="file"
      ref="input"
      :name="name"
      accept="image/*"
      @change="onChange"
      v-if="!clearInput"
    />
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String
    },
    clear: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      clearInput: this.clear
    };
  },
  watch: {
    clear(clear) {
      if (clear) {
        this.clearInput = clear;
        this.$nextTick(() => {
          this.clearInput = false;
        });
      }
    }
  },
  methods: {
    onChange(e) {
      if (e == null) {
        this.$emit("loaded", {});
        return;
      }
      if (!e.target.files.length) return;

      let file = e.target.files[0];

      let reader = new FileReader();

      reader.readAsDataURL(file);

      reader.onload = e => {
        let src = e.target.result;

        this.$emit("loaded", { src, file });
      };
    }
  }
};
</script>
