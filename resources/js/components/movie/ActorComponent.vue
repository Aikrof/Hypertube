<template>
    <div class="actor_container">
        <img class="actor_img" :src="actor.img">
        <p class="pointer actor_name" @mouseover="overImg" @mouseout="outImg">
            {{actor.name}} /
        </p>
    </div>
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
            overImg: function(){
                this.$el.querySelector('img').classList.add('op');
            },
            outImg: function(){
                this.$el.querySelector('img').classList.remove('op');
            }
        }
    };
</script>

<style scoped>
    .actor_container{
        position: relative;
        display: flex;
        justify-content:center;
        align-items: center;
    }
    .actor_name{
        font-style: italic;
        margin: 0px 5px 0px 0px;
    }
    .actor_img{
        border-radius: 50%;
        position: absolute;
        top: -60px;
        display: flex;
        opacity: 0;
    }
    .op{
        opacity: 1;
    }
</style>
