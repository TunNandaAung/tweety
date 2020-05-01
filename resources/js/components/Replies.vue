<template>
  <div>
    <div v-if="items.length > 0">
      <div v-for="(reply, index) in items" :key="reply.id" ref="replies">
        <reply :reply="reply" :tweet="tweet" :last="index === last">
          <div class="ml-6 -mb-4" v-if="reply.children">
            <!-- {{-- @include('replies.list',['collection' => reply.children]) --}} -->
            <div v-for="(children, index) in reply.children" :key="children.id">
              <reply
                :reply="children"
                :tweet="tweet"
                :last="
                                index === Object.keys(reply.children).length - 1
                            "
              ></reply>
            </div>
          </div>
        </reply>
      </div>

      <load-more :container="container" @ready="loadMore" v-if="shouldPaginate"></load-more>
    </div>
    <span class="px-2 py-8" v-else>No comments yet!</span>
  </div>
</template>

<script>
import Reply from "./Reply";
import collection from "../mixins/collection";
import LoadMore from "../utils/LoadMore";

export default {
  props: ["tweet"],
  name: "replies",
  components: { Reply, LoadMore },
  mixins: [collection],

  data() {
    return {
      page: 1,
      last_page: false,
      prevUrl: false,
      nextUrl: false,
      dataSet: [],
      container: this.$refs["replies"]
    };
  },
  watch: {
    dataSet() {
      this.page = this.dataSet.current_page;
      this.prevUrl = this.dataSet.prev_page_url;
      this.nextUrl = this.dataSet.next_page_url;
      this.last_page = this.dataSet.last_page;
    },
    page() {
      this.fetch(this.page);
    }
  },
  created() {
    this.fetch();
  },
  computed: {
    last() {
      return Object.keys(this.items).length - 1;
    },
    shouldPaginate() {
      return this.page <= this.last_page - 1;
    }
  },

  methods: {
    broadcast() {
      return this.$emit("changed", this.page);
    },

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
      this.items.length == 0
        ? (this.items = data.data)
        : data.data.map(item => this.items.push(item));
    },
    loadMore() {
      if (this.shouldPaginate) {
        this.page++;
      }
    }
  }
};
</script>
