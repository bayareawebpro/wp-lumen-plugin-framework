<script>
import axios from "axios"
export default {
	name: 'lumen-auth-login',
	props: ['auth_user'],
	data: function() {
		return {
			user:{
				user_email: 'test@nowhere.com',
				user_pass: 'test@nowhere.com'
			},
			errors: {}
		}
	},
	mounted: function() {
		let _root = this;

		console.log('Auth Login Component Mounted.');

		if(_root.auth_user && _root.auth_user.user_email){
			_root.redirectHome();
		}
	},
	methods: {
		submitLogin: function(event){
			let _root = this;

			let form = $(event.target);
			let button = $(event.target).find('button[type=submit]').first();
			_root.errors = {};
			axios
				.post('/lumen/api/auth/login', _root.user)
				.then(function (response) {
					_root.redirectHome();
				})
				.catch(function (error) {
					if(error.response && error.response.data){
						_root.errors = error.response.data;
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