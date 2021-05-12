function ajaxUpvoteUpdate(goalDiv, voteButton, value, id) {
    function sendDataAjaxRequest(method, url, data, handleResponse) {
        let dataJson = JSON.stringify(data);
        fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Request-With': "XMLHttpRequest",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                method: method,
                credentials: 'same-origin',
                body: dataJson
            },
        ).then(response => response.json()).then(json => handleResponse(json));
    }    

    function requestHandler(json){
        goalDiv.innerHTML = json.score;
    }

    function sendRequest(event) {
        event.preventDefault();

        let data = {
            'vote' : value,
        };

        sendDataAjaxRequest('POST', id, data, requestHandler);
    }

    function updatePaginate() {
        document.querySelectorAll(voteButton).forEach(
            link => { link.addEventListener('click', sendRequest);});
    }

    updatePaginate();
}

if(document.getElementById('question-vote-id') != null) {
    let questionId = document.getElementById('question-vote-id').innerHTML;

    ajaxUpvoteUpdate(document.querySelector('.question-score'), '.upvote-question', '1', '/api/question/' + questionId + '/vote');
    ajaxUpvoteUpdate(document.querySelector('.question-score'), '.downvote-question', '-1', '/api/question/' + questionId + '/vote');

    let numberDivs = document.querySelectorAll('.answer-question-card');
    for (let i = 0; i < numberDivs.length; i++) {
        let answerId = numberDivs[i].querySelector(".answer-id").value;

        ajaxUpvoteUpdate(document.querySelector('.answer-score-' + answerId), '.upvote-answer-' + answerId, '1', '/api/question/' + questionId + '/answer/'  + answerId);
        ajaxUpvoteUpdate(document.querySelector('.answer-score-' + answerId), '.downvote-answer-' + answerId, '-1', '/api/question/' + questionId + '/answer/' + answerId);
    }
}
