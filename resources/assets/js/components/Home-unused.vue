<template>
        <div class="row">
            <div id="adminsidebar" class="col-sm-2">
                <div class="wrapper">
                    <nav id="sidebar">
                        
                        <!-- Sidebar Header -->
                        <div class="sidebar-header">
                            <h3>DASHBOARD</h3>
                        </div>
                        <!-- Sidebar Links -->
                        <ul class="list-unstyled components">
                            <li><router-link to="/admin/users"><a class="navbar-brand">Users</a></router-link></li>
                            <li><router-link to="/admin/posts"><a class="navbar-brand">Posts</a></router-link></li>
                            <li><!-- Link with dropdown items -->
                                <a href="#homeLecturer" data-toggle="collapse" aria-expanded="false">Posts</a>
                                <ul class="collapse list-unstyled" id="homeLecturer">
                                    <li><a href="#">Add New</a></li>
                                    <li><a href="#">Viwe All</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Courses</a></li>
                            <li> 
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Courses</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li><a href="#">Electrical</a></li>
                                    <li><a href="#">Page</a></li>
                                    <li><a href="#">Page</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Streams</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-sm-10 jumbotron">
                <router-view></router-view>
            </div>
        </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
    #adminsidebar a{
        color: white;
    }

</style>
