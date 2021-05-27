import {sendAjaxGetRequest, sendDataAjaxRequest, showAlert, encodeForAjax, setConfirmationModal} from "../common.js";


/**
 * This function treats DELETE and POST methods for categories.
 * @param responseJson received a json response.
 */
export function handleCategoryResponse(responseJson) {
    
    const notificationDiv = document.querySelector("#category-notify");
    if (responseJson.hasOwnProperty('error')) {
        showAlert(responseJson['error'], 'error', notificationDiv);
        return;
    } else {
        showAlert(responseJson['success'], 'success', notificationDiv);
    }

    changeCategoryPage(responseJson['url']);
    listenPageCategory(responseJson['url']);
    listenDeleteCategory(responseJson['url']);
}

/**
 * This function treats GET methods for the categories.
 */
export function handleCategoryGet() {
    const response = JSON.parse(this.responseText);
    document.querySelector('#category-table').innerHTML = response.html;
    listenPageCategory(response.url);
    listenDeleteCategory(response.url);
}


/**
 * This function handles the search event for categories.
 * @param url {String} url of the category page.
 * @param searchDiv {Element} Search div element.
 */
export function listenSearchCategory(url, searchDiv) {
    const searchInput = searchDiv.querySelector("input");
    searchInput.addEventListener("keyup", () => {
       sendSearch(url);
    });
}


/**
 * Listens for the delete button.
 * @param url{String} Url page where this request must happen.
 */
export function listenDeleteCategory(url, modal) {
    const deleteButtons = document.querySelectorAll('.management-action-btn');

    // TODO: change to support tag and course.
    deleteButtons.forEach(element => element.addEventListener("click", function() {
        setConfirmationModal('Delete Tag', 
            'Are you sure you want to delete the tag <strong>"' + getCategoryName(element) + '"</strong>?',
            function(){
                sendDataAjaxRequest("delete", "/api" + url + "/delete", {
                    input: getCategoryName(element),
                    }, handleCategoryResponse);
                    listenPageCategory(); 
            },
            modal
        );     
    }))
}

export function listenPageCategory(url) {
    let pagination = document.querySelectorAll('.pagination a');
    if (pagination) {
        pagination.forEach(paginationLink => {
            paginationLink.addEventListener('click', function(event){changeCategoryPage.apply(this, [url, event])});
        });
    }
}

function changeCategoryPage(url, event) {
    if (event !== undefined && event !== null)
        event.preventDefault();

    const searchInput = getSearchInput();
    let page = window.location.href.split('page=')[1];
    if (this !== undefined && this !== null)
        page = this.href.split("page=")[1];

    const data = {'search-name': searchInput.value, 'page': page};

    sendAjaxGetRequest("/api" + url,
        data, handleCategoryGet);
    window.history.pushState({}, '', url + "?" + encodeForAjax(data));
}

/**
 * Send a search query.
 * @param url{String} Url page where this request must happen.
 */
export function sendSearch(url){
    const searchInputValue = getSearchInput().value;
    sendAjaxGetRequest("/api" + url, {"search-name": searchInputValue}, handleCategoryGet)
    window.history.pushState({}, '', url + "?" + encodeForAjax({"search-name": searchInputValue}))
}

export function listenAddCategory(url){
    const InputDiv = document.getElementById("input-category");
    const addButton = InputDiv.querySelector("button");
    const addInput = InputDiv.querySelector("input");
    addButton.addEventListener("click", () => {
        sendDataAjaxRequest("post", "/api" + url + "/add" , {'input': addInput.value}, handleCategoryResponse);
    });

}

export function getCategoryName(deleteButton) {
    const categoryRow = deleteButton.parentElement.parentElement;
    console.log(categoryRow)
    return categoryRow.querySelector('.category-name').innerText;
}

function getSearchInput() {
    let tagInputDiv = document.getElementById("input-category");
    let searchDiv = tagInputDiv.querySelectorAll("div")[1];
    return searchDiv.querySelector("input");
}
