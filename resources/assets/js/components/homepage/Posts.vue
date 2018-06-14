<template>
    <div class="container flex">
	    <article id="posts" v-for="post in posts">
	    	<img class="card-img" :src="'http://sidneyblog.local/' + post.photo">
	    	<h2>{{post.title}}</h2>
	    	<div>{{post.description | snippet}}</div>
	    </article>
    </div>
</template>

<script>
    export default {
       	data(){
       		return{
       			posts: []
       		}
       	},
       	mounted(){
       		this.allPosts()
       	},
       	methods: {
			allPosts(){
				axios.get('/api/homeposts')
				.then(response => {
					this.posts = response.data.posts;
				})
				.catch(function(error){
					console.log(error);
				});
			}
       	}
    }
</script>

<style lang="scss">
	
	.container.flex{
		article{
			width: 30%;
		}
        flex-wrap: wrap;
	}
</style>