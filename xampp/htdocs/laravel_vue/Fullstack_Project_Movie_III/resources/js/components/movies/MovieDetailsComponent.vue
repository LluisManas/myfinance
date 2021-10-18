<template>
    <div class="container">
        <div class="card py-3">
           <div class="container-fluid">
               <div class="row">
                    <div class="col-md-6">
                            <img :src="getImageUrl(getMovieDetails)">
                        </div>
                        <div class="col-md-6">
                            <div class="cart-title">
                                <h3>{{ getMovieDetails['original_title']}}</h3>
                            </div>
                            <div class="cart-body">
                                <p>{{ getMovieDetails['overview']}}</p>
                                <h5>Tags: </h5>
                                <ul>
                                    <div v-for="genre in getMovieDetails['genres']" :key="genre.id">
                                        <li>{{ genre.name }}</li>
                                    </div>
                                </ul>
                                <h5>Streaming Providers: </h5>
                                <p>{{ getMovieDetails['provider']}}</p>
                                <router-link :to="addMovieToList(getMovieDetails)">Add movie</router-link>
                            </div>
                        </div>
                </div>
           </div>
        </div>
        <div class="section">
            <similarmovies :movie="getMovieDetails"></similarmovies>
             
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import similarmovies from './SimilarMoviesComponent.vue';

export default {
    name: 'moviedetails',
    props: ['id'],
    created() {
        this.$store.dispatch('getMovieDetails', this.id)
        this.$store.dispatch('getSimilarMovies', this.id)
    },
    methods: {
        getImageUrl(getMovieDetails) {
            const img = 'https://image.tmdb.org/t/p/w500' + getMovieDetails['backdrop_path'];
            return img;
        },
        addMovieToList(getMovieDetails) {
            const link = '/add-movie-to-list/' + getMovieDetails['id'];
            return link;
        }
    },
    computed: {
        ...mapGetters(['getMovieDetails', 'getSimilarMovies'])
    },
    components: {
        similarmovies
    }
    
}
</script>
