import Lockr from "./lockr";
import { size, isObject, forIn } from "lodash";
import { Notification } from "element-ui";
import router from "@/routes";
import Qs from "qs";
import crypto from "crypto-browserify";

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

export function encrypt(data) {
    var cipher = crypto.createCipher("aes-256-cbc", admin.secret);
    var enc = cipher.update(data, "utf8", "hex");
    return (enc += cipher.final("hex"));
}

export function decrypt(data) {
    var decipher = crypto.createDecipher("aes-256-cbc", admin.secret);
    var dec = decipher.update(data, "hex", "utf8");
    return (dec += decipher.final("utf8"));
}
