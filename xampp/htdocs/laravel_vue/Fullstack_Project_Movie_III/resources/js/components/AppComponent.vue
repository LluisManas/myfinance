<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
import movies from "./movies/MoviesComponent.vue";
import list from './ListsComponent.vue';
import addmovietolist from './lists/AddMovieToListComponent.vue';

export default {
  name: "appcomponent",
  components: {
    movies,
    list,
    addmovietolist
  },
};
</script>
