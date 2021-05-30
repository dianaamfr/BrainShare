import {sendDataAjaxRequest, setConfirmationModal, tooltipLoad} from "./common.js";
import {addCommentEventListeners} from "./comment.js"; 

tooltipLoad();
addEventListeners();
let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));

function addEventListeners(){
    // Add Answer
    let form = document.getElementById('submit-answer');
    form.addEventListener("submit",submitAnswer);

    // Delete Answer
    let deleteButtons = Array.from(document.getElementsByClassName('answer-delete-form'));
    deleteButtons.forEach(element => element.addEventListener('submit', removeAnswer));

    // Edit Answer
    let editButtons = Array.from(document.getElementsByClassName("answer-edit-form"));
    editButtons.forEach(element => element.addEventListener('submit',showEditForm));

    let submitEditForm = Array.from(document.getElementsByClassName('edit-answer-forms'));
    submitEditForm.forEach(element => element.addEventListener('submit', editAnswer));

    let cancelEditForm = Array.from(document.querySelectorAll('.edit-answer-forms button[type=button]'));
    cancelEditForm.forEach(element => element.addEventListener('click',cancelEditForm));

}

function submitAnswer(event){

    event.preventDefault();

    let id = this.querySelector('input[name="questionID"]').value;
    let textElement = this.querySelector('textarea[name="content"]');
    let text = textElement.value;

    // TODO: This is not doing anything because of the markdown framework
    textElement.value = "";

    sendDataAjaxRequest("POST",'/api/question/'+ id + '/answer', {'text':text}, handler);

}

function removeAnswer(event){
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;

    setConfirmationModal(
        'Delete Answer', 
        'Are you sure you want to delete this Answer?', 
        function(){
            sendDataAjaxRequest("delete",'/api/answer/'+ answerID + '/delete', null, handler);
        }, modal);  

}

// TODO: dar fix ao css de modo a que se consiga ir buscar o texto
function editAnswer(event){

    event.preventDefault();

    //let questionID = this.querySelector('input[name="questionID"]').value;
    let answerID = this.querySelector('input[name="answerID"]').value;
    //let text = this.querySelector('textarea[name="content"]').value;
    //let text = "hello my friend"
    let text = this.querySelector('textarea').value;

    sendDataAjaxRequest("put",'/api/answer/'+ answerID + '/edit',{'text':text}, handler);
}

function showEditForm(event){
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;
    let editForm = document.getElementById('edit-answer-'+ answerID);
    let answer = document.getElementById('answer-content-' + answerID);

    
    editForm.style.display = 'block';
    answer.style.display = 'none';
    
}

function cancelEditForm(event){

    let answerID = this.name;
    let editForm = document.getElementById('edit-answer-'+ answerID);
    let answer = document.getElementById('answer-content-' + answerID);

    editForm.style.display = 'none';
    answer.style.display = 'block';

}

function handler(responseJson){

    if(responseJson.success){
        let answers = document.getElementById('all-answers');
        answers.innerHTML = responseJson.html;
        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';
        addEventListeners();
        addCommentEventListeners();
        tooltipLoad();
    }
    
}
