<template>
  <div>
    <span class="flex items-center justify-center" :class="loading ? 'loader' : ''"></span>

    <div class="border border-gray-300 rounded-lg" v-if="items.length > 0">
      <div v-for="(reply, index) in items" :key="reply.id" ref="replies">
        <reply
          :reply="reply"
          :tweet="tweet"
          :last="index === last"
          :ref="'reply-'+reply.id"
          :index="index"
          @removed="remove(index,null,reply.children_count + 1)"
        ></reply>
      </div>

      <load-more :container="container" @ready="loadMore" v-if="shouldPaginate"></load-more>
    </div>
    <span class="px-2 py-8" v-else v-show="!loading">No comments yet!</span>
  </div>
</template>

<script>
import Reply from "./Reply";
import collection from "../mixins/collection";
import pagination from "../mixins/pagination";
import LoadMore from "../utils/LoadMore";
import AddReplyModal from "../utils/AddReplyModal";
import { mapState } from "vuex";

export default {
  props: ["tweet", "replies"],
  name: "replies",
  components: { Reply, LoadMore, AddReplyModal },
  mixins: [collection, pagination],

  data() {
    return {
      childrenReplies: [],
      container: this.$refs["replies"],
      loading: false
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
