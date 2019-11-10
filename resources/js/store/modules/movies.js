"use strict"

export default {
    state:{
        movies: {},
    },
    getters:{
        getAllMovies: state => state.movies,
    },
    actions:{
        getAllMovies({commit}){
            commit('loadMovies', 123);
        }
    },
    mutations:{
        loadMovies(state, data){
            state.movies = data;
        },
    }
}
