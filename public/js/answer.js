import {sendAjaxGetRequest, sendDataAjaxRequest, encodeForAjax} from "./common.js"; 

function submitAnswer(event){

    event.preventDefault();
    console.log("begin");


    let text = this.querySelector('textarea[name="content"]').value;
    let id = this.querySelector('input[name="questionID"]').value;
    console.log(text);
    console.log(id);

    //sendAjaxPostRequest("POST",'/api/question/' + id + '/answer/add',{'text':text},handler); 

    sendDataAjaxRequest("POST",'/api/question/'+ id + '/answer', {'text':text}, handler);

    console.log("sent request");

}

function handler(responseJson){
    console.log("RESPONSE SUCESSFULLY REACHED THIS POINT");
    console.log(responseJson);
    console.log(responseJson.html);
}

let form = document.getElementById('submit-answer');

form.addEventListener("submit",submitAnswer);


//import {sendDataAjaxRequest} from "./common.js";

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




