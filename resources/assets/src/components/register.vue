<script>
	import axios from "axios"
	export default {
		name: 'lumen-auth-register',
		props: ['auth_user'],
		data() {
			return {
				user:{
					display_name: 'Test User',
					user_email: 'test@nowhere.com',
					user_pass: 'test@nowhere.com',
					user_pass_confirmation: 'test@nowhere.com',
				},
				errors: {}
			}
		},
		mounted() {
			console.log('Lumen Auth Register Component Mounted.')
			// let _root = this;
			// if(_root.auth_user && _root.auth_user.user_email){
			// 	_root.redirectHome();
			// }
		},
		methods: {
			submitRegistration(event){
				let _root = this;
				_root.errors = {};
				axios
					.post('/lumen/api/auth/register', _root.user)
					.then(function (response) {
						_root.redirectHome();
						if(typeof(response.data) !== 'undefined'){
							console.log(response.data);
						}
					})
					.catch(function (error) {
						if(typeof(error.response.data) !== 'undefined'){
							_root.errors = error.response.data;
						}else{
							alert('Whoops, the server encountered an error processing the request.  Please try again.');
						}
					});
			},
			redirectHome(){
				window.location.replace("/");
			}
		}
	}
</script>
<style lang="sass">

</style>
<template>
	<div class="vue-component">
		<div v-if="user.ID">
			Welcome, @{{ user.display_name }}
		</div>
		<form v-else class="form-horizontal" v-on:submit.prevent="submitRegistration">
			<div class="control-group" v-bind:class="{ 'has-error': errors.display_name }">
				<label class="control-label" for="display_name">Display Name</label>
				<div class="controls">
					<input type="text" name="display_name" v-model="user.display_name" placeholder="" class="form-control" required>
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.display_name">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
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
				<div class="controls">
					<input type="user_pass" name="user_pass" v-model="user.user_pass" placeholder="" class="form-control">
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.user_pass">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="control-group" v-bind:class="{ 'has-error': errors.user_pass }">
				<label class="control-label"  for="user_pass_confirmation">Password (Confirm)</label>
				<div class="controls">
					<input type="user_pass" name="user_pass_confirmation" v-model="user.user_pass_confirmation" placeholder="" class="form-control">
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.user_pass_confirmation">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="control-group">
				<!-- Button -->
				<div class="controls">
					<button type="submit" id="submitRegistration" class="btn btn-success" data-loading-text="Authenticating...">Register</button>
				</div>
			</div>
		</form>
	</div>
</template>