import {sendDataAjaxRequest,sendAjaxGetRequest} from "./common.js";
import {addCommentEventListeners} from "./comment.js"; 

addEventListeners();

console.log("Reaches here");
let page = 1;

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

    sendDataAjaxRequest("POST",'/api/question/'+ id + '/answer', {'text':text, 'page': page}, handler);

}

function removeAnswer(event){

    // Not sure if this is needed, check later
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;

    console.log(this);
    //console.log(questionID);
    console.log(answerID);

    //Route::delete('/api/question/{id-q}/answer/{id-a}
    sendDataAjaxRequest("delete",'/api/answer/'+ answerID, null, handler);
    

}

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


    sendDataAjaxRequest("put",'/api/answer/'+ answerID,{'text':text}, handler);
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

console.log("no working");
let debugging = document.getElementById('debuggiiing');
console.log(debugging);


debugging.addEventListener("submit",checkForNewDiv);



function checkForNewDiv(event) {

    console.log("handling event");
    //event.preventDefault();

    let lastDiv = document.querySelector("#all-answers > div:last-child");
    let lastDivOffset = lastDiv.offsetTop + lastDiv.clientHeight;
    let pageOffset = window.pageYOffset + window.innerHeight;

    // Agora é necessário trocar o que está dentro deste if pelo pedido ajax em 

    if(pageOffset > lastDivOffset + 1300) {
        let id = document.querySelector("#submit-answer > input[name=questionID]").value;
        sendDataAjaxRequest("POST",'/api/question/'+ id + '/scroll', {'page' : page}, handlePagination);
        checkForNewDiv();
        
    }
}

function handlePagination(){

    let response = JSON.parse(this.responseText);
    console.log(response);
    console.log("Entered handler");
    console.log(response.success);
    let newAnswers = response.html;
    document.getElementById("all-answers").appendChild(newAnswers);
    checkForNewDiv();
    console.log("APPEDNING NEW DIV ASDHSADHSAJDHÇAASÇJDHJSJDA");
    page +=1;
}






