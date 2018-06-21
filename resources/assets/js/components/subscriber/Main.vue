<template>
    <div id="subscriber-view">
    	<div class="row">
    		<div class="col-sm-2 bg-light">
    			<div class="wrapper">
                    <nav id="sidebar">
                        <!-- Sidebar Header -->
                        <div class="sidebar-header">
                            <img class="thumbail" height="100" src="https://ibin.co/45lkejmb2bKZ.jpg">
                        </div>
                        <!-- Sidebar Links -->
                        <ul class="list-unstyled components">
                            <li><router-link to="/admin/users"><a>Users</a></router-link></li>
                            <li><router-link to="/admin/posts"><a>Posts</a></router-link></li>
                            <li> 
                                <a href="#homeLecturer" data-toggle="collapse" aria-expanded="false">Widgets</a>
                                <ul class="collapse list-unstyled" id="homeLecturer">
                                    <li><a href="#">Add New</a></li>
                                    <li><a href="#">Viwe All</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
    		</div>
    		<div class="col-sm-10">
    			<h1>All posts</h1>
                <button type="button" class="mb-4 btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Post</button>
    			<table class="table">
    			    <thead>
    			      <tr>
    			        <th>Title</th>
    			        <th>Thumbnail</th>
    			        <th>Description</th>
    			        <th>Category</th>
    			      </tr>
    			    </thead>
    			    <tbody>
    			      <tr v-for="(post, id) in posts">
    			        <td>{{post.title}}</td>
    			        <td><img height="50" :src="'http://sidneyblog.local/' + post.photo" :alt=post.title></td>
    			        <td v-html="post.description"></td>
    			        <td>{{post.category.name}}</td>
                        <td><button @click.prevent="iniUpdate(id)" class="btn btn-info" data-toggle="modal" data-target="#editModal">Edit</button></td>
    			        <td><button @click="deletePost(id)" class="btn btn-danger">DELETE</button></td>
    			      </tr>
    			    </tbody>
    			</table>
    		</div>
    		<div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">         
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Post</h4>
                      </div>
                      <div class="modal-body">

                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" v-model="post.title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" @change="imageChanged" class="form-control">
                        </div>

                        <div class="form-group">
                          <label>Content</label>
                          <editor v-model="post.description" :init="{plugins: 'wordcount'}"></editor>
                        </div>

                        <div class="form-group">
                            <label>Select Category</label>
                            <select v-model="post.category_id">
                            	<option>Select a Category</option>
                                <option v-for="(category, id) in categories" v-bind:value="category.id">{{ category.name }}</option>
                            </select>
                        </div>                        

                      </div>
                      <div class="modal-footer">
                        <button type="button" @click.prevent="addPost" class="btn btn-primary" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>      
                </div>
            </div>

			<div class="modal fade" id="editModal" role="dialog">
			  <div class="modal-dialog">         
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit Post</h4>
			      </div>
			      <div class="modal-body">

			        <div class="form-group">
			          <label>Title</label>
			          <input type="text" v-model="update_post.title" class="form-control">
			        </div>

			        <div class="form-group">
			            <label>Image</label>
			            <input type="file" @change="imageUpdated" class="form-control">
			        </div>

			        <div class="form-group">
			            <label>Select Category</label>
			            <select v-model="update_post.category_id">
			                <option v-for="(category, id) in categories" v-bind:value="category.id">{{ category.name }}</option>
			            </select>
			        </div>

			        <div class="form-group">
			         <editor :apiKey="kq3z5u2meje79kyrxxx1ttqglqlsdj5ybf40tsjqx9s8hlq6" v-model="update_post.description" :init="{plugins: 'wordcount'}"></editor>
			        </div>

			      </div>
			      <div class="modal-footer">
			        <button type="button" @click.prevent="editPost" class="btn btn-primary" data-dismiss="modal">Submit</button>
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			      </div>
			    </div>      
			  </div>
			</div>

    	</div>
    </div>
</template>

<script>

	import Editor from '@tinymce/tinymce-vue';
    export default {
    	components: {
    		'editor' : Editor
    	},
    	data(){
    		return{
    			posts: [],
    			post: {
    				title: '',
    				description: '',
    				photo: '',
    				category_id: ''
    			},
    			update_post: {},
    			categories: []    			
    		}
    	},
       	mounted(){
       		this.showPosts();
       		this.showCategories();
       	},
       	methods: {
       		deletePost(id){
	            axios.delete('/api/subscriber/' + this.posts[id].id)
	            .then(response => {
	               this.showPosts();
	            })
	            .catch(function(error){
	               console.log(error);
	            });       			
       		},
       		imageChanged(e){
		        var fileReader = new FileReader()
		        fileReader.readAsDataURL(e.target.files[0])
		        fileReader.onload = (e) => {
		            this.post.photo = e.target.result
		        }
		    },
		    imageUpdated(e){
		        var fileReader = new FileReader()
		        fileReader.readAsDataURL(e.target.files[0])
		        fileReader.onload = (e) => {
		            this.update_post.photo = e.target.result
		        }
		    },
       		showPosts(){
	       		axios.get('/api/subscriber').then(response => {
	                this.posts = response.data.posts;
	            });        			
       		},
       		showCategories(){
	          axios.get('/api/categories').then(response => {
	              this.categories = response.data.categories;
	          });        			
       		},
		    addPost(){
		        axios.post('/api/posts', {
		            title: this.post.title,
		            description: this.post.description,
		            category_id: this.post.category_id,
		            photo: this.post.photo               
		        }).then(response => {
		            this.showPosts();
		        })
		        .catch(function(error){
		            console.log(error);
		        });
		    },

		    iniUpdate(id){
		          $('#editModal').modal("show");
		          this.update_post = this.posts[id];
		    },
		    editPost(){
		        axios.put('/api/posts/' + this.update_post.id, {
		            title: this.update_post.title,
		            description: this.update_post.description,
		            category_id: this.update_post.category_id,
		            photo: this.update_post.photo
		        })
		        .then(response => {
		            this.showPosts();
		        })
		        .catch(function(error){
		          console.log(error);
		        });
		    }

       	}
    }
</script>


<style>
	ul.list-unstyled.components,
	.sidebar-header {
	    text-align: center;
	    padding: 30px 0;
	}

	ul.list-unstyled.components li {
	    padding-bottom: 5px;
	}
	img.thumbail {
	    width: 100px;
	    border-radius: 50%;
	    object-fit: cover;
	}
</style>