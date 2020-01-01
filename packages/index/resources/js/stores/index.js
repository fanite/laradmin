import Vue from "vue";
import Vuex from "vuex";
import createLogger from "vuex/dist/logger";

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

const modules = {};

const files = require.context("./modules", true, /\.js$/i);
files.keys().map(key => {
    const moduleName = key
        .split("/")
        .pop()
        .split(".")[0];
    modules[moduleName] = files(key).default;
});

const store = new Vuex.Store({
    namespaced: true,
    modules,
    strict: debug,
    plugins: debug ? [createLogger()] : []
});

export default store;
