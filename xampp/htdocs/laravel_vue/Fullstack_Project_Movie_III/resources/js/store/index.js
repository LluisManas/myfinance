import Vue from "vue";
import Vuex from "vuex";
import popularMovies from "./popularMovies";
import topRatedMovies from "./topRatedMovies";
import detailsMovie from "./detailsMovie";
import similarMovie from "./similarMovies";
import createList from "./list";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        popularMovies,
        topRatedMovies,
        detailsMovie,
        similarMovie,
        createList
    }
});
