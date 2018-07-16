import VueRouter from 'vue-router';
import Admin from './components/Admin.vue';
import Homepage from './components/Homepage.vue';
import AdminUsers from './components/AdminUsers.vue';
import AdminPosts from './components/AdminPosts.vue';
import Subscriber from './components/subscriber/Main.vue';
import Single from './components/Single.vue';
import Categories from './components/Categories.vue';

let routes = [
	{
		path: '/',
		component: Homepage
	}/*,
	{
		path: '/admin/users',
		component: AdminUsers
	}
	{
		path: '/admin/posts',
		component: AdminPosts
	}*/,
	{
		path: '/subscriber',
		component: Subscriber
	},
	{
		path: '/post/:slug',
		name: 'post',    
		component: Single
	},
	{
		path: '/categories/:slug',
		component: Categories
	}
];

export default new VueRouter({
	mode: 'history',
	routes
});