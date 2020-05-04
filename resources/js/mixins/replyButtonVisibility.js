import inViewport from "in-viewport";
import { throttle } from "lodash";

export default {
    mounted() {
        window.addEventListener("scroll", this.toggleVisibility);
    },
    data() {
        return {
            isVisible: false
        };
    },
    methods: {
        toggleVisibility: throttle(function(e) {
            let button = document.querySelector("#add-reply-button");
            let field = document.querySelector("#add-reply-field");

            inViewport(field)
                ? (this.isVisible = false)
                : (this.isVisible = true);
        }, 300)
    }
};
