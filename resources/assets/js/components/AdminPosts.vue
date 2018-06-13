<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>All posts</h1>
                <button type="button" class="mb-4 btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Post</button>
                <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Owner</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(post, id) in posts">
                           <td>{{ post.id }}</td>
                           <td>{{ post.title }}</td>
                           <td>{{ post.description }}</td>
                           <td>{{ post.category.name }}</td>
                           <td>{{ post.user.name }}</td>
                           <td><button @click.prevent="iniUpdate(id)" class="btn btn-info" data-toggle="modal" data-target="#editModal">Edit</button></td>
                           <td><button @click="deletePost(id)" class="btn btn-danger">Delete</button></td>
                        </tr>
                    </tbody>
                  </table>

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
                         <textarea v-model="post.description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <select v-model="post.category_id">
                                <option>Choose Category</option>
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
                        <button type="button" class="close" data-dismiss="editModal">&times;</button>
                        <h4 class="modal-title">Edit Post</h4>
                      </div>
                      <div class="modal-body">

                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" v-model="update_post.title" class="form-control">
                        </div>

                        <div class="form-group">
                         <textarea v-model="update_post.description" class="form-control"></textarea>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" @click.prevent="editPost" class="btn btn-primary" data-dismiss="editModal">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>      
                  </div>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data(){
            return{
                posts: [],
                post: {
                    title: '',
                    description: '',
                    category_id: ''
                },
                update_post: {},
                categories: []
            }
        },
        mounted() {
            this.showPosts();
            this.showCategories();
        },
        methods: {
            showCategories(){
                axios.get('/api/categories').then(response => {
                    this.categories = response.data.categories;
                });
            },
            showPosts(){
                axios.get('/api/posts').then(response => {
                    this.posts = response.data.posts;
                });               
            },
            addPost(){
                axios.post('/api/posts', {
                    title: this.post.title,
                    description: this.post.description,
                    category_id: this.post.category_id               
                }).then(response => {
                    this.showPosts();
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            deletePost(id){
                axios.delete('/api/posts/' + this.posts[id].id)
                .then(response => {
                    this.showPosts();
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            iniUpdate(id){
                $('#editModal').modal("show");
                this.update_post = this.posts[id];
            }

        }
    }
</script>
