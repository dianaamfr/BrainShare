import {getToken, sendAjaxGetRequest, sendDataAjaxRequest} from "../common.js";


export function handleCategoryResponse(responseJson) {
    if (responseJson.hasOwnProperty('error')) {
        console.log(responseJson['success'], 'error');
        return;
    } else {
        console.log(responseJson['success'], 'success');
    }
    document.querySelector('#category-table').innerHTML = responseJson['html'];

    // updatePagination();
    eventDelete();
}


export function handleCategoryGet(){
    const response = JSON.parse(this.responseText);
    document.querySelector('#category-table').innerHTML = response.html;

    //updatePagination();
    eventDelete();
}

export function eventSearch(url, searchDiv){
    const searchInput = searchDiv.querySelector("input");

    searchInput.addEventListener("keyup", ()=> {
        let searchInputValue = searchInput.value;
        console.log(url);
        sendAjaxGetRequest(url, {"search-name": searchInputValue}, handleCategoryGet)
        window.history.pushState({}, '', '/admin/categories/tags?' + encodeForAjax(searchInputValue))
    });
}

export function eventDelete() {
    const deleteButtons = document.querySelectorAll('.icon-hover');

    // TODO: change to support tag and course.
    deleteButtons.forEach(element => element.addEventListener("click", () => {
            sendDataAjaxRequest("delete", "/api/admin/tag/delete", {
                input: getCategoryName(element),
            }, getToken(), handleCategoryResponse);
        }
        )
    );
}

/*
export function updatePagination() {
    let pagination = document.querySelectorAll('.pagination a');
    if (pagination) {
        pagination.forEach(paginationLink => {
            paginationLink.addEventListener('click', changeCategoryPage);
        });
    }
}

function changeCategoryPage(event) {
    // TODO: change to support tag and course.
    const categoryInput = document.querySelectorAll("#input-category input");
    const categoryInputSearch = categoryInput[1];

    event.preventDefault();
    let page = this.href.split('page=')[1]

    const data = {'category_input': categoryInput.value, 'page': page}

    sendAjaxGetRequest('get', '/api/admin/categories/tag',
        data, handleCategoryGet);

    window.history.pushState({}, '', '/admin/categories/tag?' + encodeForAjax(data));
}*/

export function getCategoryName(deleteButton) {
    const categoryRow = deleteButton.parentElement.parentElement;
    return categoryRow.querySelector('td').innerText;
}
