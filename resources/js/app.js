import Vue from 'vue';
import App from './App.vue';
import router from './router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap';

import BootstrapVue from 'bootstrap-vue';
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(BootstrapVue);
Vue.use(FlashMessage);
Vue.use(VueAxios, axios);

new Vue({
    el: '#app',
    router,
    render: main => main(App)
});