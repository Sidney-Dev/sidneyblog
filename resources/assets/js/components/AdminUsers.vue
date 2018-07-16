<template>
    <div class="row home-template">
      <div id="adminsidebar" class="col-sm-2">
          <div class="wrapper">
              <nav id="sidebar">
                  <!-- Sidebar Header -->
                  <div class="sidebar-header text-center">
                      <h3>DASHBOARD</h3>
                  </div>
                  <!-- Sidebar Links -->
                  <ul class="list-unstyled components text-center">
                      <li><router-link to="/admin/users"><a>Users</a></router-link></li>
                      <li><a href="http://sidneyblog.local/admin/posts">Posts</a></li>
                      <!--<li> 
                          <a href="#homeLecturer" data-toggle="collapse" aria-expanded="false">Widgets</a>
                          <ul class="collapse list-unstyled" id="homeLecturer">
                              <li><a href="#">Add New</a></li>
                              <li><a href="#">Viwe All</a></li>
                          </ul>
                      </li>-->
                  </ul>
              </nav>
          </div>
      </div>
      <div class="col-sm-10">
              <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">          
                <h1>All Users</h1>
                <button type="button" class="mb-4 btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add User</button>
                <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(user, id) in users">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.is_active == 1 ? 'Active' : 'Not Active' }}</td>
                        <td>{{ user.role_id == 1 ? 'Administrator' : 'Guest' }}</td>
                        <td><button @click.prevent="initUpdate(id)" class="btn btn-info">Edit</button></td>
                        <td><button @click="deleteUser(id)" class="btn btn-danger">Delete</button></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>


        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">         
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New User</h4>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" v-model="user.name" class="form-control">
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" v-model="user.password" class="form-control">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" v-model="user.email" class="form-control">
                </div>

                <div class="form-group">
                  <label>Role</label>
                  <select  v-model="user.role_id">
                    <option>Choose Role</option>
                    <option v-bind:value="1">Admin</option>
                    <option v-bind:value="2">Subscriber</option>
                    <option v-bind:value="3">Author</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select  v-model="user.is_active">
                    <option>Choose status</option>
                    <option v-bind:value="1">Active</option>
                    <option v-bind:value="2">Inactive</option>
                  </select>
                </div>
            
              </div>
              <div class="modal-footer">
                <button type="button" @click.prevent="addUser" class="btn btn-primary" data-dismiss="modal">Submit</button>
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
                <h4 class="modal-title">Edit User</h4>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" v-model="update_user.name" class="form-control">
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" v-model="update_user.password" class="form-control">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" v-model="update_user.email" class="form-control">
                </div>

                <div class="form-group">
                  <label>Role</label>
                  <select  v-model="update_user.role_id">
                    <option>Choose Role</option>
                    <option v-bind:value="1">Admin</option>
                    <option v-bind:value="2">Subscriber</option>
                    <option v-bind:value="3">Author</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select  v-model="update_user.is_active">
                    <option v-bind:value="1">Active</option>
                    <option v-bind:value="2">Inactive</option>
                  </select>
                </div>
            
              </div>
              <div class="modal-footer">
                <button type="button" @click.prevent="updateUser" class="btn btn-primary" data-dismiss="modal">Submit</button>
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
                users: [],
                user: {
                  name: '',
                  password: '',
                  email: '',
                  role_id: '',
                  is_active: ''
                },
                edit: false,
                update_user: {}
            }
        },
        mounted() {
            this.showUsers();
        },
        methods: {
            initUpdate(id){
                $('#editModal').modal("show");
                this.update_user = this.users[id];
            },
            showUsers(){
              axios.get('/api/users').then(response => {
                this.users = response.data.data;
              });                
            },
            addUser(){
              axios.post('/api/users', {
                name: this.user.name,
                password: this.user.password,
                email: this.user.email,
                role_id: this.user.role_id,
                is_active: this.user.is_active
              })
              .then(response => {
                  alert('added');
                  this.showUsers();
                  this.reset();
              })
              .catch(function(error){
                alert('not sadded');
                console.log(error);
                });
            },
            reset(){
                this.user.name = "",
                this.user.password = "",
                this.user.role_id = "",
                this.user.is_active = ""
            },
            deleteUser(id){
              axios.delete('/api/users/' + this.users[id].id)
              .then(response => {
                this.showUsers();
              })
              .catch(error => {
                alert('Not Deleted');
              });
            },
            updateUser(){
                axios.patch('/api/users/' + this.update_user.id, {
                  name: this.update_user.name,
                  email: this.update_user.email,
                  role_id: this.update_user.role_id,
                  is_active: this.update_user.is_active                  
                })
                .then(response => {
                  alert('updated');
                  this.showUsers();
                })
                .catch(function(error){
                  console.log(error);
                  alert('not updated');
                });
            }
        }
    }
</script>
