<template>
  <div class="overflow-hidden relative w-64 mt-4 mb-">
    <button
      class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
    >Choose File</button>
    <input
      class="cursor-pointer opacity-0 absolute block right-0 top-0"
      type="file"
      name="banner"
      accept="image/*"
      @change="onChange"
    />
  </div>
</template>

<script>
export default {
  methods: {
    onChange(e) {
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
