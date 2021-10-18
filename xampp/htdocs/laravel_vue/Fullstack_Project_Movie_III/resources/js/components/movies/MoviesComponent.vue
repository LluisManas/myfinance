<template>
<div>
    <popularmovies></popularmovies>
    <topratedmovies></topratedmovies>
  </div>
</template>

<script>
import popularmovies from "./PopularMoviesComponent.vue";
import topratedmovies from "./TopRatedMoviesComponent.vue";

export default {
  name: "movies",
  components: {
    popularmovies,
    topratedmovies
  },
};
</script>

<style scoped>
</style>