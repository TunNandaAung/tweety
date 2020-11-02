<template>
  <div class="flex px-4 py-1 rounded-xl rounded-t-none bg-gray-100">
    <div class="flex-1 flex flex-col max-h-screen chat-list">
      <div class="flex-1 flex justify-between overflow-y-hidden">
        <div class="flex-1 flex flex-col justify-between">
          <div class="text-sm overflow-y-auto">
            <ul
              v-chat-scroll="{ always: false, smooth: true }"
              class="overflow-y-auto h-full max-h-screen"
              id="messages"
              @v-chat-scroll-top-reached="fetchMessages()"
              v-if="messages.length"
            >
              <li
                class="mb-4 cursor-pointer"
                :class="{
                  'mb-12': shouldAddMargin(
                    messages[index === 0 ? 0 : index - 1].created_at,
                    messages[index].created_at
                  ),
                }"
                v-for="(message, index) in messages"
                :key="message.id"
              >
                <div
                  class="flex"
                  :class="
                    authUser.id === message.sender.id
                      ? 'justify-end'
                      : 'justify-start'
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
                    >
                      <p>{{ message.message }}</p>
                    </div>
                  </div>
                </div>

                <span
                  v-if="message.read_at"
                  class="text-gray-500 text-xs flex items-center"
                  :class="
                    authUser.id === message.sender.id
                      ? 'justify-end'
                      : 'justify-start'
                  "
                  >{{ formatDate(message.created_at)
                  }}<svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-3 w-3"
                    v-if="message.read_at"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"
                    /></svg
                ></span>
              </li>
            </ul>
            <div
              class="flex items-center flex-col justify-center leading-7 h-full"
              v-else
            >
              <img
                :src="recipient.avatar"
                alt="avatar"
                class="w-24 h-24 rounded-full"
              />
              <h1 class="font-bold text-2xl">{{ recipient.name }}</h1>
              <h3 class="font-semibold text-xl">@{{ recipient.username }}</h3>
              <p>Send a message to {{ recipient.username }}.</p>
            </div>
          </div>

          <div class="flex justify-between w-full mx-auto items-center">
            <div class="flex flex-1 flex-col mr-4">
              <ul>
                <li v-for="participant in participants" :key="participant.id">
                  <p v-if="participant.typing">
                    @{{ participant.name }} is
                    <span class="bg-blue-500 text-white p-1 rounded-lg text-xs"
                      >typing...</span
                    >
                  </p>
                </li>
              </ul>
              <input
                type="text"
                name="message"
                class="bg-gray-300 appearance-none border-2 border-gray-300 rounded-full w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                placeholder="Type your message here..."
                v-model="newMessage"
                @keyup.enter="sendMessage"
                @keyup="sendTypingEvent"
                @blur="markAsRead"
              />
            </div>

            <button
              class="bg-blue-500 rounded-full px-4 py-2 text-white hover:bg-blue-600 font-semibold"
              id="btn-chat"
              @click="sendMessage"
            >
              Send
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import dayjs from "dayjs";
export default {
  props: ["initialMessages", "user", "chatId", "recipient"],
  data() {
    return {
      newMessage: "",
      messages: [],
      participants: [],
      authUser: window.App.user,
      container: this.$refs["messages"],
      currentPage: 1,
      lastPage: null,
      typingTimer: false,
    };
  },
  created() {
    Echo.join("chat." + this.chatId)
      .here((users) => {
        this.participants = users;
      })
      .joining((user) => {
        this.participants.push(user);
      })
      .leaving((user) => {
        this.participants = this.participants.filter((u) => u.id !== user.id);
      })
      .listenForWhisper("typing", ({ id, name }) => {
        if (this.typingTimer) clearTimeout(this.typingTimer);

        this.updateActivePeer(id, true);

        this.typingTimer = setTimeout(() => {
          this.updateActivePeer(id, false);
        }, 3000);
      })
      .listen("MessageSent", (event) => {
        this.messages.push({
          message: event.message.message,
          sender: event.user,
          chatId: event.chat.id,
        });

        this.updateActivePeer(event.user.id, false);
      });
    this.fetchMessages();
  },

  computed: {
    shouldPaginate() {
      return this.currentPage <= this.lastPage - 1;
    },
  },

  methods: {
    updateActivePeer(id, isTyping = true) {
      this.participants.forEach((user, index) => {
        if (user.id === id) {
          user.typing = isTyping;
          this.$set(this.participants, index, user);
        }
      });
    },

    sendTypingEvent() {
      Echo.join("chat." + this.chatId).whisper("typing", this.user);
    },

    sendMessage() {
      this.addMessage({
        sender: this.user,
        message: this.newMessage,
        chatId: this.chatId,
      });

      this.newMessage = "";
    },
    fetchMessages() {
      if (this.currentPage >= this.lastPage) {
        axios.get(this.url(this.currentPage)).then(({ data }) => {
          data.data.map((item) => this.messages.unshift(item));
          this.lastPage = data.last_page;
          this.currentPage++;
        });
      }
    },

    url(page) {
      if (!page) {
        page = 1;
      }
      return `/chat/${this.chatId}/messages?page=${page}`;
    },

    addMessage(message) {
      axios.post(`/chat/${this.chatId}/messages`, message).then((response) => {
        this.messages.push(message);
      });
    },
    shouldAddMargin(firstMessageTime, secondMessageTime) {
      if (!firstMessageTime) {
        return true;
      }

      return dayjs(secondMessageTime).diff(dayjs(firstMessageTime), "m") >= 10;
    },
    markAsRead() {
      axios
        .patch(`/chat/${this.chatId}/messages/${this.recipient.username}/read`)
        .then((response) => {});
    },

    formatDate(date) {
      return dayjs(date).format("MMM DD, YYYY h:mm a");
    },
  },
};
</script>
