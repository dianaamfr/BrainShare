import {tooltipLoad, setConfirmationModal} from './common.js';

let modal = new bootstrap.Modal(document.querySelector('.confirmationModal'));
let deleteForm = document.getElementById('delete-account-form');

deleteForm.addEventListener('submit', deleteAccount);

tooltipLoad();

function deleteAccount(event){
    event.preventDefault();
    setConfirmationModal('Delete Account', 'Are you sure you want to delete your account?', submitDeleteAccount, modal);  
}

function submitDeleteAccount(){
    deleteForm.submit();
}