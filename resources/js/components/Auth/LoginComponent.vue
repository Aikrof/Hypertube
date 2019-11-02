<template>
	<form class="form_container" v-on:submit.prevent="submit">
		<div class="form-group">
			<h2 class="text-center">Sign in</h2>
		</div>
  		<div class="form-group">
    		<label for="signIn_login">Login:</label>
    		<input type="text" v-model="login" v-bind:class="{err: errFrame.login}" class="form-control col-md-10" id="signIn_login" placeholder="Login*" autocomplete="off">
            <small class="form-text error">{{errors.login}}</small>
  		</div>
  		<div class="form-group">
    		<label for="signIn_password">Password:</label>
    		<input type="password" v-model="password" v-bind:class="{err: errFrame.password}" class="form-control col-md-10" id="signIn_password" placeholder="Password*">
            <small class="form-text error">{{errors.password}}</small>
  		</div>
  		<div class="form-group">
  			<div class="form-check check_cont">
    			<input type="checkbox" v-model="checked" class="form-check-input form-check" id="check" checked>
    			<label class="form-check-input ch" for="check"></label>
    			<label class="form-check-label" for="check">Remember me</label>
    		</div>
  		</div>
        <div class="form-group">
            <small class="form-text error" v-if="unauthorised">{{"User with this login or password does not exist."}}</small>
        </div>
  		<button type="submit" class="btn btn-primary btn-block col-md-10">Sign in</button>
  	</form>
</template>

<script>
	"use strict"
    let fields = [
        'login', 'password'
    ];
    console.log(Jwt.getToken());
    console.log(Jwt.getRefresh());
	export default{
		data(){
			return {
                errors: {
                    'login': "",
                    'password': "",
                },
                errFrame: {
                    'login': false,
                    'password': false,
                },
				login: "",
				password: "",
				checked: true,
                unauthorised: false,
			}
		},
		methods:{
			submit: function(){
				let data = {
					'login' : this.login,
					'password' : this.password,
					'remember' : this.checked,
				}
				axios.post('/api/oauth/login', data)
					.then(request => {
						Jwt.saveCookie(request.data);
						// window.location.href = '/landing';
					})
					.catch(error => {
                        let err = error.request.response;
                        err = JSON.parse(err).errors;

                        this.unauthorised = false;
                        for (let field of fields){
                            this.errFrame[field] = false;
                            this.errors[field] = "";
                        }

                        if (err !== undefined) {
                            for (let e in err) {
                                this.errFrame[e] = true;
                                let msg = "";
                                for (let i of err[e]) {
                                    msg += ucfirst(i) + '\n';
                                }
                                this.errors[e] = msg;
                            }
                        }
                        else if (error.response.statusText === "Unauthorized")
                            this.unauthorised = true;
					});
			}
		}
	}

    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

</script>

<style>

	#check{
		-moz-appearance: none;
		-webkit-appearance: none;
		-ms-appearance: none;
		appearance: none;
		display: block;
		float: left;
		margin-right: -2em;
		opacity: 0;
		width: 1em;
		z-index: -1;
	}
	input[type="checkbox"] + .ch{
		text-decoration: none;
		cursor: pointer;
		display: inline-block;
		font-size: 1em;
		font-weight: 300;
		padding-left: .7em;
		padding-right: 0.75em;
		position: relative;
		top: -16px;
	}
	input[type="checkbox"] + .ch:before{
		-moz-osx-font-smoothing: grayscale;
		-webkit-font-smoothing: antialiased;
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-transform: none !important;
	}
	input[type="checkbox"] + .ch:before{
		display: flex;
		justify-content: center;
		align-items: center;
		position: absolute;
		border-radius: 4px;
		border: solid 1px;
		content: '';
		left: 0;
		top: 0px;
		width: 1.3em;
		height: 1.3em;
	}
	input[type="checkbox"]:checked + .ch:before{
		color: green;
		content: '\f00c';
	}
	input[type="checkbox"] + .ch:before{
		border-radius: 4px;
	}
	label{
		cursor: pointer;
		font-weight: bold;
		margin: 0;
	}
	.form_container{
		padding: 10px 30px 0 30px;
	}
</style>
