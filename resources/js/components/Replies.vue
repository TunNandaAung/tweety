<script>
import Reply from "./Reply";

export default {
    name: "replies",
    props: ["replies", "tweet"],
    components: { Reply },
    computed: {
        last() {
            return Object.keys(this.replies).length - 1;
        }
    }
};
</script>
