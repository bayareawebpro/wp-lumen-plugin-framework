//VUE
import Vue from 'vue'

//Mount
let LumenContainer = document.getElementById("lumen_example");
if(LumenContainer !== null) {
	let LumenExample = new Vue({
		components: {
			'lumen-auth-login': Vue.component('lumen-auth-login', require('./components/login.vue')),
			'lumen-auth-register': Vue.component('lumen-auth-register', require('./components/register.vue')),
		},
		data(){
			return {}
		},
		methods:{}
	}).$mount(LumenContainer)
}