<template>
	<div class="col-md-12 logo_cont unselectable">
        <a href="/api/social/intra" class="col-md-9 logo_42 a_logo">
          		<img src="img/logo/42_logo.svg" class="wh-40" alt="Intra" title="Intra">
          		<p class="logo-text">Intra</p>
        </a>
        <a href="/api/social/github" class="col-md-9 logo_github a_logo">
        	<img src="img/logo/github.png" class="wh-45">
        	<p class="logo-text">GitHub</p>
        </a>
        <a href="/api/social/linkedin" class="col-md-9 a_logo logo_linkedin">
            <img src="img/logo/linkedin.png" class="wh-45">
            <p class="logo-text">Linkedin</p>
        </a>
	</div>
</template>

<script>
	"use strict"
	export default{
		data(){
		    return {}
		},
		methods:{}
	}
</script>

<style scoped>
.logo_cont{
	display: flex;
	flex-direction: column;
	align-items: center;
	margin: 20px 0 20px 0;
}
.logo_cont > a{
	display: flex;
	justify-content: flex-start;
	align-items: center;
	height: 50px;
	border-radius: 10px;
	text-decoration: none;
    margin-bottom: 10px;
}
.logo_cont > a{
	cursor: pointer;
}
.logo-text{
	width: calc(100% - 40px);
	font-size: 26px;
	font-weight: bold;
	margin: 0 0 5px 0;
	text-align: center;
	color: #FFFFFFFF;

}
.a_logo{
    flex: 0 0 0;
    height: 45px;
}
.wh-40{
	width: 40px;
	height: 40px;
}
.wh-45{
    width: 45px;
    height: 45px;
}
.logo_42{
    background-color: #3b5998;
}
.logo_42:hover{
    background-color: #083769;
}
.logo_github{
    align-items: flex-start;
    background-color: #1d2124;
}
.logo_github:hover{
    background-color: black;
}
.logo_linkedin{
    background-color: #0077b7;
}
.logo_linkedin:hover{
    background-color: #1162B7;
}
</style>
