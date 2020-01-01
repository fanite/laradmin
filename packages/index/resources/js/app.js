import Vue from "vue";
import App from "./App.vue";
import router from "./routes";
import Axios from "./lib/axios";
import ElementUI from "element-ui";
import store from "@/stores";

Vue.use(ElementUI, { size: "small", zIndex: 3000 });

Vue.prototype.$http = Axios;

Vue.config.productionTip = false;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app");
