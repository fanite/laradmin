import { loggedIn } from "@/lib/helper";

export default function(to, from, next) {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!loggedIn()) {
            next({
                name: "login",
                query: { redirect: router.options.base + to.fullPath }
            });
            next();
        } else {
            next();
        }
    }
    next();
}
