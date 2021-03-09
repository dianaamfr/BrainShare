https://stackoverflow.com/questions/822452/strip-html-from-text-javascript 

/**
 * To remove the md it's necessary to have the item needs to have the classes md-content and md-remove. 
 */

let remove_md_list = document.querySelector(".md-remove .md-content "); 

remove_md_list.forEach((element) => {
    element.innerHTML = stripHtml(element.innerHTML); 
}); 


function stripHtml(html) {
   let tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}