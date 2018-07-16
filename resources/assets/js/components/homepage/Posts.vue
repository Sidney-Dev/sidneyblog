<template>
    <div class="home-posts">
    	<input type="text" v-model="search" class="form-control" id="search">
	    <article id="posts" v-for="post in filteredPosts">
		    <p>Posted By <strong>{{post.user.name}}</strong> {{ post.created_at | moment("from", "now", true) }} ago</p>
		    <h2><router-link :to="{name:'post', params: {slug: post.slug}}">{{post.title}}</router-link></h2>
		    <div>{{synopsis (post.description)}}</div>
		    <router-link class="btn read-more" :to="{name:'post', params: {slug: post.slug}}">Read More</router-link>
		</article>
	    <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="allPosts()"></pagination>
    </div>
</template>

<script>
    export default {
       	data(){
       		return{
       			search: '',
       			posts: [],
       			pagination: {
            		'current_page': 1
          		}
       		}
       	},
       	mounted(){
       		this.allPosts();
       	},
       	methods: {
		    synopsis (inputString) {
		      var div = document.createElement('div')
		      div.innerHTML = inputString
		      return div.textContent.slice(0, 150)
		    },
			allPosts(){
				axios.get('/api/homeposts?page=' + this.pagination.current_page)
				.then(response => {
					this.posts = response.data.data.data;
					this.pagination = response.data.pagination;
				})
				.catch(function(error){
					console.log(error);
				});
			}
       	},
       	computed: {
            filteredPosts: function(){
                return this.posts.filter((post) => {
                    return post.title.match(this.search);
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
	input#search {
	    margin-bottom: 10px;
	}
</style>