<template>
  <div class="flex items-center">
    <!-- <form method="POST" action="/tweets/{{ $tweet->id }}/like"> -->
    <form @submit.prevent="like">
      <button
        type="submit"
        class="flex items-center mr-4 focus:outline-none hover:text-blue-500 hover:bg-blue-200 p-2 rounded-full"
        :class="
          isLiked
            ? 'text-blue-500 bg-blue-200 rounded-full p-2'
            : 'text-gray-600'
        "
      >
        <svg
          viewBox="0 0 20 20"
          class="mr-1 w-4 h-4"
          style="transform: scaleX(-1)"
        >
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g class="fill-current">
              <path
                d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"
                id="Fill-97"
              />
            </g>
          </g>
        </svg>

        <span class="text-xs">{{ likeCount }}</span>
      </button>
    </form>

    <form @submit.prevent="dislike">
      <button
        type="submit"
        class="flex items-center focus:outline-none hover:text-blue-500 hover:bg-blue-200 p-2 rounded-xl"
        :class="
          isDisliked
            ? 'text-blue-500 bg-blue-200 rounded-xl p-2'
            : 'text-gray-600'
        "
      >
        <svg viewBox="0 0 20 20" class="mr-1 w-4 h-4">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g class="fill-current">
              <path
                d="M11.0010436,20 C9.89589787,20 9.00000024,19.1132936 9.0000002,18.0018986 L9,12 L1.9973917,12 C0.894262725,12 0,11.1122704 0,10 L0,8 L2.29663334,1.87564456 C2.68509206,0.839754676 3.90195042,8.52651283e-14 5.00853025,8.52651283e-14 L12.9914698,8.52651283e-14 C14.1007504,8.52651283e-14 15,0.88743329 15,1.99961498 L15,10 L12,17 L12,20 L11.0010436,20 L11.0010436,20 Z M17,10 L20,10 L20,0 L17,0 L17,10 L17,10 Z"
                id="Fill-97"
              />
            </g>
          </g>
        </svg>

        <span class="text-xs">{{ dislikeCount }}</span>
      </button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    subject: {
      type: Object,
      required: true,
    },
    name: {
      type: String,
    },
  },
  data() {
    return {
      isLiked: this.subject.is_liked,
      isDisliked: this.subject.is_disliked,
      likeCount: this.subject.likes_count || 0,
      dislikeCount: this.subject.dislikes_count || 0,
      endpoint: `/${this.name}/${this.subject.id}/like`,
    };
  },
  methods: {
    like() {
      axios.post(this.endpoint).then(({ data }) => this.updateLikes(data));
    },
    dislike() {
      axios.delete(this.endpoint).then(({ data }) => this.updateDislikes(data));
    },

    updateLikes(data) {
      data == 1 ? this.likeCount-- : this.likeCount++;
      this.isLiked = !this.isLiked;
      this.isDisliked = false;

      this.dislikeCount > 0 ? this.dislikeCount-- : this.dislikeCount;
    },
    updateDislikes(data) {
      data == 1 ? this.dislikeCount-- : this.dislikeCount++;
      this.isDisliked = !this.isDisliked;
      this.isLiked = false;

      this.likeCount > 0 ? this.likeCount-- : this.likeCount;
    },
  },
};
</script>
