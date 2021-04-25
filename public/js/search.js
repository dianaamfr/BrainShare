
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
    let filter = this.value;

    let courses = 'todo';
    let tags = 'todo';

    if(searchInput == '' && filter == 'relevance') return;

    sendAjaxGetRequest('get', '/search/query', {'search-input': searchInput, 'filter': filter}, searchUpdateHandler);

    for(searchFilter of searchFilters){
        searchFilter.parentElement.classList.remove('active');
    }

    if(filter == 'relevance'){
        resetSearchBtn.hidden = false;
        searchFilters[0].hidden = false;
        searchFilters[0].classList.add('active');
    } else if (searchInput == '') {
        resetSearchBtn.hidden = true;
        searchFilters[0].hidden = true;
    }


    if(filter != 'relevance'){
        this.classList.add('active');
    }
}

function searchUpdateHandler(){
    if (this.status != 200) window.location = '/';
    let questions = JSON.parse(this.responseText);
    console.log(questions)
   
    questionsDiv.innerHTML = '';
    
    for(question of questions.data){
        showQuestion(question);
    }

    questionsDiv.appendChild(question.links);

}


let searchBarBtn = document.querySelector('button[name="search-submit"]');
let searchBar = document.getElementById('questions-search-bar');
let searchFilters = document.querySelectorAll('#search-filters li button');
let resetSearchBtn = document.querySelector('button[name="reset-search"]');
let questionsDiv = document.querySelector('#search-page .question-search-results');

if(searchBar){
    searchBarBtn.addEventListener('click', sendAdvancedSearchRequest);
    resetSearchBtn.addEventListener('click', resetSearch);

    for(searchFilter of searchFilters){
        searchFilter.addEventListener('click', sendAdvancedSearchRequest)
    }

}


function resetSearch(){
    window.location = '/search';
}

function showQuestion(question) {
    let questionArticle = document.createElement('article');
    questionArticle.classList.add("question-preview","card","flex-row","align-items-center");
    
    let answers = `<div class="counts">
                    <div>${question.number_answer}</div>
                    <div>answers</div>
                </div>`;

    let votes = `<div class="counts">
                    <div>${question.score}</div>
                    <div>votes</div>
                </div>`;

    let header =  ` <div class="card-body">
                        <header class="card-header">
                            <div class="question-header d-flex align-items-center">
                                <div class="d-none question-details d-flex mb-3">`;

                            
    let courses = '';
    for(course of question.courses){
        courses += `<span class="category tag badge rounded-pill bg-secondary">
                        <i class="fas fa-graduation-cap"></i>
                        ${course.name}
                    </span>`;
    }
    header += courses;

    header += `</div>
                <h4 class="card-title flex-grow-1"><a href="/question/${ question.id }">${question.title}</a></h4>
                <div class="question-details d-flex">`;
    header += courses;        
    header += `</div></div> </header>`;
    
    let body = `<div class="limited-text-3 card-body md-content md-remove"> 
                    ${question.content.substring(0,200)}
                </div>`;

    let footer = `<footer class="card-footer d-flex align-items-center flex-wrap">
                    <div class="flex-grow-1 mb-1">`;

    
    for(tag of question.tags){
        footer += `<span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        ${tag.name}
                    </span>`;
    }
    
    footer += `</div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> 
                    <div class="d-flex flex-wrap">
                        <span>${question.owner.username}</span>
                        <span> ${question.date} </span>
                    </div>
                </div>
            </footer> </div>`;        
    let mobileVotesAnswers = `<div class="counts-mobile">
                                <div>${question.number_answer} answers</div>
                                <div>${question.score} votes</div>
                            </div>`;

    questionArticle.innerHTML = answers + votes + header + body + footer + mobileVotesAnswers;
    questionsDiv.appendChild(questionArticle);
}

