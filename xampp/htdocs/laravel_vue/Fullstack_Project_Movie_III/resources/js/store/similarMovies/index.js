import axios from "axios";

const state = {
    movies: []
};

const mutations = {
    GET_SIMILAR_MOVIES(state, payload) {
        state.movies = payload;
    }
};

const actions = {
    getSimilarMovies({ commit }, id) {
        axios.get(`/api/movie/${id}/similar`).then(response => {
            commit("GET_SIMILAR_MOVIES", response.data);
        });
    }
};

const getters = {
    getSimilarMovies: state => state.movies
};

const similarMoviesStore = {
    state,
    mutations,
    actions,
    getters
};

export default similarMoviesStore;
