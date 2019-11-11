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
            axios.get('/api/movies', Jwt.getHeaders())
                .then(response =>{
                    console.log(response.data);
                }).catch(error => {
                    console.log(error);
            });
            commit('loadMovies', 123);
        }
    },
    mutations:{
        loadMovies(state, data){
            state.movies = data;
        },
    }
}
