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
                <router-view></router-view>
            </div>
        </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Admin component mounted.')
        }
    }
</script>

<style scoped>
    #adminsidebar a{
        color: white;
    }

</style>
