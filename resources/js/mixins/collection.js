export default {
    data() {
        return {
            items: []
        };
    },

    methods: {
        add(item) {
            if (item.parent_id != null) {
                let parent_id = item.parent_id;

                let parent = this.items.findIndex(data => data.id == parent_id);

                this.items[parent].children.push(item);
                this.items[parent].children_count += 1;
            } else this.items.push(item);

            this.$emit("added");

            this.$store.dispatch("addReply");
        },

        remove(index) {
            this.items.splice(index, 1);

            this.$emit("removed");
        }
    }
};
