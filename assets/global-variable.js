"use strict";

let keyExistsOn = (o, k) => k.split(".").reduce((a, c) => a.hasOwnProperty(c) ? a[c] || 1 : false, Object.assign({}, o)) !== false;

function getLocalize(key) {
    if (keyExistsOn(localize, key)) {
        return eval("localize." + key);
    }
    return undefined;
}
