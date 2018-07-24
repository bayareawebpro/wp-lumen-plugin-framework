<script>
export default {
	name: 'lumen-auth-login',
	props: ['user'],
	data() {
		return {
			form:{
				user_email: '',
				user_pass: ''
			},
			errors: {},
            loading: false,
			account: this.user
		}
	},
    created() {
		console.log('Lumen Auth Login Component Mounted.')
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
		submitLogin(){
			this.errors = {}
			this.loading = true
			this.$http
				.post('/lumen/api/auth/login', this.form)
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
		<div v-if="account">
			<img src="/wp-admin/images/wpspin_light-2x.gif"/> Redirecting...
		</div>
		<form v-else class="form-horizontal" @submit.prevent="submitLogin">
			<div class="control-group" :class="{ 'has-error': errors.user_email }">
				<label class="control-label" for="user_email">E-mail</label>
				<div class="controls">
					<input type="text" name="user_email" id="user_email" v-model="form.user_email" placeholder="you@somewhere.com" class="form-control" autocomplete="email">
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
				<div class="controls" v-model="user">
					<input type="password" name="user_pass" v-model="form.user_pass" placeholder="XXX" class="form-control" autocomplete="password">
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
					<button type="submit" class="btn btn-success" :disabled="loading">Login</button>
					<img src="/wp-admin/images/wpspin_light-2x.gif" v-if="loading"/>
				</div>
			</div>
		</form>
	</div>
</template>