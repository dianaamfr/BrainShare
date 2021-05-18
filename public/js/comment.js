import {encodeForAjax, sendAjaxRequest} from "./common.js";

addEvenListeners();

function addEvenListeners(){

    
    let forms = document.getElementsByClassName("submit-comment");


    // POST method
    // EventListener for adding an answer
    form.forEach(element => {

        element.addEventListener('submit',function(event){

            event.preventDefault();
    
            let text = element.querySelector('textarea').value; // testar .textContent se value não der
            let questionID = element.querySelector('input[type="hidden"]').value;
            let answerID = element.parent.parentNode.id.split("-")[1];
    
            // Preciso de somehow obter o id da answer
            sendAjaxRequest('post','/api/question/' + questionID + '/answer/' + answerID, {text: text},submitCommentHandler);
            
        });
    });

    /*
    // PUT method
    // EventListener for Editing an answer
    addEventListener('click',function(event){
        event.preventDefault();

    
    });
    */
    /*
    // Get method
    // EventListener for Removing an answer
    addEventListener('click',function(event){

        // Não tenho a certeza se é preciso o preventDefault
        event.preventDefault();


    });
    */

}

/**
 * Handler for the submit answer put form
 * This function get's the value of query parameters
 * @param response {Array} Json array containing the answers to the question
 */
function submitCommentHandler(response) {

    console.log(response);
    let div = document.getElementById("question-comments");
    div.innerHTML = response;
}

