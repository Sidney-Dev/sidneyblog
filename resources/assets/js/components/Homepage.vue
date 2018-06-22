<template>
        <div>
        	<navbar></navbar>
			<div id="main-content" class="max-width">
				<div class="flex">
					<div id="content">
						<posts></posts>
					</div>
					<sidebar></sidebar>
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
    	}
    }
</script>

<style scoped>
	.container.flex {
	    padding: 0;
	}
</style>
