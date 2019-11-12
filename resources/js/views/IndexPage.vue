<template>
    <div class="index-container">
        <head-component></head-component>
        <movieGallery-component></movieGallery-component>
    </div>
</template>

<script>
    "use strict"
    export default {
        beforeCreate(){
            this.$store.dispatch('getAllMovies');
        },
        data(){
            return {
            }
        },
        methods:{
            //тест доступ к мутациям в Vuex
            // click(){
            //     this.$store.commit('asd', 'asddfssdf');
            // }
        },
        computed: {
            movies(){
                return this.$store.getters.getAllMovies;
            }
        },
        components:{
            'head-component': require('../components/HeadComponent.vue').default,
            'movieGallery-component': require('../components/moviesGalleryComponent.vue').default,
        }
    }
</script>

<style scoped>

</style>
