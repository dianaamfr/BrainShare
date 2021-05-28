"use strict";

function offsetAnchor() {
    if(location.hash.length !== 0) {
        window.scrollTo(window.scrollX, window.scrollY - 75);
    }
}

window.addEventListener("hashchange", offsetAnchor);
window.setTimeout(offsetAnchor, 0);