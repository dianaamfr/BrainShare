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


    let edit = document.getElementsByClassName("submit-edit-comments");
    let editButtonList = [...edit];
    editButtonList.forEach(editEventListener);


    let cancelEdit = document.querySelectorAll(".submit-edit-comments button[type=button]");
    let cancelEditList = [...cancelEdit];
    cancelEditList.forEach(cancelEventListener);
    
    // console.log(comments);
    // console.log(commentsList);

    // console.log(deleteCommentButtons);
    // console.log(deleteCommentButtonsList);

    // console.log(editCommentButtons);
    // console.log(editCommentButtonsList);
    // console.log(cancelEdit);
    // console.log(cancelEditList);
}



function addCommentEventListener(element){
    element.addEventListener('submit',addComment);
}

function deleteCommentEventListener(element){
    element.addEventListener('submit',deleteComment);
}

// function editCommentEventListener(element){
//     element.addEventListener('submit',editComment);
// }

function editCommentEventListener(element){
    element.addEventListener('submit',editComment2);
}

function editEventListener(element){
    element.addEventListener('submit',submitEdit);
}

function cancelEventListener(element){
    console.log(element);
    element.addEventListener('click',cancelEditComment);
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

    




    sendDataAjaxRequest("POST",'/api/answer/'+ answerID + '/comment', {'text':text}, handler);
    
}

function deleteComment(event){

    event.preventDefault();

    // let questionID = this.querySelector('input[name="questionID"]').value;
    let commentID = this.querySelector('input[name="commentID"]').value;

    // console.log(questionID);
    console.log(commentID);

    sendDataAjaxRequest("delete",'/api/comment/' + commentID, null, handler);
    
}

// Falta dar fix ao css de modo a que consiga ir buscar o texto
function editComment(event){

    event.preventDefault();

    //let questionID = this.querySelector('input[name="questionID"]').value;
    let commentID = this.querySelector('input[name="commentID"]').value;
    let text = this.querySelector('input[name="dummyText"]').value;

    console.log(this);
    console.log(commentID);
    console.log(text);


    sendDataAjaxRequest("put",'/api/comment/'+ commentID,{'text':text}, handler);
}

function editComment2(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;
    let hiddenForm = document.getElementById('submit-edit-comments-' + commentID);
    let comment = document.getElementById('comment-' + commentID);
    
    console.log(commentID);

    if(hiddenForm.style.display == 'none'){
        hiddenForm.style.display = 'block';
        comment.style.display = 'none';
    }
    else if (comment.style.display == 'none' ){
        hiddenForm.style.display = 'none';
        comment.style.display = 'block';
    }

}

function cancelEditComment(event){

    event.preventDefault();

    let commentID = this.name;
    let hiddenForm = document.getElementById('submit-edit-comments-' + commentID);
    let comment = document.getElementById('comment-' + commentID);

    // This block is not necessary 
    if(hiddenForm.style.display == 'none'){
        hiddenForm.style.display = 'block';
        comment.style.display = 'none';
    }
    else if (comment.style.display == 'none' ){
        hiddenForm.style.display = 'none';
        comment.style.display = 'block';
    }

}


// Falta dar fix ao css de modo a que consiga ir buscar o texto
function submitEdit(event){

    event.preventDefault();

    //let questionID = this.querySelector('input[name="questionID"]').value;
    let commentID = this.querySelector('input[name="commentID"]').value;
    //let text = this.querySelector('textarea[name="content"]').value;
    //let text = "hello my friend"
    let text = this.querySelector('textarea').value;

    console.log(this);
    //console.log(questionID);
    console.log(commentID);
    console.log(text);


    sendDataAjaxRequest("put",'/api/comment/'+ commentID,{'text':text}, handler);
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



