import {getToken, sendDataAjaxRequest} from "../common.js";
import {handleCategoryResponse, eventDelete, eventSearch, updateCategoryPagination} from "./category.js"

let tagInputDiv = document.getElementById("input-category");
let addTagButton = tagInputDiv.querySelector("button");
let addTagInput = tagInputDiv.querySelector("input");
let searchDiv = tagInputDiv.querySelectorAll("div")[1];


updateCategoryPagination();
eventSearch("/api/admin/tag", searchDiv);
eventDelete();
addTagButton.addEventListener("click", () => {
    sendDataAjaxRequest("post", "/api/admin/tag/add" , {'input': addTagInput.value}, getToken() , handleCategoryResponse);
});


// TODO: search.
// TODO: pagination without loading.

