<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <header id="top-header">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="collapse navbar-collapse max-width" id="navbarNav">
                <ul class="navbar-nav">
                    @if(Auth::check())
                        <li class="nav-item">
                            <li><router-link to="/subscriber"><a class="nav-link" >{{ Auth::user()->name }}</a></router-link></li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">Register</a>
                        </li>
                    @endif
                </ul>
              </div>
            </nav>
        </header>

        <div class="row home-template">
            <div id="adminsidebar" class="col-sm-2">
                <div class="wrapper">
                    <nav id="sidebar">
                        <!-- Sidebar Header -->
                        <div class="sidebar-header text-center">
                            <h3>DASHBOARD</h3>
                        </div>
                          
                        <ul class="list-unstyled components text-center">
                            <!--<li><router-link to="/admin/users"><a>Users</a></router-link></li>
                            <li><router-link to="/admin/posts"><a>Posts</a></router-link></li>-->
                            <li><a href="{{ url( '/admin/users' ) }}">Users</a></li>
                            <li><a href="{{route('posts.index')}}">Posts</a></li>
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
                @yield('content')
            </div>
        </div>
    
    </div>
</body>
</html>
