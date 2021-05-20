import {sendDataAjaxRequest} from "./common.js"; 

// Add Comment
let comments = document.getElementsByClassName('submit-comment-form');
let commentsList = [...comments];
commentsList.forEach(addCommentEventListener);

// Delete Comment

let deleteCommentButtons = document.getElementsByClassName('delete-comment-form');
let deleteCommentButtonsList = [...deleteCommentButtons];
deleteCommentButtonsList.forEach(deleteCommentEventListener);

function addCommentEventListener(element){
    element.addEventListener('submit',addComment);
}

function deleteCommentEventListener(element){
    element.addEventListener('submit',deleteComment);
}

// Edit Comment

function addComment(event){

    event.preventDefault();

    // let questionID = this.querySelector('input[name="questionID"]').value;
    let answerID = this.querySelector('input[name="answerID"]').value;
    let text = this.querySelector('textarea[name="content"]').value;


    // console.log(questionID);
    console.log(answerID);
    console.log(text);

    sendDataAjaxRequest("POST",'/api/answer/'+ answerID + '/' + answerID + 'comment/add', {'text':text}, handler);
    
}

function deleteComment(event){

    event.preventDefault();

    // let questionID = this.querySelector('input[name="questionID"]').value;
    let commentID = this.querySelector('input[name="commentID"]').value;
    let text = this.querySelector('textarea[name="content"]').value;


    // console.log(questionID);
    console.log(answerID);
    console.log(text);

    sendDataAjaxRequest("PUT",'/api/comment/' + commentID, {'text':text}, handler);
    
}

function handler(responseJson){

    // need to receive the answerID in the request
    // then, all comments for that answer should be refreshed
    console.log(responseJson);
    let answer = document.getElementById('comment-' + responseJson.commentID);
    answer.innerHTML = responseJson.html;
    
}

/*

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
            sendAjaxRequest('post','/api/question/' + questionID + '/answer/' + answerID, {text: 'hello'},submitCommentHandler);
            
        });
    });

    
    // PUT method
    // EventListener for Editing an answer
    addEventListener('click',function(event){
        event.preventDefault();

    
    });
    
    
    // Get method
    // EventListener for Removing an answer
    addEventListener('click',function(event){

        // Não tenho a certeza se é preciso o preventDefault
        event.preventDefault();


    });
    

}

function submitCommentHandler(response) {

    console.log(response);
    let div = document.getElementById("question-comments");
    div.innerHTML = response;
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
    ).then(response => response.json()).then(json => handleResponse(json));
}

*/

