import {sendDataAjaxRequest} from "./common.js"; 

window.addEventListener('load', addCommentEventListeners);

export function addCommentEventListeners(){
    // Add Comment
    let comments = document.getElementsByClassName('submit-comments');
    let commentsList = [...comments];
    commentsList.forEach(addCommentEventListener);

    // Delete Comment
    let deleteCommentButtons = document.getElementsByClassName('comment-delete-form');
    let deleteCommentButtonsList = [...deleteCommentButtons];
    deleteCommentButtonsList.forEach(deleteCommentEventListener);

    // Edit Comment
    let editCommentButtons = document.getElementsByClassName('comment-edit-form');
    let editCommentButtonsList = [...editCommentButtons];
    editCommentButtonsList.forEach(editCommentEventListener);
    
    // console.log(comments);
    // console.log(commentsList);

    // console.log(deleteCommentButtons);
    // console.log(deleteCommentButtonsList);

    // console.log(editCommentButtons);
    // console.log(editCommentButtonsList);
}



function addCommentEventListener(element){
    element.addEventListener('submit',addComment);
}

function deleteCommentEventListener(element){
    element.addEventListener('submit',deleteComment);
}

function editCommentEventListener(element){
    element.addEventListener('submit',editComment);
}


function addComment(event){

    event.preventDefault();

    // let questionID = this.querySelector('input[name="questionID"]').value;
    let answerID = this.querySelector('input[name="answerID"]').value;
    let textElement = this.querySelector('textarea[name="content"]')
    let text = textElement.value;
    textElement.value = "";

    console.log(text);
    console.log(textElement);



    // console.log(questionID);
    console.log(answerID);
    console.log(text);

    




    sendDataAjaxRequest("POST",'/api/answer/'+ answerID + '/comment/add', {'text':text}, handler);
    
}

function deleteComment(event){

    event.preventDefault();

    // let questionID = this.querySelector('input[name="questionID"]').value;
    let commentID = this.querySelector('input[name="commentID"]').value;

    // console.log(questionID);
    console.log(commentID);

    sendDataAjaxRequest("delete",'/api/comment/' + commentID + '/delete', null, handler);
    
}

// Falta dar fix ao css de modo a que consiga ir buscar o texto
function editComment(event){

    event.preventDefault();

    //let questionID = this.querySelector('input[name="questionID"]').value;
    let commentID = this.querySelector('input[name="commentID"]').value;
    //let text = this.querySelector('textarea[name="content"]').value;
    //let text = "hello my friend"
    let text = this.querySelector('input[name="dummyText"]').value;

    console.log(this);
    //console.log(questionID);
    console.log(commentID);
    console.log(text);


    sendDataAjaxRequest("put",'/api/comment/'+ commentID + '/edit',{'text':text}, handler);
}

function handler(responseJson){

    // need to receive the answerID in the request
    // then, all comments for that answer should be refreshed
    console.log(responseJson);
    if(responseJson.success){
        let answer = document.getElementById('comments-answer-' + responseJson.answer_id);
        console.log(answer);
        answer.innerHTML = responseJson.html;

        let number_comments = document.getElementById("answer-"+ responseJson.answer_id +"-number-comments"); 
        number_comments.innerHTML = responseJson.number_comments + " Comments";

        // modificar isto para não refrescar tudo, mas apenas o modificado?
        addCommentEventListeners();
    }
    
    
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

