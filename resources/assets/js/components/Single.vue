<template>
    <div>
    	<navbar></navbar>
    	<div class="flex max-width">
    		<div class="col-sm-9">
			    <h1>{{ post.title }}</h1>
			    <p>Posted By <strong>{{post.user.name}}</strong> {{ post.created_at | moment("from", "now", true) }} ago</p>
			    <article>{{ post.description }}</article> 
    		</div>
    		<div class="sidebar bg-light col-sm-3">
		    	<sidebar></sidebar>    			
    		</div>
    	</div> 	
    </div>
</template>

<script>
    export default {
       	data(){
       		return{
       			id: this.$route.params.id,
       			post: {}
       		}
       	},
       	mounted(){
			axios.get('/single/post/' + this.id).then(response =>{
	       		this.post = response.data.post;
	       	})
       	}	
    }
</script>