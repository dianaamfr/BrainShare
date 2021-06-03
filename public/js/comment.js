import {sendDataAjaxRequest, sendAjaxGetRequest, setConfirmationModal, tooltipLoad, showToast} from "./common.js";
import {listenReportFlag} from './report.js';

tooltipLoad();
addCommentEventListeners();

let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));

export function addCommentEventListeners(){
    
    // Add Comment
    let comments = document.querySelectorAll('.submit-comments');
    comments.forEach(element => element.addEventListener('submit',addComment));

    // Delete Comment
    let deleteCommentButtons = document.querySelectorAll('.comment-delete-form');
    deleteCommentButtons.forEach(element => element.addEventListener('submit',deleteComment));

    // Edit Comment
    let editCommentButtons = document.querySelectorAll('.comment-edit-form');
    editCommentButtons.forEach(element => element.addEventListener('submit',showEditCommentForm));

    let edit = document.querySelectorAll(".submit-edit-comments");
    edit.forEach(element => element.addEventListener('submit',submitEdit));


    let cancelEdit = document.querySelectorAll(".submit-edit-comments button[type=button]");
    cancelEdit.forEach(element => element.addEventListener('click',cancelEditComment));

    let loadMoreComments = document.querySelectorAll(".add-more-comments");
    loadMoreComments.forEach(element => element.addEventListener('click',loadComments));

}


function addComment(event){

    event.preventDefault();

    let answerID = this.querySelector('input[name="answerID"]').value;
    let textElement = this.querySelector('textarea[name="content"]');
    let text = textElement.value;
    textElement.value = "";

    let counter = document.getElementById("comments-answer-" + answerID).childElementCount;

    sendDataAjaxRequest("POST",'/api/answer/'+ answerID + '/comment', {'text':text, 'counter':counter}, addCommentHandler);

}

function deleteComment(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;

    setConfirmationModal(
        'Delete Comment',
        'Are you sure you want to delete this Comment?',
        function() {       
        sendDataAjaxRequest("delete",'/api/comment/' + commentID, null, deleteAnswerHandler)
         },
        modal);

}

// Falta dar fix ao css de modo a que consiga ir buscar o texto
function submitEdit(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;
    let text = this.querySelector('textarea').value;

    sendDataAjaxRequest("put",'/api/comment/'+ commentID,{'text':text}, editAnswerhandler);
}

function showEditCommentForm(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;
    toggleEditForm(commentID);

}

function cancelEditComment(){

    let commentID = this.name;
    toggleEditForm(commentID);

}

function toggleEditForm(commentID){
    let hiddenForm = document.getElementById('submit-edit-comments-' + commentID);
    let comment = document.getElementById('display-comment-' + commentID);

    hiddenForm.classList.toggle('d-none');
    comment.classList.toggle('d-none');
}



function loadComments(event){
    event.preventDefault();

    let answerID = this.value;
    let counter = document.getElementById("comments-answer-" + answerID).childElementCount;

    sendAjaxGetRequest('/api/answer/'+ answerID + '/comment', {'counter':counter}, loadCommentHandler);
    
}

function addCommentHandler(responseJson){

    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to add a Comment","red");
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red");
        return;
    }

    if(responseJson.success){
        
        let number_comments = document.getElementById("answer-"+ responseJson.answer_id +"-number-comments");
        number_comments.innerHTML = responseJson.number_comments + " Comments";

        if(responseJson.html != undefined){
            let comments = document.getElementById('comments-answer-' + responseJson.answer_id);
            comments.innerHTML = responseJson.html + comments.innerHTML;

            addCommentEventListeners();
            tooltipLoad();
        }

        
    }
}

function editAnswerhandler(responseJson){
    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to edit a Comment","red")
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red")
        return;
    }

    if(responseJson.success){

        let comment = document.getElementById('show-edit-comment-' + responseJson.comment_id);
        comment.innerHTML = responseJson.content;

        let commentEdit = document.querySelector('#submit-edit-comments-' + responseJson.comment_id + ' textarea');
        commentEdit.innerHTML = responseJson.content;

        toggleEditForm(responseJson.comment_id);
        addCommentEventListeners();
        tooltipLoad();
    }
}


function deleteAnswerHandler(responseJson){
    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to delete a Comment","red")
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red")
        return;
    } else if(responseJson.success){

        let comment = document.getElementById('comment-' + responseJson.comment_id);
        comment.parentNode.removeChild(comment);

        let number_comments = document.getElementById("answer-"+ responseJson.answer_id +"-number-comments");
        number_comments.innerHTML = responseJson.number_comments + " Comments";

        addCommentEventListeners();
        tooltipLoad();
    }
    
}


function loadCommentHandler(){

    
    let response = JSON.parse(this.responseText);
    
    if (response.success) {

        let commentSection = document.getElementById("comments-answer-" + response.answer_id);
        commentSection.innerHTML = commentSection.innerHTML + response.html;

        let button = document.getElementById("load-comments-answer-" + response.answer_id);
        button.parentNode.removeChild(button);

        addCommentEventListeners();
        listenReportFlag();
        tooltipLoad();
    }
}



