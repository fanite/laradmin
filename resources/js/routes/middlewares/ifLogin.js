import { loggedIn } from "@/lib/helper";

export default function(to, from, next) {
    if (to.name === "login" && loggedIn()) {
        next({ name: "index" });
    }
    next();
}
