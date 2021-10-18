<template>
  <div>
    <div class="card movie-cart">
        <img :src="getImage(movie)">
        <div class="card-body">
            <h5 class="card-title"><router-link :to="{name: 'movieDetails', params: {id: movie.id}}">{{ movie.title }}</router-link></h5>
            <p class="card-text movie-text">{{ movie.overview }}</p>
        </div>
        <div class="card-footer">
          <p>{{ movie.provider }}</p>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "moviecart",
  props: ["movie"],
  methods: {
      getImage(movie) {
          const image = "https://image.tmdb.org/t/p/w500" + movie.backdrop_path;
          return image;
      }
  }
};
</script>

<style scoped>
.movie-cart {
    width: 18rem;
    height: 22rem;
}
.movie-text {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 11px;
}
</style>