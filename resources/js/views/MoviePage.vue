<template>
    <div class="index-container">
        <head-component></head-component>
        <h1 style="font-size:300px;">{{id}}</h1>
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
        }
    }
</script>

<style scoped>

</style>
