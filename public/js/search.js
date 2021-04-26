
function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}
  
function sendAjaxGetRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url + '?' + encodeForAjax(data), true);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.addEventListener('load', handler);
    request.send();
}

function sendAdvancedSearchRequest(page = 1) {
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
    if (this.status != 200) window.location = '/search';
    let response = JSON.parse(this.responseText);

    window.scroll({top: 0, behavior: 'smooth'});
    questionsDiv.innerHTML = response.html;
    updatePagination();
}


// Search Page

let searchPage = document.getElementById('search-page');
let searchBarBtn = document.querySelector('button[name="search-submit"]');
let searchBar = document.getElementById('questions-search-bar');
let searchFilters = document.querySelectorAll('#search-filters li input');
let resetSearchBtn = document.getElementById('reset-search');
let questionsDiv = document.querySelector('#search-page .question-search-results');
let courseFilters = document.querySelectorAll(".course-filter-input");

if(searchPage){
    // Text Search
    searchBarBtn.addEventListener('click', function(event){
        event.preventDefault();
        resetSearchBtn.hidden = false;
        searchFilters[0].parentElement.hidden = false;
        searchFilters[0].checked = true;
        sendAdvancedSearchRequest();
    });

    // Order 
    searchFilters.forEach(searchFilter => {
        searchFilter.addEventListener('click', function() {sendAdvancedSearchRequest()});});
    
    // Courses
    courseFilters.forEach(courseFilter => {
        courseFilter.addEventListener('click', function() {sendAdvancedSearchRequest();});});

    // Pagination
    updatePagination();
    
}

function searchPagination(event) {
    event.preventDefault();
    page = this.href.split('page=')[1]
    sendAdvancedSearchRequest(page);
}

function updatePagination() {
    document.querySelectorAll('.pagination a').forEach(
        paginationLink => { paginationLink.addEventListener('click', searchPagination);});
}
