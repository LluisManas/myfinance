<template>
    <div>
        <div class="container-fluid">
            <h2>Similar Movies</h2>
            <div class="d-flex flex-row flex-nowrap overflow-auto">
                <div v-for="movie in getSimilarMovies" :key="movie.id">
                    <similarmoviecard :movie="movie"></similarmoviecard>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import similarmoviecard from './SimilarMoviesCardComponent.vue';

export default {
    name: 'similarMovies',
    
    computed: {
        ...mapGetters(['getSimilarMovies'])
    },
    components: {
        similarmoviecard
    }
}
</script>

<style scoped>

</style>