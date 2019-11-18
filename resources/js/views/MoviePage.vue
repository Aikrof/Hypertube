<template>
    <div class="index-container" style="background-color:white;">
        <head-component></head-component>

        <div class="container pt-100">
            <div class="row">
                <div class="poster_container">
                    <img :src="movie.poster" class="pointer movie_poster unselectable">
                    <!-- <ul>
                        <torrent-component></torrent-component>
                    </ul> -->
                </div>
                <div class="container-fluid movie_data_container">
                    <div class="col-md-12">
                        <h1 class="movie_title">
                            {{movie.title}}
                        </h1>
                        <h4 class="movie_year">
                            {{movie.year}}
                            <br>
                            {{movie.genres}}.
                        </h4>
                        <a href="#" class="unselectable">
                            <img class="imdb" src="/img/icons/imdb.png">
                            <h4 class="movie_rating">
                                {{movie.rating}} / 10
                            </h4>
                            <i class="fa fa-star rating_star"></i>
                        </a>
                        <p>
                            {{movie.description}}
                        </p>
                        <div class="col-md-12 actors_container">
                            <actor-component v-for="actor in movie.actors" :actor="actor" :key="actor.name"></actor-component>
                        </div>
                        <div class="col-md-12 screenshots_container unselectable pointer">
                            <screenshot-component v-for="screen in movie.screenshots" :screen="screen" :key='screen'></screenshot-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="height:20px;background-color:black"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Movies",
        props:{
            id:{
                required: true
            },
        },
        data(){
            return {
            }
        },
        mounted(){
            this.$store.dispatch('getMovieById', this.id);
        },
        computed:{
            movie() {
                return this.$store.getters.getMovieById;
            }
        },
        components:{
            'head-component': require('../components/HeadComponent.vue').default,
            'actor-component': require('../components/movie/ActorComponent.vue').default,
            'screenshot-component': require('../components/movie/ScreenshotComponent').default,
            'torrent-component': require('../components/movie/TorrentsComponent').default,
        }
    };
</script>

<style scoped>
    .row{
        flex-wrap: nowrap;
    }
    .pt-100{
        padding-top: 100px;
    }
    .poster_container{
        display: flex;
        flex-direction: column;
        padding-right: 15px;
    }
    ul{
        padding: 0;
    }
    .movie_poster{
        width: 240px;
        height: 355px;
    }
    .movie_title{
        font-size: 36px;
        font-weight: bold;
    }
    .movie_year{
        font-weight: bold;
        font-size: 20px;
    }
    .movie_rating{
        text-decoration: none;
        font-size: 20px;
        font-weight: bold;
        display: inline-flex;
        justify-content: flex-start;
        align-items: center;
    }
    .rating_star::before{
        margin-left: 5px;
        font-size: 22px;
    }
    .imdb{
        border-radius: 5px;
        width: 50px;
        height: 24px;
        margin-bottom: 6px;
        padding-right: 5px;
    }
    a{
        text-decoration: none;
        color: black;
    }
    a:hover .rating_star{
        color: green;
    }
    .movie_data_container{
        display: flex;
        /*justify-content: space-between;*/
    }
    .actors_container{
        display:flex;
        padding: 0;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .screenshots_container{
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    @media screen and (max-width: 991px){
        .container{
            margin-left: 15px;
            max-width: 98%;
        }
        .container-fluid {
            padding-right: 0px;
        }
    }
</style>
