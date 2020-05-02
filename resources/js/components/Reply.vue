<template>
  <!-- <div class="p-4 {{ $loop->last ? '' : 'border-b border-gray-400'}}"> -->
  <div class="p-4" :class="last ? '' : 'border-b border-gray-400'" :id="'reply-' + id">
    <div class="flex">
      <div class="mr-2 flex-shrink-0">
        <a :href="'/profiles/' + reply.owner.username">
          <img :src="reply.owner.avatar" alt class="rounded-full mr-2" width="40" height="40" />
        </a>
      </div>

      <div class="flex-1">
        <div class="flex items-baseline mb-2">
          <a :href="'/profiles/' + reply.owner.username" class="mr-3">
            <h5 class="font-bold">{{ reply.owner.name }}</h5>
          </a>
          <span class="font-bold text-sm text-gray-600 mr-3">{{ "@" + reply.owner.username }}</span>

          <span class="text-sm text-gray-600">. {{ reply.created_at | diffForHumans }}</span>
        </div>

        <a class="text-sm mb-4" v-html="reply.body"></a>
        <!-- @if($reply->image !== null)
        <div class="mb-6">
          <img
            src="{{ asset($reply->image) }}"
            alt="tweet-image"
            class="rounded-lg mb-1 h-64 w-full object-cover"
          />
        </div>
        @endif-->
        <div class="flex items-center pt-2 -ml-2">
          <button
            class="focus:outline-none text-center hover:text-green-500 hover:bg-green-200 p-2 rounded-lg text-gray-600 flex items-center"
            @click.prevent="showModal"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
              <path
                fill="currentColor"
                d="M18,6v7c0,1.1-0.9,2-2,2h-4v3l-4-3H4c-1.101,0-2-0.9-2-2V6c0-1.1,0.899-2,2-2h12C17.1,4,18,4.9,18,6z"
              />
            </svg>
            <span class="text-xs" v-if="!reply.parent_id">{{ replies_count }}</span>
          </button>
        </div>
      </div>
    </div>

    <slot></slot>

    <div class="ml-6 -mb-4" v-if="items.length > 0">
      <div v-for="(child, index) in items" :key="child.id">
        <reply :reply="child" :tweet="tweet" :last="index === Object.keys(items).length - 1"></reply>
      </div>
    </div>

    <button
      @click="loadMore"
      v-show="shouldDisplyBtn"
      class="text-blue-500 text-xs hover:text-blue-600"
    >View Replies</button>

    <add-reply-modal @created="add" :key="reply.id" :id="reply.id"></add-reply-modal>
  </div>
</template>

<script>
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import LoadMore from "../utils/LoadMore";
import collection from "../mixins/collection";
import AddReplyModal from "../utils/AddReplyModal";

dayjs.extend(relativeTime);

export default {
  props: ["reply", "tweet", "last"],
  name: "reply",
  mixins: [collection],
  components: {
    AddReplyModal
  },
  created() {
    dayjs.extend(relativeTime);
  },
  data() {
    return {
      id: this.reply.id,
      showChildren: false,
      replies_count: this.reply.children_count,
      dataSet: [],
      page: 0,
      last_page: false
    };
  },
  filters: {
    diffForHumans: date => {
      if (!date) {
        return null;
      }

      return dayjs(date).fromNow();
    }
  },
  computed: {
    parentID() {
      return this.reply.parent_id === null
        ? this.reply.id
        : this.reply.parent_id;
    },
    isRoot() {
      return this.reply.parent_id === null;
    },
    shouldDisplyBtn() {
      return (
        this.items.length != this.reply.children_count &&
        this.reply.children_count > 0
      );
    },
    shouldPaginate() {
      return this.page === 0 || this.page <= this.last_page - 1;
    }
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

  methods: {
    showModal() {
      this.$modal.show(`add-reply-${this.reply.id}`, {
        tweetID: `${this.tweet.id}`,
        parentID: this.parentID,
        owner: this.reply.owner,
        parentBody: `${this.reply.body}`,
        isRoot: this.isRoot
      });
    },
    loadChildren({ data }) {
      this.dataSet = data;
      data.data.map(item => this.items.push(item));
      this.showChildren = true;
    },
    fetch(page) {
      axios.get(this.url(page)).then(this.loadChildren);
    },
    url(page) {
      if (!page) {
        let query = location.search.match(/page=(\d+)/);

        page = query ? query[1] : 1;
      }

      return `/api/replies/${this.reply.id}/children?page=${page}`;
    },
    loadMore() {
      if (this.shouldPaginate) {
        this.page++;
        console.log(this.page);
      }
    }
  }
};
</script>
