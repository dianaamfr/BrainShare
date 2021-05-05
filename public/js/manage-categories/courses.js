import {sendDataAjaxRequest} from "../common.js";
import {addCategoryToHTML, updateShowingMessage, canAddHTML} from "./postCategory.js";

// TODO: fix to accept the course.
let addCourseDiv = document.getElementById("manage-add-course");
let addCourseButton = addCourseDiv.querySelector("button");
let addCourseInput = addCourseDiv.querySelector("input");
let token = document.querySelector("meta[name='csrf-token']").getAttribute('content');

addCourseButton.addEventListener("click", () => {
    sendDataAjaxRequest("post", "/api/admin/course/add" , {'input': addCourseInput.value}, token, handleResponse);
});

function handleResponse(json){
    if (json.hasOwnProperty('exception')){
        // Add toast with the error
    }else{
        if (canAddHTML()) addCategoryToHTML(json);
        updateShowingMessage();
    }
}


