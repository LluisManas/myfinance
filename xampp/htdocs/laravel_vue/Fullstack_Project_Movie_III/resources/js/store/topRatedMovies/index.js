import axios from "axios";

const state = {
    topRatedMoviesList: []
};

const mutations = {
    GET_TOP_RATED_MOVIES(state, payload) {
        state.topRatedMoviesList = payload;
    }
};

const actions = {
    getTopRatedMovies({ commit }) {
        axios.get("/api/top-rated-movies").then(response => {
            commit("GET_TOP_RATED_MOVIES", response.data.results);
        });
    }
};

const getters = {
    getTopRatedMovies: state => state.topRatedMoviesList
};

const topRatedMoviesStore = {
    state,
    mutations,
    actions,
    getters
};

export default topRatedMoviesStore;
