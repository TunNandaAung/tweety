<template>
  <!-- <form method="POST" action="/profiles/{{ $user->username }}/follow"> -->
  <form @submit.prevent="toggle">
    <button
      type="submit"
      class="rounded-full shadow py-2 px-6 text-sm font-bold focus:outline-none"
      :class="followed ? 'bg-blue-500 hover:bg-red-600 text-white' : 'border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white'"
      @mouseover="hover"
      @mouseleave="mouseleave"
    >{{ unfollowText ? unfollowText : text }}</button>
  </form>
</template>

<script>
export default {
  props: ["user", "following"],

  computed: {
    text: {
      get: function() {
        return this.followed ? "Following" : "Follow";
      },
      set: function(newValue) {
        return newValue;
      }
    }
  },
  data() {
    return {
      followed: this.following,
      unfollowText: null
    };
  },
  methods: {
    toggle() {
      this.$store.dispatch("followFriend", this.user).then(response => {
        this.followed ? this.unfollow() : this.follow();
      });
    },
    follow() {
      flash(`You are now following @${this.user.username}`);
      this.followed = true;
    },
    unfollow() {
      flash(`You have unfollowed @${this.user.username}`, "danger");
      this.followed = false;
    },
    hover() {
      this.followed
        ? (this.unfollowText = "Unfollow")
        : (this.unfollowText = null);
    },
    mouseleave() {
      this.unfollowText = null;
    }
  }
};
</script>