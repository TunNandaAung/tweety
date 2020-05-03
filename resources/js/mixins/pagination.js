export default {
    data() {
        return {
            dataSet: [],
            page: 1,
            last_page: false
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
    methods: {
        loadMore() {
            if (this.shouldPaginate) {
                this.page++;
            }
        }
    }
};
