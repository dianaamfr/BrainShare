import {sendDataAjaxRequest, setConfirmationModal, sendAjaxGetRequest, tooltipLoad, showToast} from "./common.js";
import {addCommentEventListeners} from "./comment.js";
import convertMD from './parseMD.js';
import {listenReportFlag} from './report.js';
import {voteAnswersListeners} from './upvote.js';
import {markAsValidListener} from './valid-answer.js';

tooltipLoad();
let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));

addEventListeners();
setInterval(update, 1500);

function addEventListeners() {

    // Add Answer
    let form = document.getElementById('submit-answer');
    form.addEventListener("submit", submitAnswer);

    // Delete Answer
    let deleteButtons = document.querySelectorAll('.answer-delete-form');
    deleteButtons.forEach(element => element.addEventListener('submit', removeAnswer));

    // Edit Answer
    let editButtons = document.querySelectorAll(".answer-edit-form");
    editButtons.forEach(element => element.addEventListener('submit', showEditForm));

    let submitEditForm = document.querySelectorAll('.edit-answer-forms');
    submitEditForm.forEach(element => element.addEventListener('submit', editAnswer));

    let cancelEdit = document.querySelectorAll('.edit-answer-forms button[type=button]');
    cancelEdit.forEach(element => element.addEventListener('click', cancelEditForm));

}


function submitAnswer(event) {

    event.preventDefault();

    let id = this.querySelector('input[name="questionID"]').value;
    let textElement = this.querySelector('textarea[name="content"]');
    let text = textElement.value;

    if(text == '') return;

    let counter = document.getElementById("all-answers").childElementCount;

    editor.codemirror.setValue("");

    sendDataAjaxRequest("POST", '/api/question/' + id + '/answer', {
        'text': text,
        'counter': counter
    }, addAnswerHandler);


}

function removeAnswer(event) {
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;

    setConfirmationModal(
        'Delete Answer',
        'Are you sure you want to delete this Answer?',
        function () {
            sendDataAjaxRequest("delete", '/api/answer/' + answerID, null, deleteAnswerHandler);
        }, modal);

}

function editAnswer(event) {

    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;
    let text = this.querySelector('textarea').value;


    sendDataAjaxRequest("put", '/api/answer/' + answerID, {'text': text}, editAnswerHandler);
}

function showEditForm(event) {
    event.preventDefault();
    let answerID = this.querySelector('input[name="answerID"]').value;
    let editForm = document.getElementById('edit-answer-' + answerID);
    let answer = document.getElementById('answer-content-' + answerID);

    editForm.classList.toggle('d-none');
    answer.classList.toggle('d-none');

}

function cancelEditForm(event) {

    event.preventDefault();

    let answerID = this.name;
    let editForm = document.getElementById('edit-answer-' + answerID);
    let answer = document.getElementById('answer-content-' + answerID);

    editForm.classList.toggle('d-none');
    answer.classList.toggle('d-none');

}


function addAnswerHandler(responseJson) {

    if(responseJson.hasOwnProperty('error') || responseJson.hasOwnProperty('errors')){
        showToast("An error occured while attempting to add an answer","red");
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        
        showToast("Unauthorized Operation\nLogin may be necessary","red");
        return;
    } else if (responseJson.success) {
        showToast("Answer successfully added!!","blue");

        if(document.querySelector(".no-answers")) {
            document.querySelector(".no-answers").remove();
        }

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';

        if (responseJson.html != undefined) {
            document.getElementById("all-answers").innerHTML = responseJson.html + document.getElementById("all-answers").innerHTML;
            addEventListeners();
            addCommentEventListeners();
            tooltipLoad();
            document.getElementById("all-answers").scrollIntoView()
        }

        convertMD("md-content");
    }
}

function deleteAnswerHandler(responseJson) {

    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to edit an answer","red");
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red");
        return;
    } else if (responseJson.success) {
        showToast("Answer successfully deleted!!","blue");

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';

        let deletedElement = document.getElementById("answer-" + responseJson.answer_id);

        if (deletedElement != undefined) {
            deletedElement.parentNode.removeChild(deletedElement);
        }
    }
}

function editAnswerHandler(responseJson) {

    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to edit an answer","red");
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red");
        return;
    } else if (responseJson.success) {
        showToast("Answer successfully edited!!","blue");

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';

        let editElement = document.getElementById("answer-content-" + responseJson.answer_id);
        if (editElement != undefined) {
            editElement.innerHTML = responseJson.content;

            let editForm = document.getElementById('edit-answer-' + responseJson.answer_id);
            let answer = document.getElementById('answer-content-' + responseJson.answer_id);

            editForm.classList.toggle('d-none');
            answer.classList.toggle('d-none');        
            convertMD("md-content");
        }

    }
}


function checkInfiniteScroll(parentSelector, childSelector) {
    
    let lastDiv = document.querySelector(parentSelector + childSelector);

    if(!lastDiv) return;

    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - lastDiv.offsetHeight * 3) {
        let id = document.querySelector("#submit-answer > input[name=questionID]").value;
        let answerCounter = document.querySelector("#submit-answer > input[name=answerCounter]").value

        let counter = document.getElementById("all-answers").childElementCount;

        if (counter < answerCounter) {
            sendAjaxGetRequest('/api/question/' + id + '/scroll', {'counter': counter}, addScroll);
        }
    }
}

function update() {
    checkInfiniteScroll("#all-answers", "> div:nth-last-child(2)");
}

function addScroll() {
    let response = JSON.parse(this.responseText);
    if (response.success) {
        document.getElementById("all-answers").innerHTML += response.html;

        addEventListeners();
        addCommentEventListeners();
        tooltipLoad();
        convertMD("md-content");
        listenReportFlag();
        voteAnswersListeners();
        markAsValidListener();
    }
}



