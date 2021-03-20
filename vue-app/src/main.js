import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
Vue.config.productionTip = false;

axios.defaults.headers.common = {
  Accept: "application/json",
};

new Vue({
  store,
  router,
  render: (h) => h(App),
}).$mount("#app");
