
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

function sendAdvancedSearchRequest(event) {
    event.preventDefault();
    
    let searchInput = searchBar.querySelector("input[type='search']").value;
    let courses = '2';
    let tags = '3';

    sendAjaxGetRequest('get', '/search/query', {searchInput: searchInput}, searchUpdateHandler);
}

function searchUpdateHandler(){
    if (this.status != 200) window.location = '/';
    let questions = JSON.parse(this.responseText);
    
    let questionsDiv = document.querySelector('#search-page .question-search-results');
    questionsDiv.innerHTML = '';
    
    questions.forEach(question => showQuestion);
}

let searchBar = document.getElementById('questions-search-bar');
if(searchBar){
    searchBar.addEventListener('submit', sendAdvancedSearchRequest);
}

function showQuestion($question) {

}
