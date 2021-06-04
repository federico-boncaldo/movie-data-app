<template>
	<div class="container">
		<h1>Movie List</h1>
		<div class="row">
			<div class="col-md-6">
				<button @click="searchMovie('Matrix')">Search Matrix</button>
				<button @click="searchMovie('Matrix Reloaded')">Search Matrix Reloaded</button>
				<button @click="searchMovie('Matrix Revolutions')">Search Matrix Revolutions</button>
			</div>
			<div class="col-md-6">
				<div v-for="movie in movies" :key="movie.id">
					<p>Title: {{ movie.Title }}</p>
					<p>Year: {{ movie.Year }}</p>
					<p>Category:{{ movie.Type }}</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
		},

		data() {
			return {
				movies: [],
				errors: [],
				message: ''
			}
		},
		methods: {
			searchMovie(title) {
				let self = this
				axios.get('movies', {
					params: {
						title: title
					}
				}).then(function(response){
					const { data, Response } = response.data;

					if(Response == true){
						self.movies = data;
					}else{
						self.message = data;
					}
				}).catch(function(error){
					self.errors = error.data.errors
				})
			}
		}

	}

</script>