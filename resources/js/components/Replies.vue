<template>
  <div>
    <div v-if="items.length > 0">
      <div v-for="(reply, index) in items" :key="reply.id" ref="replies">
        <reply
          :reply="reply"
          :tweet="tweet"
          :last="index === last"
          :ref="'reply-'+reply.id"
          :childrenCount="items[index].children_count"
        >
          <div class="ml-6 -mb-4" v-if="reply.children">
            <div v-for="(children, index) in reply.children" :key="children.id">
              <reply
                :reply="children"
                :tweet="tweet"
                :last="
                                index === Object.keys(reply.children).length - 1
                            "
              ></reply>
            </div>
            <!-- <replies :tweet="tweet" :replies="reply.children"></replies> -->
          </div>
        </reply>
      </div>

      <load-more :container="container" @ready="loadMore" v-if="shouldPaginate"></load-more>
    </div>
    <!-- <span class="px-2 py-8" v-else>No comments yet!</span> -->

    <add-reply-modal @created="add"></add-reply-modal>
  </div>
</template>

<script>
import Reply from "./Reply";
import collection from "../mixins/collection";
import LoadMore from "../utils/LoadMore";
import AddReplyModal from "../utils/AddReplyModal";
import { mapState } from "vuex";

export default {
  props: ["tweet", "replies"],
  name: "replies",
  components: { Reply, LoadMore, AddReplyModal },
  mixins: [collection],

  data() {
    return {
      page: 1,
      last_page: false,
      dataSet: [],
      childrenReplies: [],
      container: this.$refs["replies"]
    };
  },
  watch: {
    dataSet() {
      this.page = this.dataSet.current_page;
      this.last_page = this.dataSet.last_page;
    },
    page() {
      this.fetch(this.page);
    }
  },
  created() {
    if (this.replies) {
      this.replies.map(item => this.items.push(item));
    } else this.fetch();

    // console.log(JSON.stringify(this.items));
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
      axios.get(this.url(page)).then(this.refresh);
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
    },
    loadMore() {
      if (this.shouldPaginate) {
        this.page++;
      }
    }
  }
};
</script>
