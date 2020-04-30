/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";
import store from "./store/store";
import AvatarForm from "./components/AvatarForm";
import BannerForm from "./components/BannerForm";
import LikeButtons from "./components/LikeButtons";
import Flash from "./components/Flash";
import FollowButton from "./components/FollowButton";
import FriendsList from "./components/FriendsList";
import PublishTweetPanel from "./components/PublishTweetPanel";
import Dropdown from "./components/Dropdown";
import ConfirmDeleteModal from "./utils/ConfirmDeleteModal";
import AddReplyModal from "./utils/AddReplyModal";
import Replies from "./components/Replies";
import NotificationLink from "./components/NotificationLink";

import VModal from "vue-js-modal";

Vue.use(VModal);

import TurbolinksAdapter from "vue-turbolinks";
import Turbolinks from "turbolinks";
Turbolinks.start();

window.events = new Vue();

window.flash = function(message, level = "success") {
    window.events.$emit("flash", { message, level });
};

window.Vue = Vue;
Vue.use(TurbolinksAdapter);

document.addEventListener("turbolinks:load", () => {
    const app = new Vue({
        components: {
            AvatarForm,
            BannerForm,
            LikeButtons,
            Flash,
            FollowButton,
            FriendsList,
            PublishTweetPanel,
            Dropdown,
            ConfirmDeleteModal,
            AddReplyModal,
            Replies,
            NotificationLink
        },
        store,
        el: "#app"
    });
});
