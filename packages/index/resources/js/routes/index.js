import Vue from "vue";
import { component, setTitle } from "@/lib/helper";
import Layout from "@/views/layouts/Layout.vue";
import VueRouter from "vue-router";
import requireAuthenticated from "./middlewares/requireAuthenticated";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: Layout,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: "",
                name: "index",
                component: component("Index.vue"),
                meta: {
                    title: "首页"
                }
            }
        ]
    },
    {
        path: "*",
        name: "not found",
        component: component("layouts/NotFound.vue"),
        meta: {
            title: "Not Found"
        }
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

router.beforeEach((to, from, next) => {
    requireAuthenticated(to, from, next, router);
});

router.afterEach((to, from) => {
    setTitle(to.meta.title);
});

export default router;
