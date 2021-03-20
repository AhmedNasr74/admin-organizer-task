require('./bootstrap');

window.Vue = require("vue");
import router from './router';
import App from "./App.vue";

window.Vue = require('vue');
process.env.VUE_APP_API_URL = 'http://127.0.0.1:8000/api/'
const app = new Vue({
    router: router,
    render: (h) => h(App),

}).$mount("#app");
