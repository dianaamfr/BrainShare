import {listenAddCategory, listenDeleteCategory, listenSearchCategory, listenPageCategory} from "./category.js"

let InputDiv = document.getElementById("input-category");
let searchDiv = InputDiv.querySelectorAll("div")[1];
const url = "/admin/tags";

listenPageCategory( url);
listenSearchCategory(url, searchDiv);
listenDeleteCategory(url);
listenAddCategory(url);
