<template>
    <div>
        <div class="card">
            <div class="card-body movie-card">
            <img :src="getImage(movie)" class="movie-image">
                <h5 class="card-title"><router-link :to="{name: 'movieDetails', params: {id: movie.id}}">{{ movie.original_title }}</router-link></h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'similarMoviesCard',
    props: ['movie'],
    methods: {
      getImage(movie) {
          const image = "https://image.tmdb.org/t/p/w500" + movie.backdrop_path;
          return image;
      }
  }
}
</script>

<style scoped>
.movie-card {
    width: 13rem;
    height: 12rem;
}
.movie-image {
    width: 11rem;
    height: 8rem;
}
</style>