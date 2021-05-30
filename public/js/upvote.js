import {sendDataAjaxRequest, showAlert} from './common.js';

function ajaxUpvoteUpdate(goalDiv, voteButton, value, id, type) {
    function requestHandler(json) {
        let older;
        let downVote = ".downvote-" + type + "-" + json.id;
        let upVote = ".upvote-" + type + "-" + json.id; 
        if (downVote == voteButton) older = upVote;
        else older = downVote;

        let updateElem = document.querySelector(voteButton);
        let oldElem = document.querySelector(older);
        if(updateElem.classList.contains("bi-caret-up-fill")) {
            updateElem.classList.remove("bi-caret-up-fill");
            updateElem.classList.add("bi-caret-up");

        } else if (updateElem.classList.contains("bi-caret-down-fill")) {
            updateElem.classList.remove("bi-caret-down-fill");
            updateElem.classList.add("bi-caret-down");
        
        } else if(updateElem.classList.contains("bi-caret-up")) {
            updateElem.classList.remove("bi-caret-up");
            if (oldElem.classList.contains("bi-caret-down-fill")) {
                oldElem.classList.remove("bi-caret-down-fill");
                oldElem.classList.add("bi-caret-down");
            }
            updateElem.classList.add("bi-caret-up-fill");

        } else if (updateElem.classList.contains("bi-caret-down")) {
            updateElem.classList.remove("bi-caret-down");
            if (oldElem.classList.contains("bi-caret-up-fill")) {
                oldElem.classList.remove("bi-caret-up-fill");
                oldElem.classList.add("bi-caret-up");
            }
            updateElem.classList.add("bi-caret-down-fill");
            
        }

        goalDiv.innerHTML = json.score;
    }

    function sendRequest(event) {
        event.preventDefault();

        let data = {
            'vote' : value,
        };

        sendDataAjaxRequest('POST', id, data, requestHandler);
    }

    
    document.querySelectorAll(voteButton).forEach(
        link => { link.addEventListener('click', sendRequest);});
}

if(document.getElementById('question-vote-id') != null) {
    let questionId = document.getElementById('question-vote-id').innerHTML;

    ajaxUpvoteUpdate(document.querySelector('.question-score'), '.upvote-question-' + questionId, '1', '/api/question/' + questionId + '/vote', 'question');
    ajaxUpvoteUpdate(document.querySelector('.question-score'), '.downvote-question-' + questionId, '-1', '/api/question/' + questionId + '/vote', 'question');
    let numberDivs = document.querySelectorAll('.answer-question-card');
    for (let i = 0; i < numberDivs.length; i++) {
        let answerId = numberDivs[i].querySelector(".answer-id").value;
        ajaxUpvoteUpdate(document.querySelector('.answer-score-' + answerId), '.upvote-answer-' + answerId, '1', '/api/question/' + questionId + '/answer/'  + answerId, 'answer');
        ajaxUpvoteUpdate(document.querySelector('.answer-score-' + answerId), '.downvote-answer-' + answerId, '-1', '/api/question/' + questionId + '/answer/' + answerId, 'answer');
    }
}
