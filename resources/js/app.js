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
import algoliasearch from "algoliasearch/lite";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

import VModal from "vue-js-modal";
import PortalVue from "portal-vue";
import InstantSearch from "vue-instantsearch";

Vue.use(InstantSearch);
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
    const algoliaClient = algoliasearch(
        process.env.MIX_ALGOLIA_APP_ID,
        process.env.MIX_ALGOLIA_SECRET
    );

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
        created() {
            dayjs.extend(relativeTime);
        },
        filters: {
            getAvatar: path => {
                return "/" + path.substr(17, path.length);
            }
        },
        data() {
            const searchClient = {
                search(requests) {
                    if (requests.every(({ params }) => !params.query)) {
                        return Promise.resolve({
                            results: requests.map(() => ({
                                hits: [],
                                nbHits: 0,
                                nbPages: 0,
                                processingTimeMS: 0
                            }))
                        });
                    }

                    return algoliaClient.search(requests);
                }
            };

            return {
                searchClient,
                searchFunction(helper) {
                    const currentQuery = helper.getQueryParameter("?q");
                    helper
                        .setQuery("Hello") // we re-apply the previous page
                        .search();
                }
            };
        },
        store,
        el: "#app"
    });
});
