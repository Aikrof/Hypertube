<template>
    <div class="container-fluid bg">
        <div class="landing_content">
            <div class="container">
                <auth-component></auth-component>
            </div>
        </div>
    </div>
</template>

<script>
    "use strict";
    export default {
        name: "landing",
        components:{
            'auth-component': require('../components/Auth/AuthComponent.vue').default,
        }
    }
</script>

<style scoped>
    .bg{
        background: url('/img/cover_image.jpeg') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        /*width: 100vw;
        height: 100vh;*/
        margin: 0;
        padding: 0;
        overflow-y: auto;
    }
    .landing_content{
        /*width: 100vw;*/
        min-height: 100vh;
        background-color: rgba(0, 0, 0, 0.6);
    }
    .container{
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
