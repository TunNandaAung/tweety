<template>
    <div class="dropdown relative">
        <div
            class="dropdown-toggle"
            @click.prevent="isOpen = !isOpen"
            aria-haspopup="true"
            :aria-expended="isOpen"
        >
            <slot name="trigger"></slot>
        </div>

        <transition name="pop-out-quick">
            <ul
                v-show="isOpen"
                class="bg-gray-100 absolute mt-2 bg-white -m-6 rounded shadow-lg z-10"
            >
                <slot></slot>
            </ul>
        </transition>
    </div>
</template>

<script>
export default {
    props: ["classes"],

    data() {
        return {
            isOpen: false
        };
    },

    watch: {
        isOpen(isOpen) {
            if (isOpen) {
                document.addEventListener("click", this.closedIfClickedOuside);
            }
        }
    },

    methods: {
        closedIfClickedOuside() {
            if (!event.target.closet("dropdown")) {
                this.isOpen = false;
            }
        }
    }
};
</script>

<style>
.pop-out-quick-enter-active,
.pop-out-quick-leave-active {
    transition: all 0.4s;
}

.pop-out-quick-enter,
.pop-out-quick-leave-active {
    opacity: 0;
    transform: translateY(-7px);
}
</style>
