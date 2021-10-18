<template>
    <div class="container">
        <p>Movies in List</p>
        <div class="grid-container">
            <div v-for="movie in getMoviesFromList" :key="movie.id">
                <moviecart :movie="movie"></moviecart>
                <button class="btn btn-danger">Remove from List</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
import moviecart from '../movies/MovieCartComponent.vue';

export default {
    name: 'showMoviesList',
    props: ['id'],
    created() {
        this.$store.dispatch('getMoviesFromList', this.id)
    },
    computed: {
        ...mapGetters(['getMoviesFromList', 'getMovieDetails'])
    },
    components: {
        moviecart
    }
}
</script>

<style scoped>
.grid-container {
    display: grid;
    grid-template-columns: auto auto auto auto;
    align-content: space-evenly;
}
</style>
