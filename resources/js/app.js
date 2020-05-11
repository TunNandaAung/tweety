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
import DeleteTweetModal from "./utils/DeleteTweetModal";
import AddReplyModal from "./utils/AddReplyModal";
import Replies from "./components/Replies";
import Reply from "./components/Reply";
import NotificationLink from "./components/NotificationLink";
import ReplyButton from "./components/ReplyButton";
import Tabs from "./components/Tabs";
import Tab from "./components/Tab";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

import VModal from "vue-js-modal";
import PortalVue from "portal-vue";
import algoliaSearch from "./mixins/algoliaSearch";
import { ObserveVisibility } from "vue-observe-visibility";

Vue.directive("observe-visibility", ObserveVisibility);

Vue.use(PortalVue);
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
let authorizations = require("./authorizations");

Vue.filter("diffForHumans", date => {
    if (!date) {
        return null;
    }

    return dayjs(date).fromNow();
});

Vue.prototype.authorize = function(...params) {
    if (!window.App.signedIn) return false;

    if (typeof params[0] === "string") {
        return authorizations[params[0]](params[1]);
    }

    return params[0](window.App.user);
};

Vue.prototype.signedIn = window.App.signedIn;

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
            DeleteTweetModal,
            AddReplyModal,
            Replies,
            NotificationLink,
            ReplyButton,
            Reply,
            Tab,
            Tabs
        },
        mixins: [algoliaSearch],
        created() {
            dayjs.extend(relativeTime);
        },
        store,
        el: "#app"
    });
});
