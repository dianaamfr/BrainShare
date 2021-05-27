import {listenAddCategory, listenDeleteCategory, listenSearchCategory, listenPageCategory} from "./category.js"
import {getParameterByName} from "../common.js";

let InputDiv = document.getElementById("input-category");
let searchDiv = InputDiv.querySelectorAll("div")[1];
const url = "/admin/courses";

let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));

listenPageCategory(url);
listenSearchCategory(url, searchDiv);
listenDeleteCategory(url, modal);
listenAddCategory(url);

const searchValue = getParameterByName("search-name", window.location.href);
if (searchValue !== null && searchValue !== "")
    searchDiv.querySelector("input").value = searchValue;
