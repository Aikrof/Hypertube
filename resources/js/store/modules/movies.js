"use strict"

export default {
    state:{
        movies: {},
        movie: {},
    },
    getters:{
        getAllMovies: state => state.movies,
        getMovieById: state => state.movie,
    },
    actions:{
        getAllMovies({commit}){
            if (this.getters.getAllMovies.length)
                return;

            let url = '/api/movie' + window.location.search;
            axios.get(url, Jwt.getHeaders())
                .then(response =>{
                    // console.log(response.data);
                    commit('loadMovies', response.data)
                }).catch(error => {
                    console.log(error);
            });
        },
        getMovieById({commit}, id){
            let movie = this.getters.getMovieById;
            if (movie.movie_id !== undefined && id === movie.movie_id.toString()) {
                return;
            }

            commit('loadMovie', {});

            let url = '/api/movie/' + id;
            axios.get(url, Jwt.getHeaders())
                .then(response =>{
                   // console.log(response.data);
                   commit('loadMovie', response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mutations:{
        loadMovies(state, data){
            state.movies = data;
        },
        loadMovie(state, data){
            state.movie = data;
        }
    }
}
