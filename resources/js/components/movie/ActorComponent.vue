<template>
    <a class="actor_container"
    :href="'https://www.imdb.com/name/'+ actor.imdb_code +'/'" target="_blank" title="IMDb profile">
        <img class="actor_img" :src="actor.img">
        <p class="actor_name">
            {{actor.name}}
        </p>
    </a>
</template>

<script>
    export default {
        name: "ActorsComponent",
        props: ['actor'],
        data(){
            return {
            }
        },
        methods:{
        },
    };
</script>

<style scoped>
    .actor_container{
        display: inline-flex;
        flex-wrap: wrap;
    }
    .actor_name{
        display: flex;
        align-items: center;
        font-style: italic;
        margin: 0px 5px 0px 5px;
    }
    .actor_img{
        border-radius: 40%;
        width: 40px;
        height: 40px;
    }
</style>
