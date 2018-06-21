
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes';
import Editor from '@tinymce/tinymce-vue';
import VueMoment from 'vue-moment';
window.Vue = require('vue');

Vue.use(VueRouter);

Vue.use(require('vue-moment'));

Vue.component('home', require('./components/Home.vue'));
Vue.component('admin', require('./components/Admin.vue'));
Vue.component('sidebar', require('./components/Sidebar.vue'));
Vue.component('homepage', require('./components/Homepage.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('subscriber', require('./components/subscriber/Main.vue'));

Vue.component('pagination', require('./components/Pagination.vue'));

Vue.component('about', require('./components/About.vue'));

Vue.filter('snippet', function(value){
	return value.slice(0,100)
});
/*
Vue.filter('striphtml', function (value) {
  var div = document.createElement("div");
  div.innerHTML = value;
  var text = div.textContent || div.innerText || "";
  return text;
});*/

const app = new Vue({
    el: '#app',
    router
});
