<template>
        <div>
        	<div class="headercontainer max-width">
	        	<header id="main-header">
	        		<div class="navigation">
	        			<nav class="navbar navbar-expand-sm">
						  <!-- Links -->
						    <ul class="navbar-nav">
						    <li class="nav-item">
						      <a class="nav-link" href="#">Home</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" href="#">Posts</a>
						    </li>

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
	        		<div id="logo">
	        			<a class="navbar-brand" href="#">Logo</a>
	        		</div>
	        		<div id="searchbar">
						<input class="form-control mr-sm-2" type="text" placeholder="Search">
	        		</div>
	        	</header>
			</div>
			<hr>
			<div id="main-content" class="max-width">
				<div class="flex">
					<div id="content">
						<posts></posts>
					</div>
					<div class="sidebar">
						<sidebar></sidebar>
					</div>
				</div>
			</div>
			<footerrr></footerrr>
        </div>
</template>

<script>
	import Posts from './homepage/Posts.vue';
	import Footer from './Footer.vue';
    export default {
    	components: {
    		'posts': Posts,
    		'footerrr': Footer
    	},
        mounted() {

        }
    }
</script>

<style scoped>
	.container.flex {
	    padding: 0;
	}
	hr{
		margin: 0;
	}
	.flex {
	    display: flex;
	    justify-content: space-between;
	}
</style>
