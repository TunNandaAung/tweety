<template>
  <button
    class="focus:outline-none text-center hover:text-green-600 hover:bg-green-200 p-2 rounded-lg text-gray-600 flex items-center"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
      <path
        fill="currentColor"
        d="M18,6v7c0,1.1-0.9,2-2,2h-4v3l-4-3H4c-1.101,0-2-0.9-2-2V6c0-1.1,0.899-2,2-2h12C17.1,4,18,4.9,18,6z"
      />
    </svg>
    <span class="text-xs">{{ this.repliesCount }}</span>
  </button>
</template>

<script>
import { mapState } from "vuex";

export default {
  props: ["count"],
  created() {
    this.$store.dispatch("fetchRepliesCount", this.count);
  },
  computed: {
    ...mapState(["repliesCount"])
  }
};
</script>
