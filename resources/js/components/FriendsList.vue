<template>
  <div class="bg-gray-200 border border-gray-400 rounded-lg py-4 px-4">
    <h3 class="font-bold text-xl mb-4">Following</h3>

    <transition-group
      tag="ul"
      name="slide-up"
      class="stacked-tag-list"
      appear
      v-if="friends.length > 0"
    >
      <li v-for="(friend,index) in friends" :key="friend.id" :class="index === last ? '' :'mb-4'">
        <div>
          <a :href="'/profiles/'+friend.username" class="text-sm font-semibold flex items-center">
            <img :src="friend.avatar" alt class="rounded-full mr-2" width="40" height="40" />
            {{ friend.name}}
          </a>
        </div>
      </li>
    </transition-group>

    <ul v-else>
      <li>No friends yet!</li>
    </ul>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  created() {
    this.$store.dispatch("fetchFriends");
  },
  computed: {
    last() {
      return Object.keys(this.friends).length - 1;
    },
    ...mapState(["friends"])
  }
};
</script> 

<style>
.slide-up-enter {
  transform: translateY(10px);
  opacity: 0;
}

.slide-up-enter-active,
.slide-up-leave-active {
  transition: all 0.2s ease;
}

.slide-up-leave-to {
  transform: translateY(-10px);
  opacity: 0;
}
</style>