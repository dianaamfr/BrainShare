// See how this works: https://stackoverflow.com/questions/822452/strip-html-from-text-javascript

/**
 * To remove the md it's necessary to have the item needs to have the classes md-content and md-remove.
 * The content must be envolved in a div.
 * Example:
 * <div class="md-content md-remove"> </div>
 */

import convertMD from "./parseMD.js";

export function mdRemove(){
    try {
        convertMD("md-remove");
        let remove_md_list = document.querySelectorAll(".md-remove");
    
        remove_md_list.forEach((element) => {
            element.innerHTML = stripHtml(element.innerHTML);
        });
    } catch (e) {
        console.warn("No md to remove");
    }
}

function stripHtml(html) {
    let tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}

mdRemove();