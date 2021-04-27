
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
    let filter = document.querySelector("#order-filters li input:checked");

    let courses = JSON.stringify([...document.querySelectorAll(".course-filter-input:checked")].map(course => course.value));
    let tags = JSON.stringify([...document.querySelectorAll('.selected-tag')].map(tag => tag.getAttribute('data-tag-id')));
    console.log(tags);
    sendAjaxGetRequest('get', 'api/search', 
        {'page': page,
        'search-input': searchInput, 
        'filter': filter.value, 
        'courses': courses, 
        'tags': tags},
        searchUpdateHandler);
}

function searchUpdateHandler(){
    if (this.status != 200) window.location = '/search';
    let response = JSON.parse(this.responseText);

    window.scroll({top: 0, behavior: 'smooth'});
    questionsDiv.innerHTML = response.html;
    updatePagination();
}

function sendSearchTagsRequest() {

    sendAjaxGetRequest('get', 'tags/search', {'tag-input': tagsInput.value}, tagsUpdateHandler);
}

function tagsUpdateHandler(){
    let response = JSON.parse(this.responseText);
    tagsSearchResults.innerHTML = "";

    if(response.tags.length != 0){
        tagsSearchResults.style.display = "block";
    } else tagsSearchResults.style.display = "none";

    for(tag of response.tags){
        // Tag label
        let newTagLabel = document.createElement('label');
        newTagLabel.setAttribute('for', `tag-filter-${tag.id}`);
        newTagLabel.classList.add('list-group-item', 'tag-filter');
        newTagLabel.innerHTML = tag.name;

        // Tag Input
        let newTag = document.createElement('input');
        newTag.setAttribute('type', 'checkbox');
        newTag.setAttribute('hidden', true);
        newTag.setAttribute('id', `tag-filter-${tag.id}`);
        newTag.classList.add('tag-filter-input');
        newTag.value = tag.id;

        tagsSearchResults.append(newTag);
        tagsSearchResults.append(newTagLabel);

        newTag.addEventListener('click', tagSelect);
    }  
}

function tagSelect(){

    let allSelected = document.querySelectorAll('.selected-tag');

    for(tag of allSelected){
        if(tag.getAttribute('data-tag-id') == this.value){
            tagsInput.value='';
            tagsSearchResults.style.display = "none";
            return;
        }
    }

    // Tag Badge
    let tagBadge = document.createElement('span');
    tagBadge.classList.add('badge','bg-primary','selected-tag', 'ms-2');

    tagBadge.setAttribute('data-tag-id', this.value);
    tagBadge.innerHTML = `${this.nextSibling.innerHTML}<i class="fas fa-times"></i>`;

    tagsSelected.appendChild(tagBadge);

    tagBadge.addEventListener('click', function(){
        this.remove();
        sendAdvancedSearchRequest();
    });

    tagsInput.value='';
    tagsSearchResults.innerHTML='';
    tagsSearchResults.style.display = 'none';

    sendAdvancedSearchRequest();
}


function toogleDropdown(){
    if(coursesDropdown.style.display == "block")
        coursesDropdown.style.display = "none";
    else
        coursesDropdown.style.display = "block";
}

// Search Page

let searchPage = document.getElementById('search-page');
let searchBarBtn = document.querySelector('button[name="search-submit"]');
let searchBar = document.getElementById('questions-search-bar');
let searchFilters = document.querySelectorAll('#order-filters li input');
let resetSearchBtn = document.getElementById('reset-search');
let questionsDiv = document.querySelector('#search-page .question-search-results');

let courseFilters = document.querySelectorAll(".course-filter-input");
let coursesDropdown = document.getElementById('courses-dropdown-list');
let coursesDropdownToogle =  document.getElementById('courses-dropdown');

let tagsInput = document.querySelector('input[name="tag-input"]');
let tagsSearchResults = document.getElementById('tags-search-results');
let tagsSelected = document.getElementById('tags-selected');

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

    coursesDropdownToogle.addEventListener('click', toogleDropdown);

    // Pagination
    updatePagination();

    // Tags Search
    tagsInput.addEventListener('keyup', 
        function(){ 

            if(tagsInput.value == ''){
                tagsSearchResults.innerHTML = "";
                tagsSearchResults.style.display = "none";
                return;
            }

            sendSearchTagsRequest();
        });

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
