<template>
  <div>
    <h1>Popular Movies:</h1>
      <div class="container-fluid">
        <div class="d-flex flex-row flex-nowrap overflow-auto">
            <div v-for="movie in getPopularMovies" :key="movie.id">
                <moviecart :movie="movie"></moviecart>
            </div>
        </div>
      </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import moviecart from "./MovieCartComponent.vue";

export default {
  name: "popularmovies",
  created() {
    this.$store.dispatch("getPopularMovies");
  },
  computed: {
    ...mapGetters(["getPopularMovies"]),
  },
  components: {
    moviecart,
  },
};
</script>

<style scoped>
</style>