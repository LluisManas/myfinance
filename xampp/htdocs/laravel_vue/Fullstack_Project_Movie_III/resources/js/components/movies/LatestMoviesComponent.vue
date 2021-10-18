<template>
    <div>
        <h1>Latest Movies</h1>
        <div class="container-fluid">
            <div class="d-flex flex-row flex-nowrap overflow-auto">
                <moviecart :movie="getLatestMovies"></moviecart>
            </div>
        </div>
    </div>
</template>

<script>
import moviecart from './MovieCartComponent.vue';
import { mapGetters } from 'vuex';

export default {
    name: 'latestmovies',
    created() {
        this.$store.dispatch('getLatestMovies');
    },
    computed: {
        ...mapGetters(['getLatestMovies'])
    },
    components: {
        moviecart
    }
}
</script>

<style scoped>
</style>