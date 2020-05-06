<template>
  <div>
    <span class="flex items-center justify-center" :class="loading ? 'loader' : ''"></span>

    <div class="border border-gray-300 rounded-lg" v-if="items.length > 0">
      <div v-for="(reply, index) in items" :key="reply.id" ref="replies">
        <reply
          :reply="reply"
          :tweet="tweet"
          :last="index === last"
          :ref="'reply-' + reply.id"
          :index="index"
          @removed="remove(index, null, reply.children_count + 1)"
        ></reply>
      </div>

      <load-more :container="container" @ready="loadMore" v-if="shouldPaginate"></load-more>
    </div>
    <span class="px-2 py-8" v-else v-show="!loading">No replies yet!</span>

    <div
      class="border border-gray-400 rounded-lg py-6 px-8 mt-8 focus:outline-none focus:border-blue-400 hover:border-blue-400"
      id="add-reply-field"
      @click.prevent="showModal"
    >
      <footer class="flex items-center py-6">
        <img
          :src="currentAvatar"
          alt="Your Avatar"
          class="rounded-full mr-10"
          width="50"
          height="50"
        />
        <h3 class="text-gray-600">Reply to tweet.</h3>
      </footer>
    </div>

    <portal to="add-reply">
      <transition name="slide-fade" mode="out-in">
        <button
          class="bg-blue-500 rounded-full p-2 z-10 is-floating focus:shadow-outline"
          id="add-reply-button"
          v-show="isVisible"
          @click.prevent="showModal"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-white">
            <path
              fill="currentColor"
              d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"
            />
          </svg>
        </button>
      </transition>
    </portal>
    <add-reply-modal @created="add" id="#"></add-reply-modal>
  </div>
</template>

<script>
import Reply from "./Reply";
import collection from "../mixins/collection";
import pagination from "../mixins/pagination";
import replyButtonVisibility from "../mixins/replyButtonVisibility";
import LoadMore from "../utils/LoadMore";
import AddReplyModal from "../utils/AddReplyModal";
import { mapState } from "vuex";

export default {
  props: ["tweet", "replies"],
  name: "replies",
  components: { Reply, LoadMore, AddReplyModal },
  mixins: [collection, pagination, replyButtonVisibility],

  data() {
    return {
      childrenReplies: [],
      container: this.$refs["replies"],
      loading: false,
      currentAvatar: window.App.user.avatar
    };
  },
  created() {
    if (this.replies) {
      this.replies.map(item => this.items.push(item));
    } else this.fetch();
  },
  computed: {
    last() {
      return Object.keys(this.items).length - 1;
    },
    shouldPaginate() {
      return this.page <= this.last_page - 1;
    },
    ...mapState(["allReplies"])
  },

  methods: {
    fetch(page) {
      this.loading = true;
      axios.get(this.url(page)).then(response => {
        this.refresh(response);
        this.loading = false;
      });
    },
    showModal() {
      this.$modal.show("add-reply-#", {
        tweetID: `${this.tweet.id}`,
        parentID: null,
        owner: this.tweet.user,
        parentBody: `${this.tweet.body}`,
        isRoot: true
      });
    },
    url(page) {
      if (!page) {
        let query = location.search.match(/page=(\d+)/);

        page = query ? query[1] : 1;
      }

      return `${location.pathname}/replies?page=${page}`;
    },

    refresh({ data }) {
      this.dataSet = data;
      data.data.map(item => this.items.push(item));
    }
  }
};
</script>

<style>
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
