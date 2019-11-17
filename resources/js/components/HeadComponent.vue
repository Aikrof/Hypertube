<template>
    <nav class="navbar navbar-expand-md navbar-light fixed-top unselectable">
        <router-link to="/"><img src="/img/logo/Hypertube.png"></router-link>
        <button type="button" class="navbar-toggler bg-light" data-toggle="collapse" data-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="nav">
            <ul class="navbar-nav">
                <li class="nav-item" >
                    <a class="nav-link text-light font-weight-bold px-3" href="#">HOME</a>
                </li>
                <li class="nav-item dropdown" data-toggle="dropdown">
                    <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#">CATEGORIES</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Fast Food</a>
                    <a class="dropdown-item" href="#">Lunch</a>
                    <a class="dropdown-item" href="#">Dessert</a>
                </div>
                </li>
                    <li class="nav-item">
                        <a class="nav-link text-light font-weight-bold px-3" href="#">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold px-3" href="#">CONTACT</a>
                </li>
            </ul>
            <form class="form-inline">
                <div class="input-group">
                    <input class="form-control search_inp" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="fa fa-search"></i> Search
                    </button>
                </div>
            </form>
            <div class="user_container mr-5">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" data-toggle="dropdown">
                    <p class="text-light font-weight-bold mr-0 nav-link dropdown-toggle pointer">{{user.login}}</p>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="user_dropdawn">
                        <img :src="user.icon" class="pointer user_icon">
                        <p class="font-weight-bold mr-0 dropdown-item mt-8">
                            {{user.email}}
                        </p>
                        <p @click="logout" class="font-weight-bold mr-0 dropdown-item pointer">
                            Logout
                        </p>
                    </div>
                </div>
                </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    "use strict"
    export default {
        data(){
            return {
            }
        },
        mounted(){
            this.$store.dispatch('getUserData');
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            }
        },
        methods:{
            logout: function(){
                axios.post('/api/oauth/logout', "", Jwt.getHeaders());
                Jwt.unsetToken();
                window.location.href = '/landing';
            }
        }
    }
</script>

<style scoped>
.navbar{
    position: fixed;
    background-color: #281f55;
}
.search_inp{
    margin-right: 5px;
    border-radius: 5px !important;
}
.mr-0{
    margin: 0;
}
.pointer{
    cursor: pointer;
}
.user_icon{
    width: 220px;
    height: 250px;
    border-radius: 5px;
}
.dropdown-menu-right{
    right: -3rem;
}
.user_dropdawn{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 8px 0 8px;
    min-width: 220px;
}
.user_dropdawn > p:hover{
    background-color: #695E771A;
}
.user_dropdawn > p:active{
    background-color: #0069d9;
    border-radius: 5px;
}
.mt-8{
    margin-top: 8px;
}
</style>
