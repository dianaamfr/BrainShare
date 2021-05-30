import {encodeForAjax, sendAjaxGetRequest} from './common.js';

function ajaxProfileUpdate(goalDiv, paginationElem, id) {
    function requestHandler() {
        if (this.status != 200) window.location = '';
        let response = JSON.parse(this.responseText);

        goalDiv.innerHTML = response.html;
        updatePaginate();
    }

    function sendRequest(page = 1) {
        let data = {
            'page': page,
        };
        
        sendAjaxGetRequest(id, data, requestHandler);
        
        let url = 'profile?' + encodeForAjax(data)
        window.history.pushState({}, '', url);
    }

    function paginate(event) {
        event.preventDefault();
        let page = this.href.split('page=')[1]
        sendRequest(page);
    }

    function updatePaginate() {
        document.querySelectorAll(paginationElem).forEach(
            paginationLink => { paginationLink.addEventListener('click', paginate);});
    }

    updatePaginate();
}

function profileSearch(event){  
    event.preventDefault(); 
    let search = this.querySelector("input[type='search']");
    let userId = document.getElementById('profile-id').innerHTML;

    if(search.value == '') return;

    if(document.querySelector('#pagination-item-1').style.display == "block"){
        // Search Questions
        sendAjaxGetRequest( '/api/user/' + userId + '/questions', {"profile-search": search.value}, profileQuestionsUpdate);
    }
    else {
        // Search Answers
        sendAjaxGetRequest( '/api/user/' + userId + '/answers', {"profile-search": search.value}, profileAnswersUpdate);  
    }
}

function profileQuestionsUpdate() {
    let response = JSON.parse(this.responseText);
    document.querySelector('#pagination-item-1').innerHTML = response.html;

    let userId = document.getElementById('profile-id').innerHTML;
    ajaxProfileUpdate(document.querySelector('#pagination-item-1'), '.profile-questions-paginate .pagination a', '/api/user/' + userId + '/questions');
}

function profileAnswersUpdate() {
    let response = JSON.parse(this.responseText);
    document.querySelector('#pagination-item-2').innerHTML = response.html;
    
    let userId = document.getElementById('profile-id').innerHTML;
    ajaxProfileUpdate(document.querySelector('#pagination-item-2'), '.profile-answers-paginate .pagination a', '/api/user/' + userId + '/answers');
}

if (document.getElementById('profile-id')) {
    let userId = document.getElementById('profile-id').innerHTML;

    // Question paginate
    ajaxProfileUpdate(document.querySelector('#pagination-item-1'), '.profile-questions-paginate .pagination a', '/api/user/' + userId + '/questions');
    
    // Answer paginate
    ajaxProfileUpdate(document.querySelector('#pagination-item-2'), '.profile-answers-paginate .pagination a', '/api/user/' + userId + '/answers');
    document.getElementById('profile-search').addEventListener('submit', profileSearch)
}