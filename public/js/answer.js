import {sendDataAjaxRequest} from "./common.js"; 

// Add Answer
let form = document.getElementById('submit-answer');
form.addEventListener("submit",submitAnswer);

// Delete Answer
let deleteButtons = document.getElementsByClassName('answer-delete-form');
let deletionList = [...deleteButtons];
deletionList.forEach(addDeleteListeners);

// Edit Answer
let editButtons = document.getElementsByClassName('answer-edit-form');
let editList = [...editButtons];
editList.forEach(addEditListeners);


function addDeleteListeners(element){
    element.addEventListener('submit',removeAnswer);
}

function addEditListeners(element){
    element.addEventListener('submit',editAnswer);
}


function submitAnswer(event){

    event.preventDefault();

    let text = this.querySelector('textarea[name="content"]').value;
    let id = this.querySelector('input[name="questionID"]').value;


    sendDataAjaxRequest("POST",'/api/question/'+ id + '/answer', {'text':text}, handler);

}

function removeAnswer(event){

    // Not sure if this is needed, check later
    event.preventDefault();

    let questionID = this.querySelector('input[name="questionID"]').value;
    let answerID = this.querySelector('input[name="answerID"]').value;

    console.log(this);
    console.log(questionID);
    console.log(answerID);

    //Route::delete('/api/question/{id-q}/answer/{id-a}
    // Preciso de ti Juliane para limpar as routes, que não sei porque é que não está a encontrar este path
    sendDataAjaxRequest("DELETE",'api/question/'+ questionID +'/answer/'+ answerID, {'dummy':'1'}, handler);
    

}


function editAnswer(event){

    event.preventDefault();

    let questionID = this.querySelector('input[name="questionID"]').value;
    let answerID = this.querySelector('input[name="answerID"]').value;
    let text = this.querySelector('textarea[name="content"]').value;

    console.log(this);
    console.log(questionID);
    console.log(answerID);


    sendDataAjaxRequest("PUT",'api/question/' + questionID + '/answer' + answerID,{'text':text}, handler);
}


function handler(responseJson){

    console.log(responseJson);
    let answers = document.getElementById('all-answers');
    answers.innerHTML = responseJson.html;
    
}


/*

addEventListeners();

function addEventListeners(){

    console.log("Entered Loop");

    let form = document.getElementById('submit-answer');
    let addButton = form.querySelector("button"); 

    //let editDeleteForm = document.getElementsByClassName()
    //let deleteButton = form.querySelector("");

    console.log(form);
    console.log(addButton);
    console.log("saved");


    // POST method
    // EventListener for adding an answer
    // Falta só meter o botão de edit em condições
    
    addButton.addEventListener('click',function(event){

        event.preventDefault();

        let content = form.querySelector('textarea').value; // testar .textContent se value não der
        let id = form.querySelector("input[name='questionID']").value;

        console.log(content);
        console.log(id);

        sendDataAjaxRequest('post','/api/question/' + id + '/answer/add',{content: 'hello',},requestHandler);

    });
    

    /*
    // PUT method
    // EventListener for Editing an answer
    addEventListener('click',function(event){
        event.preventDefault();

    
    });
    */
    // Get method
    // EventListener for Removing an answer
    /*
    addEventListener('click',function(event){

        
        event.preventDefault();


    });
    
    


}


function requestHandler(json) {
    console.log("here");
    console.log(response);
    let div = document.getElementById("all-answers");
    div.innerHTML = json.html;


}
*/




