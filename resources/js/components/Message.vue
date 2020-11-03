<template>
  <div>
    <div
      class="flex relative"
      :class="
        authUser.id === message.sender.id ? 'justify-end' : 'justify-start'
      "
    >
      <div class="flex justify-end items-end">
        <img
          class="w-6 h-6 rounded-full mr-2"
          v-if="authUser.id !== message.sender.id"
          :src="message.sender.avatar"
        />
        <div
          class="w-full rounded-full px-3 py-2 text-center cursor-pointer"
          :class="
            authUser.id === message.sender.id
              ? 'bg-blue-200  rounded-br-none hover:bg-blue-300'
              : 'bg-gray-300 rounded-bl-none hover:bg-gray-400'
          "
          @click="toggleInfo"
        >
          <p>{{ message.message }}</p>
        </div>
      </div>
    </div>

    <div
      class="text-gray-500 text-xs flex items-center relative transition-all max-h-0 duration-300 mt-2"
      :class="
        authUser.id === message.sender.id ? 'justify-end' : 'justify-start'
      "
      v-show="showInfo"
      :ref="message.id"
      :style="
        showInfo ? 'max-height: ' + $refs[message.id].scrollHeight + 'px' : ''
      "
    >
      {{ formatDate(message.created_at)
      }}<svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        fill="currentColor"
        class="h-3 w-3"
        v-if="message.read_at && authUser.id === message.sender.id"
      >
        <path
          fill-rule="evenodd"
          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
          clip-rule="evenodd"
        />
      </svg>
    </div>
  </div>
</template>

<script>
import dayjs from "dayjs";
export default {
  props: ["message"],

  data() {
    return {
      authUser: window.App.user,
      showInfo: false,
    };
  },
  methods: {
    formatDate(date) {
      return dayjs(date).format("MMM DD, YYYY h:mm a");
    },
    toggleInfo() {
      this.showInfo = !this.showInfo;
    },
  },
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

.smooth-enter-active,
.smooth-leave-active {
  transition: max-height 0.5s;
}
.smooth-enter,
.smooth-leave-to {
  max-height: 0;
}
</style>