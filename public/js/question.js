
import {tooltipLoad, setConfirmationModal} from './common.js';

let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));
let deleteForms = document.querySelectorAll('.delete-question-form');

deleteForms.forEach(form => form.addEventListener('submit', deleteQuestion));

tooltipLoad();

function deleteQuestion(event){
    event.preventDefault();
    setConfirmationModal('Delete Question', 'Are you sure you want to delete this Question?', submitDeleteQuestion, modal);  
}

function submitDeleteQuestion(){
    deleteForms[0].submit();
}