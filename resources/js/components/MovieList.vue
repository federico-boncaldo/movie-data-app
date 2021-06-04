<template>
	<div class="container">
		<h1 class="p-2 text-center">Movie List</h1>
		<div class="text-center">
			<button type="button" class="btn btn-primary" @click="searchMovie('Matrix')">Search Matrix</button>
			<button type="button" class="btn btn-primary" @click="searchMovie('Matrix Reloaded')">Search Matrix Reloaded</button>
			<button type="button" class="btn btn-primary" @click="searchMovie('Matrix Revolutions')">Search Matrix Revolutions</button>
		</div>
		<div>
			<div v-for="movie in movies" :key="movie.id" class="card m-2">
				<div class="card-body">
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