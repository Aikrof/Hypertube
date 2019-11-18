<template>
    <section class="gallery-block grid-gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-lg-2 item zoom-on-hover"
                     v-for="movie in movies">
                    <router-link class="lightbox"
                                 :to="/movie/ + movie.movie_id">
                        <img class="img-fluid image scale-on-hover"
                             :src="movie.poster">
                        <span class="description">
                            <span class="description-heading">
                                {{movie.title}}
                                <br>
                                ({{movie.year}})
                            </span>
                            <span class="description-genres">
                                {{movie.genres}}
                            </span>
                            <span class="description-body">
                                {{movie.description}}
                            </span>
                        </span>
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        mounted(){
            this.$store.dispatch('getAllMovies');
        },
        computed:{
            movies(){
                return this.$store.getters.getAllMovies;
            }
        }
    }
</script>

<style scoped>
    .gallery-block.grid-gallery{
        margin-top: 40px;
        padding-bottom: 60px;
        padding-top: 60px;
    }

    .gallery-block.grid-gallery .heading{
        margin-bottom: 50px;
        text-align: center;
    }

    .gallery-block.grid-gallery .heading h2{
        font-weight: bold;
        font-size: 1.4rem;
        text-transform: uppercase;
    }
    .item{
        background-color: black;
        overflow: hidden;
        opacity: 1;
        padding-left: 0;
        padding-right: 0;
        margin-left: 15px;
        margin-right: 15px;
    }
    .description{
        display: grid;
        position: absolute;
        bottom: 0;
        left: 0;
        color: #fff;
        padding: 0px;
        font-size: 17px;
        line-height: 18px;
        width: 100%;
        padding-top: 15px;
        padding-bottom: 20px;
        opacity: 1;
        color: #fff;
        transition: 0.8s ease;
        text-align: center;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
        background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.39));
    }

    .item .description .description-heading{
        font-size: 1em;
        font-weight: bold;
    }
    .item .description .description-genres{
        margin-top: 10px;
        font-weight: bold;
        font-size: 0.8em;
    }
    .item .description .description-body{
        font-size: 0.8em;
        margin-top: 10px;
        font-weight: 300;
    }

    .gallery-block .row .item a:hover .description {
        opacity: 1;
    }

    .gallery-block .item img{
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
        transition: 0.4s;
    }

    .gallery-block.grid-gallery .item{
        margin-bottom: 20px;
    }

    @media (min-width: 576px) {
        .item:hover img{
            transform: scale(1.15);
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.15) !important;
            opacity: 0.6;
        }
        .gallery-block .item .description {
            opacity: 0;
        }
        .gallery-block .item a:hover .description {
            opacity: 1;
        }
        .description{
            margin-bottom: -10px;
        }
    }
</style>
