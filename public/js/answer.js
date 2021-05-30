import {sendDataAjaxRequest,sendAjaxGetRequest} from "./common.js";
import {addCommentEventListeners} from "./comment.js"; 


let all_answers = document.getElementById("all-answers");
let lastScrollTime = Date.now();

addEventListeners();
setInterval(update, 2000);


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
    //console.log(cancelEditForm);
    
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

    let counter = document.getElementById("all-answers").childElementCount;

    // This is not doing anytihing because of the markdown framework
    textElement.value = "";

    console.log(counter);

    sendDataAjaxRequest("POST",'/api/question/'+ id + '/answer', {'text':text, 'counter':counter}, addAnswerHandler);

}

function removeAnswer(event){

    // Not sure if this is needed, check later
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;


    //Route::delete('/api/question/{id-q}/answer/{id-a}
    sendDataAjaxRequest("delete",'/api/answer/'+ answerID, null, deleteAnswerHandler);
    

}

function editAnswer(event){

    event.preventDefault();

    //let questionID = this.querySelector('input[name="questionID"]').value;
    let answerID = this.querySelector('input[name="answerID"]').value;
    //let text = this.querySelector('textarea[name="content"]').value;
    //let text = "hello my friend"
    let text = this.querySelector('textarea').value;



    sendDataAjaxRequest("put",'/api/answer/'+ answerID,{'text':text}, editAnswerHandler);
}

function showEditForm(event){
    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;
    let editForm = document.getElementById('edit-answer-'+ answerID);
    let answer = document.getElementById('answer-content-' + answerID);



    
    editForm.classList.toggle('d-none');
    answer.classList.toggle('d-none');
    
}

function cancelEditForm(){

    let answerID = this.name;
    let editForm = document.getElementById('edit-answer-'+ answerID);
    let answer = document.getElementById('answer-content-' + answerID);

    editForm.classList.toggle('d-none');
    answer.classList.toggle('d-none');

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


function addAnswerHandler(responseJson){
    console.log(responseJson);
    if(responseJson.success){

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';
        
            // Append if the limit as not been reached
        if(responseJson.html != undefined){
            document.getElementById("all-answers").innerHTML += responseJson.html;
            // answer_counter++;
            addEventListeners();
            addCommentEventListeners();
        }
        
        
    }
}

function deleteAnswerHandler(responseJson){


    console.log(responseJson);
    if(responseJson.success){

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';
        
        let deletedElement = document.getElementById("answer-"+ responseJson.answer_id);

        if(deletedElement != undefined){
            deletedElement.parentNode.removeChild(deletedElement);
            // answer_counter--;
        }
    }
    

}

function editAnswerHandler(responseJson){
    console.log(responseJson);

    if(responseJson.success){

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';
        
        let editElement = document.getElementById("answer-content-"+ responseJson.answer_id);
        if(editElement != undefined){
            editElement.innerHTML = responseJson.content;

            let editForm = document.getElementById('edit-answer-'+ responseJson.answer_id);
            let answer = document.getElementById('answer-content-' + responseJson.answer_id);
        
            editForm.classList.toggle('d-none');
            answer.classList.toggle('d-none');
        }
        
    }
}

let debugging = document.getElementById('debuggiiing');
console.log(debugging);


debugging.addEventListener("submit",askPagination);


function askPagination(event) {

    console.log("handling pagination");
    event.preventDefault();

    let counter = document.getElementById("all-answers").childElementCount;

    // Agora é necessário trocar o que está dentro deste if pelo pedido ajax em 

    
    let id = document.querySelector("#submit-answer > input[name=questionID]").value;
    // sendDataAjaxRequest("POST",'/api/question/'+ id + '/scroll', {'page' : page}, handlePagination);
    sendAjaxGetRequest('/api/question/'+ id + '/scroll', {'counter' : counter}, addScroll);
    // checkForNewDiv();
        
    
}

function addScroll() {
    console.log("called this methid");
    

    let response = JSON.parse(this.responseText);
    console.log(response);

    if(response.success){
        document.getElementById("all-answers").innerHTML += response.html;
    }

    
}

function addPagination(){
    console.log(responseJson);
    if(responseJson.success){

        let number_answers = document.getElementById("question-number-answers");
        number_answers.innerHTML = responseJson.number_answers + ' answers';
        
            // Append if the limit as not been reached
        if(responseJson.html != undefined){
            document.getElementById("all-answers").innerHTML += responseJson.html;
            addEventListeners();
            addCommentEventListeners();
        }
        
        
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


// TESTIIIIIING



function checkInfiniteScroll(parentSelector, childSelector) {
  let lastDiv = document.querySelector(parentSelector + childSelector);
  let lastDivOffset = lastDiv.offsetTop + lastDiv.clientHeight;
  let pageOffset = window.pageYOffset + window.innerHeight;

  if(pageOffset > lastDivOffset - 20 ) {
    
    // Agora é necessário trocar o que está dentro deste if pelo pedido ajax em     
    let id = document.querySelector("#submit-answer > input[name=questionID]").value;
    let answerCounter = document.querySelector("#submit-answer > input[name=answerCounter]").value
    
    // sendDataAjaxRequest("POST",'/api/question/'+ id + '/scroll', {'page' : page}, handlePagination);
    let counter = document.getElementById("all-answers").childElementCount;

    console.log(counter);
    console.log(answerCounter);
    if(counter < answerCounter){
        sendAjaxGetRequest('/api/question/'+ id + '/scroll', {'counter' : counter}, addScroll2);
    }
  }
}



function update() {
  //requestAnimationFrame(update);
  
  checkInfiniteScroll("#all-answers", "> div:last-child");

  
//   let checkInterval = 300;

//   let currScrollTime = Date.now();
//   if(lastScrollTime + checkInterval < currScrollTime) {
//     checkInfiniteScroll("#all-answers", "> div:last-child");
//     lastScrollTime = currScrollTime;
//   }
}



function addScroll2() {
    console.log("called this methid");
    

    let response = JSON.parse(this.responseText);
    console.log(response);

    if(response.success){
        // console.log(response.html.children[0]);
        // let firstElement = response.html.querySelector("> 
        // let document.getElementById("answer-");
        document.getElementById("all-answers").innerHTML += response.html;
    }

    //checkInfiniteScroll(parentSelector, childSelector);
    
}



