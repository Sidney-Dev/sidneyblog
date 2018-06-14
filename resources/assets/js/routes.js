import VueRouter from 'vue-router';
import Admin from './components/Admin.vue';
import Homepage from './components/Homepage.vue';
import AdminUsers from './components/AdminUsers.vue';
import AdminPosts from './components/AdminPosts.vue';

let routes = [
	{
		path: '/',
		component: Homepage
	},
	{
		path: '/admin/users',
		component: AdminUsers
	},
	{
		path: '/admin/posts',
		component: AdminPosts
	}
];

export default new VueRouter({
	mode: 'history',
	routes
});