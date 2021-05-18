//import {sendDataAjaxRequest} from "./common.js";


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

        let text = form.querySelector('textarea').value; // testar .textContent se value não der
        let id = form.querySelector("input[name='questionID']").value;

        console.log(text);
        console.log(id);

        sendDataAjaxRequest('post','/api/question/' + id + '/answer/add',{text: 'hello'},submitAnswerHandler);

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
    */
    


}

/**
 * Handler for the submit answer put form
 * This function get's the value of query parameters
 * @param response {Array} Json array containing the answers to the question
 */
function submitAnswerHandler(response) {
    console.log("here");
    console.log(response);
    let div = document.getElementById("all-answers");
    div.innerHTML = response;


}

function createAnswer(text){
    let answersDiv = document.querySelector('#page-top section.answers div.answer' );

}


function sendDataAjaxRequest(method, url, data, handleResponse) {
    let dataJson = JSON.stringify(data);
    fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Request-With': "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            method: method,
            credentials: 'same-origin',
            body: dataJson
        },
    ).then(json => handleResponse(response));
}

