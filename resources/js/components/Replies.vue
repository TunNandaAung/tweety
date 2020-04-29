<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" :tweet="tweet" :last="index === last">
                <div class="ml-6 -mb-4" v-if="reply.children">
                    <!-- {{-- @include('replies.list',['collection' => reply.children]) --}} -->
                    <div
                        v-for="(children, index) in reply.children"
                        :key="children.id"
                    >
                        <reply
                            :reply="children"
                            :tweet="tweet"
                            :last="
                                index === Object.keys(reply.children).length - 1
                            "
                        >
                        </reply>
                    </div>
                </div>
            </reply>
        </div>
    </div>
</template>

<script>
import Reply from "./Reply";
import collection from "../mixins/collection";

export default {
    props: ["tweet"],
    name: "replies",
    components: { Reply },
    mixins: [collection],

    created() {
        this.fetch();
    },
    computed: {
        last() {
            return Object.keys(this.items).length - 1;
        }
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
            this.items = data.data;

            window.scrollTo(0, 0);
        }
    }
};
</script>
