import {sendDataAjaxRequest} from "./common.js";
import {addCommentEventListeners} from "./comment.js"; 

window.addEventListener('load', addEventListeners);


function addEventListeners(){
    // Add Answer
    let form = document.getElementById('submit-answer');
    form.addEventListener("submit",submitAnswer);

    // Delete Answer
    let deleteButtons = document.getElementsByClassName('answer-delete-form');

    let deletionList = [...deleteButtons];
    deletionList.forEach(addDeleteListeners);

    // Edit Answer
    let editButtons = document.getElementsByClassName("answer-edit-form");
    let editList = [...editButtons];
    editList.forEach(addEditFormListeners);

    let submitEditForm = document.getElementsByClassName('edit-answer-forms');
    let submitEditFormList = [...submitEditForm];
    submitEditFormList.forEach(addEditListeners);

    let cancelEditForm = document.querySelectorAll('.edit-answer-forms button[type=button]');
    let cancelEditFormList = [...cancelEditForm];
    cancelEditFormList.forEach(addCancelListeners);





    // console.log(form);
    // console.log(editButtons);
    // console.log(deleteButtons);
    console.log(cancelEditForm);

}

function editorToolbares(element){
    
}



function addDeleteListeners(element){
    element.addEventListener('submit',removeAnswer);
}

function addEditListeners(element){
    element.addEventListener('submit',editAnswer);
}

function addEditFormListeners(element){
    element.addEventListener('submit',showEditForm);
}

function addCancelListeners(element){
    element.addEventListener('click',cancelEditForm)
}


function submitAnswer(event){

    event.preventDefault();

    let id = this.querySelector('input[name="questionID"]').value;
    let textElement = this.querySelector('textarea[name="content"]');
    let text = textElement.value;

    // This is not doing anytihing because of the markdown framework
    textElement.value = "";

    sendDataAjaxRequest("POST",'/api/question/'+ id + '/answer', {'text':text}, handler);

}

function removeAnswer(event){

    // Not sure if this is needed, check later
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;

    console.log(this);
    //console.log(questionID);
    console.log(answerID);

    //Route::delete('/api/question/{id-q}/answer/{id-a}
    sendDataAjaxRequest("delete",'/api/answer/'+ answerID + '/delete', null, handler);
    

}

// Falta dar fix ao css de modo a que consiga ir buscar o texto
function editAnswer(event){

    event.preventDefault();

    //let questionID = this.querySelector('input[name="questionID"]').value;
    let answerID = this.querySelector('input[name="answerID"]').value;
    //let text = this.querySelector('textarea[name="content"]').value;
    //let text = "hello my friend"
    let text = this.querySelector('textarea').value;

    console.log(this);
    //console.log(questionID);
    console.log(answerID);
    console.log(text);


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

function cancelEditForm(){

    let answerID = this.name;
    let editForm = document.getElementById('edit-answer-'+ answerID);
    let answer = document.getElementById('answer-content-' + answerID);

    editForm.style.display = 'none';
    answer.style.display = 'block';

}


function handler(responseJson){

    console.log(responseJson);
    if(responseJson.success){
        let answers = document.getElementById('all-answers');
        answers.innerHTML = responseJson.html;
        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';
        addEventListeners();
        addCommentEventListeners();
    }
    
    
}





