import {sendDataAjaxRequest, sendAjaxGetRequest, setConfirmationModal, tooltipLoad, showToast} from "./common.js";
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

    // sendDataAjaxRequest("POST",'/api/answer/'+ answerID + '/comment', {'text':text, 'counter':counter}, addAnswerHandler);

}

function deleteComment(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;

    setConfirmationModal(
        'Delete Answer',
        sendDataAjaxRequest("delete",'/api/comment/' + commentID, null, deleteAnswerHandler));

}

function editComment(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;
    let text = this.querySelector('input[name="dummyText"]').value;

    sendDataAjaxRequest("put",'/api/comment/'+ commentID,{'text':text}, editAnswerhandler);
}

function showEditCommentForm(event){

    event.preventDefault();    

    let commentID = this.querySelector('input[name="commentID"]').value;
    let hiddenForm = document.getElementById('submit-edit-comments-' + commentID);
    let comment = document.getElementById('comment-' + commentID);

    hiddenForm.classList.toggle('d-none');
    comment.classList.toggle('d-none');

}

function cancelEditComment(event){

    event.preventDefault();

    let commentID = this.name;
    let hiddenForm = document.getElementById('submit-edit-comments-' + commentID);
    let comment = document.getElementById('comment-' + commentID);


    hiddenForm.classList.toggle('d-none');
    comment.classList.toggle('d-none');


}


// Falta dar fix ao css de modo a que consiga ir buscar o texto
function submitEdit(event){

    event.preventDefault();

    let commentID = this.querySelector('input[name="commentID"]').value;
    let text = this.querySelector('textarea').value;

    sendDataAjaxRequest("put",'/api/comment/'+ commentID,{'text':text}, handler);
}

function loadComments(event){
    event.preventDefault();

    let answerID = this.value;
    let counter = document.getElementById("comments-answer-" + answerID).childElementCount;

    sendAjaxGetRequest('/api/answer/'+ answerID + '/comments', {'counter':counter}, loadCommentHandler);

    
}

function addAnswerHandler(responseJon){
    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to add a Comment","red")
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red")
        return;
    }

    if(responseJson.success){
        let comments = document.getElementById('comments-answer-' + responseJson.answer_id);

        answer.innerHTML += responseJson.html;

        let number_comments = document.getElementById("answer-"+ responseJson.answer_id +"-number-comments");
        number_comments.innerHTML = responseJson.number_comments + " Comments";

        addCommentEventListeners();
        tooltipLoad();
    }
}

function editAnswerhandler(responseJon){
    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to edit a Comment","red")
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red")
        return;
    }

    if(responseJson.success){

        let comment = document.getElementById('show-edit-comment-' + responseJson.comment_id);
        comment.innerHTML += responseJson.html;

        let commentEdit = document.querySelector('#submit-edit-comments' + responseJson.comment_id + ' textarea');
        commentEdit.innerHTML += responseJson.html;

        let number_comments = document.getElementById("answer-"+ responseJson.answer_id +"-number-comments");
        number_comments.innerHTML = responseJson.number_comments + " Comments";

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

function handler(responseJson){

    // need to receive the answerID in the request
    // then, all comments for that answer should be refreshed

    if(responseJson.hasOwnProperty('error')){
        showToast("An error occured while attempting to add a Comment","red")
        return;
    } else if(responseJson.hasOwnProperty('exception')){
        showToast("Unauthorized Operation\nLogin may be necessary","red")
        return;
    }

    if(responseJson.success){
        let answer = document.getElementById('comments-answer-' + responseJson.answer_id);

        answer.innerHTML = responseJson.html;

        let number_comments = document.getElementById("answer-"+ responseJson.answer_id +"-number-comments");
        number_comments.innerHTML = responseJson.number_comments + " Comments";

        addCommentEventListeners();
        tooltipLoad();
    }
}

function loadCommentHandler(){

    
    let response = JSON.parse(this.responseText);
    console.log(response);
    if (response.success) {

        let commentSection = document.getElementById("comments-answer-" + response.answer_id);
        commentSection.innerHTML += response.html;

        let button = document.getElementById("load-comments-answer-" + response.answer_id);
        button.parentNode.removeChild(button);

        addCommentEventListeners();
        tooltipLoad();
    }
}



