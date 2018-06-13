
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes';
window.Vue = require('vue');

Vue.use(VueRouter);

Vue.component('home', require('./components/Home.vue'));
//Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.filter('snippet', function(value){
	return value.slice(0,100)
});


const app = new Vue({
    el: '#app',
    router
});
