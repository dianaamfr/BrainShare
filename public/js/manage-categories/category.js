import {getToken, sendAjaxGetRequest, sendDataAjaxRequest} from "../common.js";

export function handleCategoryResponse(responseJson) {
    if (responseJson.hasOwnProperty('error')) {
        console.log(responseJson['success'], 'error');
        return;
    } else {
        console.log(responseJson['success'], 'success');
    }

    changeCategoryPage();
    updateCategoryPagination();
    eventDelete();
}


export function handleCategoryGet() {
    const response = JSON.parse(this.responseText);
    document.querySelector('#category-table').innerHTML = response.html;
    updateCategoryPagination();
    eventDelete();
}

export function eventSearch(url, searchDiv) {
    const searchInput = searchDiv.querySelector("input");
    searchInput.addEventListener("keyup", () => {
       sendSearch(url);
    });
}

export function sendSearch(url){
    const searchInputValue = getSearchInput().value;
    console.log(searchInputValue);
    sendAjaxGetRequest(url, {"search-name": searchInputValue}, handleCategoryGet)
    window.history.pushState({}, '', '/admin/categories/tags?' + encodeForAjax({"search-name": searchInputValue}))
}

export function eventDelete() {
    const deleteButtons = document.querySelectorAll('.icon-hover');

    // TODO: change to support tag and course.
    deleteButtons.forEach(element => element.addEventListener("click", () => {
            sendDataAjaxRequest("delete", "/api/admin/tag/delete", {
                input: getCategoryName(element),
            }, getToken(), handleCategoryResponse);
            updateCategoryPagination();
        }
        )
    );
}

export function updateCategoryPagination() {
    let pagination = document.querySelectorAll('.pagination a');
    if (pagination) {
        pagination.forEach(paginationLink => {
            paginationLink.addEventListener('click', changeCategoryPage);
        });
    }
}

function changeCategoryPage(event) {
    if (event !== undefined && event !== null)
        event.preventDefault();

    const searchInput = getSearchInput();
    let page = window.location.href.split('page=')[1];

    if (this !== undefined && this !== null)
        page = this.href.split("page=")[1];

    const data = {'search-name': searchInput.value, 'page': page};

    sendAjaxGetRequest('/api/admin/tag',
        data, handleCategoryGet);
    window.history.pushState({}, '', '/admin/categories/tags?' + encodeForAjax(data));
}

export function getCategoryName(deleteButton) {
    const categoryRow = deleteButton.parentElement.parentElement;
    return categoryRow.querySelector('td').innerText;
}

function getSearchInput() {
    let tagInputDiv = document.getElementById("input-category");
    let searchDiv = tagInputDiv.querySelectorAll("div")[1];
    return searchDiv.querySelector("input");
}
