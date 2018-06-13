import VueRouter from 'vue-router';
import Home from './components/Home.vue';
import AdminUsers from './components/AdminUsers.vue';
import AdminPosts from './components/AdminPosts.vue';

let routes = [
	{
		path: '/admin',
		component: Home
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