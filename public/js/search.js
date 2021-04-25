
function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}
  
function sendAjaxGetRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url + '?' + encodeForAjax(data), true);
    request.addEventListener('load', handler);
    request.send();
}

function sendAdvancedSearchRequest(page) {
    let searchInput = searchBar.querySelector("input[type='search']").value;
    let filter = document.querySelector("#search-filters li input:checked");

    let courses = JSON.stringify([...document.querySelectorAll(".course-filter-input:checked")].map(course => course.value))
    //let tags = '';

    sendAjaxGetRequest('get', 'search', 
        {'page': page,
        'search-input': searchInput, 
        'filter': filter.value, 
        'courses': courses}, 
        searchUpdateHandler);
}

function searchUpdateHandler(){
    //if (this.status != 200) window.location = '/';
    let response = JSON.parse(this.responseText);
   
    questionsDiv.innerHTML = response.html;

    for(paginationLink of document.querySelectorAll('.pagination a')) {
        paginationLink.addEventListener('click', searchPagination);
    }

}


let searchBarBtn = document.querySelector('button[name="search-submit"]');
let searchBar = document.getElementById('questions-search-bar');
let searchFilters = document.querySelectorAll('#search-filters li input');
let resetSearchBtn = document.getElementById('reset-search');
let questionsDiv = document.querySelector('#search-page .question-search-results');
let courseFilters = document.getElementsByClassName("course-filter-input");

if(searchBar){
    searchBarBtn.addEventListener('click', function(event){
        event.preventDefault();

        resetSearchBtn.hidden = false;
        searchFilters[0].parentElement.hidden = false;
        searchFilters[0].checked = true;
        sendAdvancedSearchRequest(1);
    });

    for(searchFilter of searchFilters){
        searchFilter.addEventListener('click', function() {sendAdvancedSearchRequest(1)});
    }

    for(courseFilter of courseFilters){
        courseFilter.addEventListener('click', function() {sendAdvancedSearchRequest(1)});
    }

    for(paginationLink of document.querySelectorAll('.pagination a')) {
        paginationLink.addEventListener('click', searchPagination);
    }
    
}

function searchPagination(event) {
    event.preventDefault();

    url = this.href.split('page=')[0]
    page = this.href.split('page=')[1]

    sendAdvancedSearchRequest(page);
}

