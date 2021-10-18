import axios from "axios";

const state = {
    movie: []
};

const mutations = {
    GET_MOVIE_DETAILS(state, payload) {
        state.movie = payload;
    }
};

const actions = {
    getMovieDetails({ commit }, id) {
        axios.get(`/api/movie/${id}`).then(response => {
            commit("GET_MOVIE_DETAILS", response.data);
        });
    }
};
const getters = {
    getMovieDetails: state => state.movie
};

const movieStore = {
    state,
    mutations,
    actions,
    getters
};

export default movieStore;
