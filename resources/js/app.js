import Vue from "vue";
import App from "./App.vue";
import router from "./routes";
import Axios from "./lib/axios";
import ElementUI from "element-ui";

Vue.use(ElementUI, { size: "small", zIndex: 3000 });

Vue.prototype.$http = Axios;

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
