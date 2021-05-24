function ajaxProfileUpdate(goalDiv, paginationElem, id) {
    function sendAjaxGetRequest(method, url, data, handler) {
        let request = new XMLHttpRequest();
        
        request.open(method, url + '?' + encodeForAjax(data), true);
        request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        request.addEventListener('load', handler);
        request.send();
    }
    
    function requestHandler(){
        if (this.status != 200) window.location = '';
        let response = JSON.parse(this.responseText);

        goalDiv.innerHTML = response.html;
        
        updatePaginate();
    }

    function sendRequest(page = 1) {
        let data = {
            'page': page,
        };
        
        sendAjaxGetRequest( id, data, requestHandler);
        
        let url = 'profile?' + encodeForAjax(data)
        window.history.pushState({}, '', url);
    }

    function paginate(event) {
        event.preventDefault();
        page = this.href.split('page=')[1]
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
    // TODO paginate
}

function profileAnswersUpdate() {
    let response = JSON.parse(this.responseText);
    document.querySelector('#pagination-item-2').innerHTML = response.html;
    // TODO paginate
}

if (document.getElementById('profile-id')) {
    let userId = document.getElementById('profile-id').innerHTML;
    ajaxProfileUpdate(document.querySelector('#pagination-item-1'), '.profile-questions-paginate .pagination a', '/api/user/' + userId + '/questions');
    ajaxProfileUpdate(document.querySelector('#pagination-item-2'), '.profile-answers-paginate .pagination a', '/api/user/' + userId + '/answers');
    document.getElementById('profile-search').addEventListener('submit', profileSearch)
}