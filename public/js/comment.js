import {sendDataAjaxRequest, setConfirmationModal, tooltipLoad} from "./common.js"; 

tooltipLoad();
addCommentEventListeners();
let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));

export function addCommentEventListeners(){
    // Add Comment
    let comments = Array.from(document.getElementsByClassName('submit-comments'));
    comments.forEach(addCommentEventListener);

    // Delete Comment
    let deleteCommentButtons = Array.from(document.getElementsByClassName('comment-delete-form'));
    deleteCommentButtons.forEach(deleteCommentEventListener);

    // Edit Comment
    let editCommentButtons = Array.from(document.getElementsByClassName('comment-edit-form'));
    editCommentButtons.forEach(editCommentEventListener);

    let edit = Array.from(document.getElementsByClassName("submit-edit-comments"));
    edit.forEach(editEventListener);

    let cancelEdit = Array.from(document.querySelectorAll(".submit-edit-comments button[type=button]"));
    cancelEdit.forEach(cancelEventListener);
    
}

function addCommentEventListener(element){
    element.addEventListener('submit',addComment);
}

function deleteCommentEventListener(element){
    element.addEventListener('submit',deleteComment);
}

function editCommentEventListener(element){
    element.addEventListener('submit',editComment2);
}

function editEventListener(element){
    element.addEventListener('submit',submitEdit);
}

function cancelEventListener(element){
    element.addEventListener('click',cancelEditComment);
}


function addComment(event){

    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;
    let textElement = this.querySelector('textarea[name="content"]')
    let text = textElement.value;
    textElement.value = "";

    sendDataAjaxRequest("POST",'/api/answer/'+ answerID + '/comment/add', {'text':text}, handler);
    
}

function deleteComment(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;

    setConfirmationModal(
        'Delete Answer', 
        'Are you sure you want to delete this Answer?', 
        function(){
            sendDataAjaxRequest("delete",'/api/comment/' + commentID + '/delete', null, handler);
        }, modal);  
    
}

// Falta dar fix ao css de modo a que consiga ir buscar o texto
function editComment(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;
    let text = this.querySelector('input[name="dummyText"]').value;

    sendDataAjaxRequest("put",'/api/comment/'+ commentID + '/edit',{'text':text}, handler);
}

function editComment2(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;
    let hiddenForm = document.getElementById('submit-edit-comments-' + commentID);
    let comment = document.getElementById('comment-' + commentID);

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

    let commentID = this.querySelector('input[name="commentID"]').value;
    let text = this.querySelector('textarea').value;

    sendDataAjaxRequest("put",'/api/comment/'+ commentID + '/edit',{'text':text}, handler);
}

function handler(responseJson){

    // need to receive the answerID in the request
    // then, all comments for that answer should be refreshed

    if(responseJson.success){
        let answer = document.getElementById('comments-answer-' + responseJson.answer_id);
  
        answer.innerHTML = responseJson.html;

        let number_comments = document.getElementById("answer-"+ responseJson.answer_id +"-number-comments"); 
        number_comments.innerHTML = responseJson.number_comments + " Comments";

        // modificar isto para não refrescar tudo, mas apenas o modificado?
        addCommentEventListeners();
        tooltipLoad();
    }
    
    
}



