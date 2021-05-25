import {sendDataAjaxRequest} from './common.js';

function markValidHandler(json) {
    let element = document.querySelector(".valid-icon-" + json.answerId);
    let text = document.querySelector('.mark-valid-' + json.answerId)
    if(json.valid) {
        element.innerHTML = '<i class="fas fa-check text-center"></i>';
        text.innerHTML = 'Unmark as valid';
    } else {
        element.innerHTML = '';
        text.innerHTML = 'Mark as valid';
    }
}

function markValidAnswer(answerId) {
    let data = {
        'answerId': answerId,
    };

    sendDataAjaxRequest('POST', '/api/answer/valid/' + answerId, data, markValidHandler);
}

if (document.querySelector('.mark-valid')) {
    let numberDivs = document.querySelectorAll('.answer-question-card');
    for (let i = 0; i < numberDivs.length; i++) {
        let answerId = numberDivs[i].querySelector(".answer-id").value;
        
        document.querySelector('.mark-valid-' + answerId).addEventListener('click', function() { markValidAnswer(answerId); });
    }
}