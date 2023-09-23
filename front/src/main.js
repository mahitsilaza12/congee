import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
// import store from './store'
import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.js'
import "font-awesome/css/font-awesome.min.css";
import { VueRecaptcha } from 'vue-recaptcha';
import vue3GoogleLogin from 'vue3-google-login'
import VeeValidate from 'vee-validate';
let clientKey = '280966500148-pc9n5i292qifkrlob5a0brhv3dfadimh.apps.googleusercontent.com'


createApp(App).use(router).use(bootstrap).use(vue3GoogleLogin, {clientId: clientKey}).use(VueRecaptcha).component('VueFontawesome', require('vue-fontawesome-icon/VueFontawesome.vue').default).mount('#app')
