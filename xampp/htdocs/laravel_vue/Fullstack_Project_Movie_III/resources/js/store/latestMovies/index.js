import axios from "axios";

const state = {
    latestMoviesList: []
};

const mutations = {
    GET_LATEST_MOVIES(state, payload) {
        state.latestMoviesList = payload;
    }
};

const actions = {
    getLatestMovies({ commit }) {
        axios.get("/latest-movies").then(response => {
            console.log(response.data);
            commit("GET_LATEST_MOVIES", response.data);
        });
    }
};

const getters = {
    getLatestMovies: state => state.latestMoviesList
};

const latestMoviesStore = {
    state,
    mutations,
    actions,
    getters
};

export default latestMoviesStore;
