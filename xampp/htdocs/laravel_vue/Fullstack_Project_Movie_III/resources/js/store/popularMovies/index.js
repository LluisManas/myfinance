import axios from "axios";

const state = {
    popularMoviesList: []
};

const mutations = {
    GET_POPULAR_MOVIES(state, payload) {
        state.popularMoviesList = payload;
    }
};

const actions = {
    getPopularMovies({ commit }) {
        axios.get("/api/popular-movies").then(response => {
            commit("GET_POPULAR_MOVIES", response.data.results);
        });
    }
};

const getters = {
    getPopularMovies: state => state.popularMoviesList
};

const popularMoviesStore = {
    state,
    mutations,
    actions,
    getters
};

export default popularMoviesStore;
