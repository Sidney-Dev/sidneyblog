<template>
    <div>
    	<navbar></navbar>
    	<div class="flex max-width">
    		<div class="col-sm-9">
			    <h1>{{ post.title }}</h1>
			    <p>Posted By <strong>{{post.user.name}}</strong> {{ post.created_at | moment("from", "now", true) }} ago</p>
			    <article v-html="post.description"></article>
    		</div>
		    <sidebar></sidebar>    			
    	</div> 	
    </div>
</template>

<script>
    export default {
       	data(){
       		return{
       			slug: this.$route.params.slug,
       			post: {}
       		}
       	},
      mounted(){
			  axios.get('/single/post/' + this.slug).then(response =>{
	       		this.post = response.data.post;
	      })
      }	
    }
</script>