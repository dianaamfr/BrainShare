import {sendDataAjaxRequest, setConfirmationModal, sendAjaxGetRequest, tooltipLoad} from "./common.js";
import {addCommentEventListeners} from "./comment.js";

tooltipLoad();
let all_answers = document.getElementById("all-answers");
let lastScrollTime = Date.now();
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

    let cancelEditForm = document.querySelectorAll('.edit-answer-forms button[type=button]');
    cancelEditForm.forEach(element => element.addEventListener('click', cancelEditForm));

}


function submitAnswer(event) {

    event.preventDefault();

    let id = this.querySelector('input[name="questionID"]').value;
    let textElement = this.querySelector('textarea[name="content"]');
    let text = textElement.value;

    let counter = document.getElementById("all-answers").childElementCount;

    // This is not doing anytihing because of the markdown framework
    textElement.value = "";

    sendDataAjaxRequest("POST", '/api/question/' + id + '/answer', {
        'text': text,
        'counter': counter
    }, addAnswerHandler);


}

function removeAnswer(event) {
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;

    //Route::delete('/api/question/{id-q}/answer/{id-a}
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

    let answerID = this.name;
    let editForm = document.getElementById('edit-answer-' + answerID);
    let answer = document.getElementById('answer-content-' + answerID);

    editForm.classList.toggle('d-none');
    answer.classList.toggle('d-none');

}


function addAnswerHandler(responseJson) {
    if (responseJson.success) {
        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';

        // Append if the limit as not been reached
        if (responseJson.html != undefined) {
            document.getElementById("all-answers").innerHTML += responseJson.html;
            addEventListeners();
            addCommentEventListeners();
            tooltipLoad();
        }
    }
}

function deleteAnswerHandler(responseJson) {
    if (responseJson.success) {

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';

        let deletedElement = document.getElementById("answer-" + responseJson.answer_id);

        if (deletedElement != undefined) {
            deletedElement.parentNode.removeChild(deletedElement);
        }
    }
}

function editAnswerHandler(responseJson) {

    if (responseJson.success) {

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';

        let editElement = document.getElementById("answer-content-" + responseJson.answer_id);
        if (editElement != undefined) {
            editElement.innerHTML = responseJson.content;

            let editForm = document.getElementById('edit-answer-' + responseJson.answer_id);
            let answer = document.getElementById('answer-content-' + responseJson.answer_id);

            editForm.classList.toggle('d-none');
            answer.classList.toggle('d-none');
        }

    }
}


function checkInfiniteScroll(parentSelector, childSelector) {
    let lastDiv = document.querySelector(parentSelector + childSelector);
    let lastDivOffset = lastDiv.offsetTop + lastDiv.clientHeight;

    if (window.scrollY > lastDivOffset - 20) {
      
        // Agora é necessário trocar o que está dentro deste if pelo pedido ajax em
        let id = document.querySelector("#submit-answer > input[name=questionID]").value;
        let answerCounter = document.querySelector("#submit-answer > input[name=answerCounter]").value

        // sendDataAjaxRequest("POST",'/api/question/'+ id + '/scroll', {'page' : page}, handlePagination);
        let counter = document.getElementById("all-answers").childElementCount;
       
        if (counter < answerCounter) {
            sendAjaxGetRequest('/api/question/' + id + '/scroll', {'counter': counter}, addScroll);
        }
    }
}

function update() {
    checkInfiniteScroll("#all-answers", "> div:last-child");
}

function addScroll() {
    let response = JSON.parse(this.responseText);
    if (response.success) {
        document.getElementById("all-answers").innerHTML += response.html;

        addEventListeners();
        tooltipLoad();
    }
}



