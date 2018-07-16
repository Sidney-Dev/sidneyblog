<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>All posts</h1>
                <button type="button" class="mb-4 btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Post</button>
                <div class="form-group">
                  <input type="" class="form-control">
                </div>
                <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="showPosts()"></pagination>
                <table class="table">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Photo</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Owner</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(post, id) in posts">
                           <td>{{ post.title }}</td>
                           <td><img height="50" :src="'http://sidneyblog.local/' + post.photo" :alt=post.title></td>
                           <td>{{synopsis (post.description)}}...</td>
                           <td>{{ post.category.name }}</td>
                           <td>{{ post.user.name }}</td>
                           <td><button @click.prevent="iniUpdate(id)" class="btn btn-info" data-toggle="modal" data-target="#editModal">Edit</button></td>
                           <td><button @click="deletePost(id)" class="btn btn-danger">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
                <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="showPosts()"></pagination>
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
                            <input name="photo" type="file" @change="imageChanged" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Content</label>
                          <editor v-model="post.description" :init="{plugins: 'wordcount'}"></editor>
                        </div>

                        <div class="form-group">
                            <label>Select Category</label>
                            <select v-model="post.category_id">
                                <option>Choose Category</option>
                                <option v-for="(category, id) in categories" v-bind:value="category.id">{{ category.name }}</option>
                            </select>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" @click.prevent="addPost" class="btn btn-info" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>      
                  </div>
                </div>



                <!--  EDIT MODAL-->
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
                            <input name="photo" type="file" @change="imageUpdated" class="form-control">
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
                        <button type="button" @click.prevent="editPost" class="btn btn-info" data-dismiss="modal">Submit</button>
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
  import Editor from '@tinymce/tinymce-vue';
  export default {
    components: {
      'editor': Editor
    },
    data(){
      return{
        posts: [],
        pagination: {
          'current_page': 1
        },
        post: {
          title: '',
          description: '',
          category_id: '',
          photo: ''
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
      synopsis (inputString) {
        var div = document.createElement('div')
        div.innerHTML = inputString
        return div.textContent.slice(0, 150)
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
      showCategories(){
        axios.get('/api/categories').then(response => {
            this.categories = response.data.categories;
        });
      },
      /************************
            SHOW METHOD
      ************************/
      showPosts(){
        axios.get('/api/posts?page=' + this.pagination.current_page)
        .then(response => {
            this.posts = response.data.data.data;
            this.pagination = response.data.pagination;
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
      deletePost(id){
        axios.delete('/api/posts/' + this.posts[id].id)
        .then(response => {
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
