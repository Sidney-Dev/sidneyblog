<template>
	<div>
	<div class="headercontainer max-width">
		<header id="main-header">
			<div class="navigation">
				<nav class="navbar navbar-expand-sm">
				  <!-- Links -->
				    <ul class="navbar-nav">
				    	<li class="nav-item"><router-link to="/"><a class="nav-link">Home</a></router-link></li>

				    <!-- Dropdown -->
				    <li class="nav-item dropdown">
				      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
				        Categories
				      </a>
				      <div class="dropdown-menu">
				        <a class="dropdown-item" href="#">Link 1</a>
				        <a class="dropdown-item" href="#">Link 2</a>
				        <a class="dropdown-item" href="#">Link 3</a>
				      </div>
				    </li>
				    </ul>
				</nav>
			</div>
			<router-view></router-view>
			<div id="logo">
				<a class="navbar-brand" href="#">Logo</a>
			</div>
			<div id="searchbar">
				<input class="form-control mr-sm-2" type="text" placeholder="Search">
			</div>
		</header>
	</div>
	
	<hr>
	</div>
</template>

