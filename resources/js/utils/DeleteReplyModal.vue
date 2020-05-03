<template>
  <modal
    :name="'confirm-delete-reply-'+id"
    classes="p-8 bg-gray-100 shadow-lg rounded-lg w-64"
    height="auto"
    width="25%"
    @before-open="beforeOpen"
  >
    <h1 class="font-normal mb-6 text-center text-2xl font-bold">Delete Your Reply?</h1>
    <p class="mb-6 font-semibold text-center">This can't be undone. Are you sure?</p>

    <div class="flex items-center justify-center">
      <button
        class="mr-5 shadow bg-gray-700 hover:bg-gray-800 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
        @click="$modal.hide(`confirm-delete-reply-${id}`)"
      >Cancel</button>

      <button
        class="shadow bg-red-600 hover:bg-red-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
        type="button"
        @click="submit"
      >Delete</button>
    </div>
  </modal>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      replyID: ""
    };
  },
  methods: {
    beforeOpen(event) {
      console.log(event.params);
      this.replyID = event.params.replyID;
    },
    submit() {
      //   this.$modal.hide(`confirm-delete-reply-${this.id}`);
      //   flash("Your reply has been deleted", "danger");

      //   this.$emit("deleted");
      axios.delete(`/replies/${this.replyID}`).then(response => {
        this.$modal.hide(`confirm-delete-reply-${this.id}`);
        flash("Your reply has been deleted", "danger");

        this.$emit("deleted");
      });
    }
  }
};
</script>
