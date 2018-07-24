//VUE
import Vue from 'vue'
import axios from 'axios'
Vue.prototype.$http = axios.create({
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    }
});
//Mount
let LumenContainer = document.getElementById("vue_wrapper");
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