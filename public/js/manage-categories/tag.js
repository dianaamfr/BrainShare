import {getToken, sendDataAjaxRequest} from "../common.js";
import {handleCategoryResponse, listenDeleteCategory, listenSearchCategory, listenPageCategory} from "./category.js"

let tagInputDiv = document.getElementById("input-category");
let addTagButton = tagInputDiv.querySelector("button");
let addTagInput = tagInputDiv.querySelector("input");
let searchDiv = tagInputDiv.querySelectorAll("div")[1];


listenPageCategory( "/admin/categories/tags");
listenSearchCategory("/admin/categories/tags", searchDiv);
listenDeleteCategory("/admin/categories/tags");

addTagButton.addEventListener("click", () => {
    sendDataAjaxRequest("post", "/api/admin/categories/tags/add" , {'input': addTagInput.value}, getToken() , handleCategoryResponse);
});


// TODO: search.
// TODO: pagination without loading.

