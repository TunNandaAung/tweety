<template>
    <div>
        <ul
            class="flex text-center mb-4 border-b border-gray-400"
            role="tablist"
        >
            <li
                v-for="(tab, index) in tabs"
                class="px-4 py-2 bg-white flex-1 cursor-pointer"
                :class="{ 'border-b-2 border-blue-600': tab.isActive }"
                :style="tab.isActive ? 'margin-bottom: -1px' : ''"
                :key="index"
                @click="activeTab = tab"
            >
                <span
                    v-text="tab.title"
                    :class="{ 'font-bold text-blue-600': tab.isActive }"
                    class="focus:outline-none text-lg text-gray-700"
                    role="tab"
                    :aria-selected="tab.isActive"
                ></span>
            </li>
        </ul>

        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        shouldUpdateUrl: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            tabs: [],
            activeTab: null
        };
    },
    mounted() {
        this.tabs = this.$children;
        this.setInitialActiveTab();
    },
    watch: {
        activeTab(activeTab) {
            this.tabs.map(tab => (tab.isActive = tab == activeTab));
            this.$emit("tabUpdated", this.activeTab.title.toLowerCase());

            if (this.shouldUpdateUrl) {
                this.updateUrl();
            }
        }
    },
    methods: {
        setInitialActiveTab() {
            this.activeTab = this.tabs.find(tab => tab.active) || this.tabs[0];
        },
        updateUrl() {
            history.pushState(null, null, this.activeTab.title.toLowerCase());
        }
    }
};
</script>
