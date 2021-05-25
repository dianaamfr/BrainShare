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
    editList.forEach(addEditListeners);

    // console.log(editButtons);
    // console.log(deleteButtons);

}



function addDeleteListeners(element){
    element.addEventListener('submit',removeAnswer);
}

function addEditListeners(element){
    element.addEventListener('submit',editAnswer);
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

    //let questionID = this.querySelector('input[name="questionID"]').value;
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
    let text = this.querySelector('input[name="dummyText"]').value;

    console.log(this);
    //console.log(questionID);
    console.log(answerID);
    console.log(text);


    sendDataAjaxRequest("put",'/api/answer/'+ answerID + '/edit',{'text':text}, handler);
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




