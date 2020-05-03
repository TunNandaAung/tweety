export default {
    data() {
        return {
            items: []
        };
    },

    methods: {
        add(item) {
            this.items.push(item);

            this.$emit("added");

            if (typeof this.replies_count !== "undefined") {
                this.replies_count += 1;
            }

            this.$store.dispatch("addReply");
        },

        remove(index, parentID = null, count) {
            console.log(count);
            this.items.splice(index, 1);
            this.$store.dispatch("removeReply", count);

            if (typeof this.replies_count !== "undefined") {
                this.replies_count -= 1;
            }
        }
    }
};
