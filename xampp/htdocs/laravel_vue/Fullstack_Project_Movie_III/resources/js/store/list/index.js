import axios from "axios";

const state = {
    listName: "",
    listId: "",
    lists: [],
    movies: [],
    getMovies: []
};

const mutations = {
    SHOW_LISTS(state, payload) {
        state.lists = payload;
    },
    CREATE_LIST(state, payload) {
        state.lists.push(payload);
    },
    ADD_MOVIE(state, payload) {
        state.movies = payload;
    },
    GET_MOVIES_FROM_LIST(state, payload) {
        state.getMovies = payload;
    },
    DELETE_LISTS(state, payload) {
        const list = state.lists.map(list => list.id).indexOf(payload);
        state.lists.splice(list, 1);
    }
};

const actions = {
    showLists({ commit }) {
        axios.get("/api/lists").then(response => {
            console.log(response.lists, response.data.lists);
            commit("SHOW_LISTS", response.data.lists);
        });
    },
    createList({ commit }, listName) {
        axios
            .post("/api/create-list", { name: listName })
            .then(response => {
                $("#sucess").html(response.data.message);
                console.log("h", response.data.list);
                commit("CREATE_LIST", response.data.list);
            })
            .catch(err => {
                console.log("error", err);
            });
    },
    addMovieToList({ commit }, data) {
        console.log(data);
        axios
            .post(`/api/add-movie-to-list/${data.listId}`, {
                listId: data.listId,
                movieId: data.movieId
            })
            .then(response => {
                $("#success").html(response.data.message);
                console.log("1", response.data, "2", data);
                commit("ADD_MOVIE", data);
            })
            .catch(err => {
                console.log(err);
            });
    },
    getMoviesFromList({ commit }, listId) {
        axios.get(`/api/get-movies-from-list/${listId}`).then(response => {
            commit("GET_MOVIES_FROM_LIST", response.data.movies);
            console.log(response.data.movies);
        });
    },
    deleteList({ commit }, listId) {
        axios
            .get(`/api/delete-list/${listId}`)
            .then(response => {
                console.log(response);
                commit("DELETE_LISTS", listId);
            })
            .catch(err => {
                console.log(err);
            });
    }
};

const getters = {
    getMovieLists: state => state.lists,
    getMoviesFromList: state => state.getMovies
};

const listStore = {
    state,
    mutations,
    actions,
    getters
};

export default listStore;
