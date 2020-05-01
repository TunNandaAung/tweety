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
                console.log(JSON.stringify(this.items));
                this.items[parent].children.push(item);
            } else this.items.push(item);

            this.$emit("added");
        },

        remove(index) {
            this.items.splice(index, 1);

            this.$emit("removed");
        }
    }
};
