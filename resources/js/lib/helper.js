import Lockr from "./lockr";
import { size, isObject, forIn } from "lodash";
import { Notification } from "element-ui";
import router from "@/routes";
import Qs from "qs";

export function component(path) {
    return () => import(`@/views/${path}`).then(m => m.default || m);
}

export async function storeAuthToken(data) {
    if (isObject(data) && size(data) > 0) {
        forIn(data, function(value, key) {
            Lockr.set(key, value);
        });
    }
}

export function loggedIn() {
    return !!Lockr.get("access_token");
}

export function HttpErrorNotification(title, message) {
    Notification.error({ title, message });
}

export function redirect(path, options) {
    let opt = {};
    if (options) {
        opt.action = options.action || "push";
        if (options.action) {
            //
        }
    }
    router[action]({
        path,
        query: { redirect: router.currentRoute.fullPath }
    });
}

export function setTitle(title) {
    document.title = title ? `${title} | ${admin.name}` : `${admin.name}`;
}
