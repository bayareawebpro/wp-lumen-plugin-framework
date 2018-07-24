<script>
export default {
	name: 'lumen-auth-register',
	props: ['user'],
	data() {
		const noise = Math.random().toString(36).substr(2, 5)
		return {
			form:{
				display_name: `Test User: ${noise}`,
				user_email: `${noise}@nowhere.com`,
				user_pass: `${noise}@nowhere.com`,
				user_pass_confirmation: `${noise}@nowhere.com`,
			},
			errors: {},
			message: null,
			account: this.user,
		}
	},
	created() {
		console.log('Lumen Auth Register Component Mounted.')
		if(this.account){
			this.redirect()
		}
	},
	methods: {
		serverError(){
			alert('Whoops, the server encountered an error processing the request.  Please try again.')
		},
		redirect(){
			window.location.replace("/")
		},
		submitRegistration(){
			this.errors = {}
			this.loading = true
			this.$http
				.post('/lumen/api/auth/register', this.form)
				.then((response) => {
					this.loading = false
					if(typeof(response.data) !== 'undefined'){
						this.account = response.data.user
						this.redirect()
					}else{
						console.info(response)
						this.serverError()
					}
				})
				.catch((error)  => {
					this.loading = false
					if(typeof(error.response.data) !== 'undefined'){
						this.errors = error.response.data
					}else{
						console.error(error)
						this.serverError()
					}
				})
		}
	}
}
</script>
<style lang="sass" scoped>
@import '../sass/forms'
</style>
<template>
	<div class="vue-component">
		<div v-if="message">
			{{ message }}
		</div>
		<div v-if="account">
			<img src="/wp-admin/images/wpspin_light-2x.gif"/> Redirecting...
		</div>
		<form v-else class="form-horizontal" @submit.prevent="submitRegistration">
			<div class="control-group" :class="{ 'has-error': errors.display_name }">
				<label class="control-label" for="display_name">Display Name</label>
				<div class="controls">
					<input type="text" name="display_name" id="display_name" v-model="form.display_name" placeholder="" class="form-control" required>
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.display_name">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="control-group" :class="{ 'has-error': errors.user_email }">
				<label class="control-label" for="user_email">E-mail</label>
				<div class="controls">
					<input
							type="text"
							id="user_email"
							name="user_email"
							class="form-control"
							v-model="form.user_email"
							placeholder=""
					/>
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.user_email">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="control-group" :class="{ 'has-error': errors.user_pass }">
				<label class="control-label" for="user_pass">Password</label>
				<div class="controls">
					<input type="user_pass" id="user_pass" name="user_pass" v-model="form.user_pass" placeholder="" class="form-control">
					<div class="help-block" v-if="errors">
						<ul class="list-unstyled">
							<li v-for="error in errors.user_pass">
								{{error}}
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="control-group" :class="{ 'has-error': errors.user_pass }">
				<label class="control-label" for="user_pass_confirmation">Password (Confirm)</label>
				<div class="controls">
					<input type="user_pass" id="user_pass_confirmation" name="user_pass_confirmation" v-model="form.user_pass_confirmation" placeholder="" class="form-control">
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
				<div class="controls">
					<button type="submit" class="btn btn-success" :disabled="loading">Login</button>
					<img src="/wp-admin/images/wpspin_light-2x.gif" v-if="loading"/>
				</div>
			</div>
		</form>
	</div>
</template>