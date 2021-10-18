<template>
    <div>
        <h1>Top Rated Movies</h1>
        <div class="container-fluid">
            <div class="d-flex flex-row flex-nowrap overflow-auto">
                <div v-for="movie in getTopRatedMovies" :key="movie.id">
                    <moviecart :movie="movie"></moviecart>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moviecart from "./MovieCartComponent.vue";
import {mapGetters} from 'vuex';

export default {
    name: 'topratedmovies',
    created() {
        this.$store.dispatch('getTopRatedMovies');
    },
    computed: {
        ...mapGetters(['getTopRatedMovies'])
    },
    components: {
        moviecart
    }
}
</script>

<style scoped>
</style>