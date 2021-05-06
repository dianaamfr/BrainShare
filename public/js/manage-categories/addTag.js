import {getToken, sendDataAjaxRequest} from "../common.js";
import {addCategoryToHTML, updateShowingMessage, canAddHTML} from "./addCategory.js";

let addTagDiv = document.getElementById("manage-add-tag");
let addTagButton = addTagDiv.querySelector("button");
let addTagInput = addTagDiv.querySelector("input");
let token = getToken();

addTagButton.addEventListener("click", () => {
    sendDataAjaxRequest("post", "/api/admin/tag/add" , {'input': addTagInput.value}, token, handleResponse);
});

function handleResponse(json){
    if (json.hasOwnProperty('exception')){
        // Add toast with the error
    }else{
       if (canAddHTML()) addCategoryToHTML(json);
       updateShowingMessage();
    }
}




