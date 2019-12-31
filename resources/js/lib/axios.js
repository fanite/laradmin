import Axios from "axios";
import Lockr from "./lockr";
import Qs from "qs";
import { HttpErrorNotification } from "./helper";
import router from "@/routes";
import store from "@/stores";

function switchLoading(status) {
    store.commit("admin/switchLoading", status);
}

function ifRedirect(respone) {
    if (respone && respone.data && respone.data.redirect) {
        window.location = respone.data.redirect;
    }
}

Axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const instance = Axios.create({
    baseURL: "/api",
    timeout: 5000,
    paramsSerializer: params => Qs.stringify(params)
});

// 添加请求拦截器
instance.interceptors.request.use(
    function(config) {
        switchLoading(true);
        const accessToken = Lockr.get("access_token");
        if (accessToken) {
            const tokenType = Lockr.get("token_type");
            config.headers.Authorization = `${tokenType} ${accessToken}`;
        }
        return config;
    },
    function(error) {
        switchLoading(false);
        return Promise.reject(error);
    }
);

// 添加响应拦截器
instance.interceptors.response.use(
    function(response) {
        switchLoading(false);
        return response;
    },
    function(error) {
        const resp = error.response;

        ifRedirect(resp);

        if (resp) {
            HttpErrorNotification(resp.status, resp.data.message);
            if (resp.status === 401) {
                router.replace("login");
            }
        } else {
            HttpErrorNotification("😅", error.message);
        }

        switchLoading(false);
        return Promise.reject(error);
    }
);

export default instance;
