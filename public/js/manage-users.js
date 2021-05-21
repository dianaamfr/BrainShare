import {encodeForAjax, sendAjaxGetRequest, sendDataAjaxRequest, showAlert} from './common.js';

// Add event listener for each submit action button
function manageUsers(){
    let userActions =  document.getElementsByClassName('user-actions');

    if(userActions) {
        Array.from(userActions).forEach(userActionForm => { userActionForm.addEventListener('submit', updateUser);});
    }
}

// Send update role / ban / delete request with Ajax
function updateUser(event){
    event.preventDefault();
    let actionValue = this.querySelector('.user-action').value;
    if(actionValue == 'none') return;
    
    let id = this.getAttribute('data-user-id');

    sendDataAjaxRequest('put', '/api/admin/user/' + id, {action: actionValue}, userUpdatedHandler);
}

// Handle the response to a request to update the role or the ban status of a user
function userUpdatedHandler(response){
    
    if(response.hasOwnProperty('error')){
        showAlert(response.error, "error", manageUsersAlert);
        return;
    } else if(response.hasOwnProperty('exception')){
        showAlert(response.message , "error", manageUsersAlert);
        return;
    }
    else {
        showAlert(response.success, "success", manageUsersAlert);
    }

    let element = document.querySelector('tr[data-user-id="' + response.id + '"]');
    while (element.children.length > 3) {
        element.removeChild(element.lastChild);
    }

    // Update Available Actions for the updated user
    element.innerHTML = element.innerHTML + response.html;
    element.querySelector('.user-actions').addEventListener('submit', updateUser);
}

function searchUsers(){
    
    if(usernameInput){
        usernameInput.addEventListener('keyup', function(){
            let data = {'search-username': usernameInput.value}
            sendAjaxGetRequest( '/api/admin/user', 
            data, userSearchUpdateHandler)
            window.history.pushState({}, '', '/admin/user?' + encodeForAjax(data));
        });
    } 
}

function userSearchUpdateHandler(){
    let response = JSON.parse(this.responseText);
    userManagementArea.querySelector('#users-table').innerHTML = response.html;

    updateUsersPagination();
    manageUsers();
}

function changeUsersPage(event) {
    event.preventDefault();
    let page = this.href.split('page=')[1]
    let data = {'search-username': usernameInput.value, 'page': page}
  
    sendAjaxGetRequest('/api/admin/user', 
        data, userSearchUpdateHandler)
    window.history.pushState({}, '', '/admin/user?' + encodeForAjax(data));
}

function updateUsersPagination() {
    let pagination = document.querySelectorAll('#users-manage-area .pagination a');
    if(pagination){
        pagination.forEach(paginationLink => { paginationLink.addEventListener('click', changeUsersPage);});
    }
}

let usernameInput = document.getElementById('search-username');
let manageUsersAlert = document.getElementById('manage-users-alert');
let userManagementArea = document.getElementById('users-manage-area');
manageUsers();
searchUsers();
updateUsersPagination();