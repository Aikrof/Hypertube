<template>
	<div class="col-md-12 logo_cont">
        <input type="hidden" name="hide">
		<div class="logo_black logo_42">
            <a href="/api/social/intra">
			    <img src="img/logo/42_logo.svg" class="wh-40" alt="Intra" title="Intra">
            </a>
        </div>
		<div>
<!--            <a href="/api/social/github">-->
			    <img  v-bind:src="git_logo" @mouseover="color('github')" @mouseleave="mono('github')"class="wh-50 github_logo" alt="Github" title="Github">
<!--            </a>-->
        </div>
		<div class="mr-20">
            <a href="/api/social/linkedin">
                <img v-bind:src="link_logo" @mouseover="color('linkedin')" @mouseleave="mono('linkedin')" class="wh-50 link_logo" alt="Linkedin" title="Linkedin">
            </a>
        </div>
        <button v-on:click="submit">test</button>
	</div>
</template>

<script>
	"use strict"
	let github = {
		'git_mono' : "img/logo/github_logo.svg",
		'git_color' : "img/logo/github.png"
	};
	let linkedin = {
		'link_mono' : "img/logo/linkedin_logo.svg",
		'link_color' : "img/logo/linkedin.svg"
	};
	export default{
		data(){
			return {
				git_logo: github.git_mono,
				link_logo: linkedin.link_mono,
			}
		},
		methods:{
			color: function(target){
				if (target === 'github')
					this.git_logo = github.git_color;
				else if (target === 'linkedin')
					this.link_logo = linkedin.link_color;
			},
			mono: function(target){
				if (target === 'github')
					this.git_logo = github.git_mono;
				else if (target === 'linkedin')
					this.link_logo = linkedin.link_mono;
			},
            submit:function(){
                axios.get('/api/a')
                    .then(request => {
                        console.log(request.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
		}
	}
</script>

<style>
.logo_cont{
	display: flex;
	justify-content: space-around;
	margin: 30px 0 30px 0;
}
.logo_cont > div{
	display: flex;
	justify-content: center;
	align-items: center;
	width: 50px;
	height: 50px;
	border-radius: 10px;
}
.logo_cont > div{
	cursor: pointer;
}
.logo{
	width: 40px;
	height: 40px;
}
.logo_black{
	background-color: black;
}
.logo_42:hover{
	background-color: #0077b7;
}
.wh-40{
	width: 40px;
	height: 40px;
}
.wh-50{
	width: 50px;
	height: 50px;
}
.github_logo:hover{
	background-color: black;
}
.br-10{
	border-radius: 10px;
}
</style>
