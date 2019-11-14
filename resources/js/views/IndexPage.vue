<template>
    <div class="index-container">
        <head-component></head-component>
        <movie-component></movie-component>
    </div>
</template>

<script>
    "use strict"
    export default {
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
        components:{
            'head-component': require('../components/HeadComponent.vue').default,
            'movie-component': require('../components/moviesGalleryComponent.vue').default,
        }
    }
</script>

<style scoped>

</style>
