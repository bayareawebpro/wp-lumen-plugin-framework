<script>
import axios from "axios"
export default {
	name: 'lumen-auth-login',
	props: ['auth_user'],
	data() {
		return {
			user:{
				user_email: 'test@nowhere.com',
				user_pass: 'test@nowhere.com'
			},
			errors: {}
		}
	},
	mounted() {
		console.log('Lumen Auth Login Component Mounted.')
	},
	methods: {
		submitLogin(event){
			this.errors = {}
			axios
				.post('/lumen/api/auth/login', this.user)
				.then((response) => {
                    this.redirectHome()
				})
				.catch((error)  => {
					if(error.response && error.response.data){
                        this.errors = error.response.data
					}
				})
		},
		redirectHome(){
			window.location.replace("/")
		}
	}
}
</script>
<style lang="sass">
</style>
<template>
	<div class="vue-component">
		<div v-if="user.ID">
			Welcome back, {{ user.display_name }}
		</div>
		<form v-else class="form-horizontal" v-on:submit.prevent="submitLogin">
			<div class="control-group" v-bind:class="{ 'has-error': errors.user_email }">
				<label class="control-label" for="user_email">E-mail</label>
				<div class="controls">
					<input type="text" name="user_email" v-model="user.user_email" placeholder="" class="form-control">
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.user_email">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="control-group" v-bind:class="{ 'has-error': errors.user_pass }">
				<label class="control-label" for="user_pass">Password</label>
				<div class="controls" v-model="user">
					<input type="password" name="user_pass" v-model="user.user_pass" placeholder="" class="form-control">
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.user_pass">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-success" data-loading-text="Authenticating...">Login</button>
				</div>
			</div>
		</form>
	</div>
</template>