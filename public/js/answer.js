import {sendAjaxRequest} from "./common.js";

addEvenListeners();

function addEvenListeners(){

    console.log("Entered Loop");

    let form = document.getElementById('submit-answer');
    let addButton = form.querySelector("button"); 

    //let editDeleteForm = document.getElementsByClassName()
    //let deleteButton = form.querySelector("");

    console.log(form);
    console.log(button);


    // POST method
    // EventListener for adding an answer
    // Falta só meter o botão de edit em condições
    
    addButton.addEventListener('click',function(event){

        event.preventDefault();

        let text = form.querySelector('textarea').value; // testar .textContent se value não der
        let id = form.querySelector("input[name='questionID']").value;

        console.log(text);
        console.log(id);

        sendAjaxRequest('post','/api/question/' + id + '/answer/add',{text: text},submitAnswerHandler);

    });
    
    // PUT method
    // EventListener for Editing an answer
    addEventListener('click',function(event){
        event.preventDefault();

    
    });
    
    // Get method
    // EventListener for Removing an answer
    
    addEventListener('click',function(event){

        
        event.preventDefault();


    });
    


}

/**
 * Handler for the submit answer put form
 * This function get's the value of query parameters
 * @param response {Array} Json array containing the answers to the question
 */

function submitAnswerHandler(response) {

    console.log(response);
    let div = document.getElementById("all-answers");
    div.innerHTML = response;


}

function createAnswer(text){
    let answersDiv = document.querySelector('#page-top section.answers div.answer' );

}
