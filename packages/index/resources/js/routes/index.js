import Vue from "vue";
import { component, setTitle, loggedIn } from "@/lib/helper";
import Layout from "@/views/layouts/Layout.vue";
import VueRouter from "vue-router";
import requireAuthenticated from "./middlewares/requireAuthenticated";
import ifLogin from "./middlewares/ifLogin";

Vue.use(VueRouter);

const routes = [
    {
        path: "/login",
        name: "login",
        component: component("users/Login.vue"),
        beforeEnter: ifLogin,
        meta: {
            title: "欢迎登陆"
        }
    },
    {
        path: "/register",
        name: "register",
        component: component("users/Register.vue"),
        meta: {
            title: "用户注册"
        }
    },
    {
        path: "/reset-password",
        name: "forgot password",
        component: component("users/ResetPassword.vue"),
        meta: {
            title: "重置密码"
        }
    },
    {
        path: "/admin",
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
            },
            {
                path: "dashboard",
                name: "dashboard",
                component: component("Dashboard.vue"),
                meta: {
                    title: "仪表盘"
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
    requireAuthenticated(to, from, next);
});

router.afterEach((to, from) => {
    setTitle(to.meta.title);
});

export default router;
