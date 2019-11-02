<template>
	<form class="form_container" v-on:submit.prevent="submit">
		<div class="form-group">
			<h2 class="text-center">Sign up</h2>
		</div>
  		<div class="form-group">
    		<label for="signUp_login">Login:</label>
    		<input type="text" v-model="login" v-bind:class="{err: errFrame.login}" class="form-control col-md-10" id="signUp_login" placeholder="Login*" autocomplete="off">
            <small class="form-text error">{{errors.login}}</small>
        </div>
  		<div class="form-group">
    		<label for="signUp_email">Email:</label>
    		<input type="text" v-model="email" v-bind:class="{err: errFrame.email}" class="form-control col-md-10" id="signUp_email" placeholder="Email*" autocomplete="off">
            <small class="form-text error">{{errors.email}}</small>
        </div>
  		<div class="form-group">
    		<label for="signUp_password">Password:</label>
    		<input type="password" v-model="password" v-bind:class="{err: errFrame.password}" class="form-control col-md-10" id="signUp_password" placeholder="Password*">
            <small class="form-text error">{{errors.password}}</small>
        </div>
  		<div class="form-group">
  			<label for="signUp_confirm">Confirm:</label>
    		<input type="password" v-model="confirm" v-bind:class="{err: errFrame.confirm}" class="form-control col-md-10" id="signUp_confirm" placeholder="Confirm*">
            <small class="form-text error">{{errors.confirm}}</small>
        </div>
  		<button type="submit" class="btn btn-primary btn-block col-md-10">Sign up</button>
  	</form>
</template>

<script>
	"use strict"
    let fields = [
        'login', 'email', 'password', 'confirm'
    ];
    export default{
		data(){
			return{
			    errors: {
			        'login': "",
                    'email': "",
                    'password': "",
                    'confirm': "",
                },
                errFrame: {
                    'login': false,
                    'email': false,
                    'password': false,
                    'confirm': false,
                },
				login: "",
				email: "",
				password: "",
				confirm: "",
			}
		},

		methods:{
			submit: function(){
				let data = {
					'login' : this.login,
					'email' : this.email,
					'password' : this.password,
					'confirm' : this.confirm,
				};
				axios.post('/api/oauth/register', data)
				.then((request) => {
                    Jwt.saveCookie(request.data);
                    window.location.href = '/';
				}).catch((error) => {
					let err = error.request.response;
					err = JSON.parse(err).errors;

					for (let field of fields){
					    this.errFrame[field] = false;
					    this.errors[field] = "";
                    }

					for (let e in err){
					    this.errFrame[e] = true;
					    let msg = "";
					    for (let i of err[e]){
					        msg += ucfirst(i) + '\n';
                        }
					    this.errors[e] = msg;
                    }
				});
			}
		}
	}

    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

</script>
<style>
    .error{
        color: red;
        font-weight: bold;
    }
    .err{
        border: 2px solid red;
    }
</style>
