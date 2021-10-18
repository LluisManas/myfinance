import Vue from "vue";
import VueRouter from "vue-router";
import MoviesComponent from "../components/movies/MoviesComponent.vue";
//import NotFound from "../components/NotFound.vue";
import MovieDetailsComponent from "../components/movies/MovieDetailsComponent.vue";
import ListComponent from "../components/ListsComponent.vue";
import AddMovieToListComponent from "../components/lists/AddMovieToListComponent.vue";
import ShowMoviesListComponent from "../components/lists/ShowMoviesListComponent.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            name: "homePage",
            path: "/home-page",
            component: MoviesComponent
        },
        {
            name: "movieDetails",
            path: "/movie/:id",
            component: MovieDetailsComponent,
            props: true
        },
        {
            name: "createList",
            path: "/lists",
            component: ListComponent
        },
        {
            name: "AddMovieToList",
            path: "/add-movie-to-list/:id",
            component: AddMovieToListComponent,
            props: true
        },
        {
            name: "listDetails",
            path: "/list-details/:id",
            component: ShowMoviesListComponent,
            props: true
        }
    ]
});

export default router;
