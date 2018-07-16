<template>
    <div id="subscriber-view">
    	<div class="row">

        <div class="modal fade" id="editProfile" role="dialog">
          <div class="modal-dialog">         
            <div class="modal-content">          
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Profile</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" v-model="update_user.name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" v-model="update_user.email" class="form-control">
                </div>
                <div class="form-group">
                  <label>Passowrd</label>
                  <input type="password" v-model="update_user.password" class="form-control">
                </div>
                <div class="form-group">
                  <label>Image</label>
                  <input name="photo" type="file" @change="userImage" class="form-control">
                </div>                
              </div>
              <div class="modal-footer">
                <button  @click.prevent="updateUser()" type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>      
        </div>


    		<div class="col-sm-2 profile-sidebar">
    			<div class="wrapper">
              <nav id="sidebar">
                  <!-- Sidebar Header -->
                  <div class="sidebar-header">
                      <img class="thumbail" height="100" :src="'http://sidneyblog.local/' + update_user.photo" :alt=update_user.name>
                  </div>
                  <ul class="list-unstyled text-center">
                    <li><button type="button" data-toggle="modal" data-target="#editProfile">Edit Profile</button>></li>
                    <li><router-link to="/"><a><< Back to home <<</a></router-link></li>
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
    			        <td>{{synopsis (post.description)}}</td>
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
			         <editor v-model="update_post.description" :init="{plugins: 'wordcount'}"></editor>
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
          user: [],
          update_user: {},
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
        console.log(this.showUser());
      },
      methods: {
        synopsis (inputString) {
          var div = document.createElement('div')
          div.innerHTML = inputString
          return div.textContent.slice(0, 80)
        },
        showUser(){
          axios.get('/api/loggedUser')
          .then(response => {
            this.user = response.data.user;
            this.update_user = this.user;
            this.update_user.photo = '';
            console.log(this.update_user);
            /*console.log(this.user);*/
          })
          .catch(function(error){
            console.log(error);
          });
        },
        updateUser(){
          if(this.user.photo == ''){
            axios.put('/api/updatedUser/' + this.update_user.id, {
              name: this.update_user.name,
              email: this.update_user.email,
            })
            .then(response => {
              this.showPosts();
              console.log('updated');
            })
            .catch(function(error){
              console.log(error);
            });
          } 
          else {
            axios.put('/api/updatedUser/' + this.update_user.id, {
              name: this.update_user.name,
              email: this.update_user.email,
              photo: this.update_user.photo,
            })
            .then(response => {
              this.showPosts();
              console.log('updated');
            })
            .catch(function(error){
              console.log(error);
            });
          }
        },
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
        userImage(e){
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
                this.update_user.image = e.target.result
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
        /************************
              ADD METHOD
        ************************/
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
        /************************
              UPDATE METHOD
        ************************/
        iniUpdate(id){
          $('#editModal').modal("show");
          this.update_post = this.posts[id];
          this.update_post.photo = '';
        },
        editPost(){
          if(this.post.photo == ''){
            axios.put('/api/posts/' + this.update_post.id, {
              title: this.update_post.title,
              description: this.update_post.description,
              category_id: this.update_post.category_id,
            })
            .then(response => {
              this.showPosts();
              console.log('updated');
            })
            .catch(function(error){
              console.log(error);
            });
          } 
          else {
            axios.put('/api/posts/' + this.update_post.id, {
              title: this.update_post.title,
              description: this.update_post.description,
              category_id: this.update_post.category_id,
              photo: this.update_post.photo
            })
            .then(response => {
              this.showPosts();
              console.log('updated');
            })
            .catch(function(error){
              console.log(error);
            });
          }
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