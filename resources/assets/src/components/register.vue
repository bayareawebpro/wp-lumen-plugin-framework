<script>
	import axios from "axios"
	export default {
		name: 'lumen-auth-register',
		props: ['auth_user'],
		data: function() {
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
		mounted: function() {
			console.log('Auth Register Component Mounted.')
			let _root = this;

			if(_root.auth_user && _root.auth_user.user_email){
				_root.redirectHome();
			}
		},
		methods: {
			submitRegistration: function(event){
				let _root = this;
				let form = $(event.target);
				let button = $(event.target).find('button[type=submit]').first();
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
			redirectHome: function(){
				window.location.replace("/");
			}
		}
	}
</script>
<style lang="sass">

</style>
<template>
	<h1> Hello World</h1>
</template>