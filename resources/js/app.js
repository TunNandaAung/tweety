/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";
import AvatarForm from "./components/AvatarForm";
import LikeButtons from "./components/LikeButtons";
import Flash from "./components/Flash";

window.events = new Vue();

window.flash = function(message, level = "success") {
    window.events.$emit("flash", { message, level });
};

window.Vue = Vue;

const app = new Vue({
    components: { AvatarForm, LikeButtons, Flash },

    el: "#app"
});
