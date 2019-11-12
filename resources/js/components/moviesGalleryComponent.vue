<template>
    <section class="gallery-block grid-gallery">
        <div class="container">
<!--            <div class="heading">-->
<!--                <h2>Grid Gallery</h2>-->
<!--            </div>-->
            <div class="row">
                <div class="col-md-6 col-lg-4 item zoom-on-hover">
                    <a class="lightbox" href="#">
                        <img class="img-fluid image scale-on-hover"
                             src="">
                        <span class="description">
                                <span class="description-heading">Lorem Ipsum</span>
                                <span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                            </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "moviesGalleryComponent"
    }
</script>

<style scoped>
    .gallery-block.grid-gallery{
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

        .gallery-block.grid-gallery .scale-on-hover:hover{
            transform: scale(1.15);
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.15) !important;
            opacity: 0.7;
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
        .item{
            padding-left: 15px;
            padding-right: 15px;
            margin-left: 0;
            margin-right: 0;
        }
    }
</style>
