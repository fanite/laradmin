import { loggedIn } from "@/lib/helper";

export default function(to, from, next, router) {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!loggedIn()) {
            location.href =
                "/login?redirect=" + encodeURIComponent(to.fullPath);
            throw "正在跳转到登录界面";
        } else {
            next();
        }
    }
    next();
}
