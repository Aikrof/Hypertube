<template>
	<div class="col-md-10 d-flex justify-content-center mt-10em">
		<div class="row landing_form_cont col-md-6 unselectable">
			<ul class="tab-group col-md-10">
        		<li class="tab" v-bind:class="{active : logActive}" v-on:click="logActive = true"><p>Sign In</p></li>
        		<li class="tab" v-bind:class="{active : !logActive}" v-on:click="logActive = false"><p>Sign Up</p></li>
      		</ul>
      		<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<login-component v-if="logActive"></login-component>
						<register-component v-else></register-component>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 or_cont">
						<p class="or">OR</p>
					</div>
				</div>
				<div class="row">
					<logo-component></logo-component>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	"use strict"
	export default{
		data(){
			return {
				logActive: true,
			}
		},
		methods:{
			activate: function(target){
				
			}
		}
	}
</script>

<style>
.mt-10em{
	margin-top: 5em;
}
.landing_form_cont{
	position: relative;
	background-color: white;
	box-shadow: 5px 5px 5px 5px #000000;
}
.tab-group{
	list-style: none;
	padding: 0;
	margin: 10px 0 0 0;
}
.tab-group:after{
	content: "";
	display: table;
	clear: both;
}
.tab-group li p{
	margin: 0;
  	display: block;
  	text-decoration: none;
  	padding: 15px;
  	background: rgba(160, 179, 176, 0.25);
  	color: #242424;
  	font-size: 20px;
  	font-family: 'Source Sans Pro', sans-serif;
  	float: left;
  	width: 50%;
  	text-align: center;
  	cursor: pointer;
  	transition: .5s ease;
}
.tab-group li p:hover{
  	background: #d02d1d;
  	color: #ffffff;
}
.tab-group .active p{
  	background: #da3e2e;
  	color: #ffffff;
}
.or_cont{
	display: flex;
	justify-content: center;
	position: relative;
	margin-top: 30px;
	border-top: 2px solid #cccc;
}
.or{
	position: absolute;
	top: -16px;
	font-weight: bold;
	font-size: 19px;
	background-color: #FFFFFF;
	padding: 0 8px 0 8px;
}
</style>