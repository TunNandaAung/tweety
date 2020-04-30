<template>
    <li class="relative">
        <a
            class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center"
            href="/notifications"
        >
            Notifications
        </a>

        <span
            class="absolute top-0 bg-blue-700 rounded-full text-white h-6 w-6 text-center"
            style="right:-15%"
            v-if="count > 0"
        >
            {{ count }}
        </span>
    </li>
</template>

<script>
export default {
    props: ["count"]
};
</script>
