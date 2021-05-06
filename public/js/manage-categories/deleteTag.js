import {sendDataAjaxRequest, getToken} from "../common.js";
import {getCategoryName} from "./deleteCategory.js";

const deleteButtons = document.querySelectorAll('.icon-hover');
const token = getToken();
deleteButtons.forEach(element => eventDelete(element));

function eventDelete(element) {
    element.addEventListener("click", () => {
            sendDataAjaxRequest("delete", "/api/admin/tag/delete", {
                input: getCategoryName(element, deleteButtons),
            }, token, handleResponse)
        }
    );
}

function handleResponse(json) {
    console.log(json);
}
