
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

    if(actionValue == "delete"){
        let page = document.querySelector('.page-item.active[aria-current=page] span.page-link').innerHTML;
        
        sendAjaxPostRequest('delete', '/api/admin/user/' + id, {page: page}, userDeletedHandler);
        window.history.pushState({}, '', '/admin/user?' + encodeForAjax({page: page}));
    }
    else {
        sendAjaxPostRequest('put', '/api/admin/user/' + id, {action: actionValue}, userUpdatedHandler);
    }
}

// Handle the response to a request to the deletion of a user
function userDeletedHandler(){
    let response = JSON.parse(this.responseText);

    if(response.hasOwnProperty('error')){
        showAlert(response.error, "error");
        return;
    } else {
        showAlert(response.success, "success");
    }

    userManagementArea.querySelector('#users-table').innerHTML = response.html;
    updateUsersPagination();
    manageUsers();
}

// Handle the response to a request to update the role or the ban status of a user
function userUpdatedHandler(){
    let response = JSON.parse(this.responseText);
    
    if(response.hasOwnProperty('error')){
        showAlert(response.error, "error");
        return;
    } else {
        showAlert(response.success, "success");
    }

    let element = document.querySelector('tr[data-user-id="' + response.id + '"]');
    while (element.children.length > 3) {
        element.removeChild(element.lastChild);
    }

    // Update Available Actions for the updated user
    element.innerHTML = element.innerHTML + response.html;
    element.querySelector('.user-actions').addEventListener('submit', updateUser);
}

// Show success or error alert on the screen when the response to an action is received
function showAlert(message, type){ 
    let alert = document.createElement('div');
    alert.classList.add('alert','alert-dismissible','fade','show');
    alert.innerHTML = message;

    let closeBtn = document.createElement('button');
    closeBtn.classList.add('btn-close');
    closeBtn.setAttribute('data-bs-dismiss', 'alert');

    alert.appendChild(closeBtn);

    if(type == "error"){
        alert.classList.remove('alert-success');
        alert.classList.add('alert-danger');
    }
    else {
        alert.classList.remove('alert-danger')
        alert.classList.add('alert-success');
    }

    manageUsersAlert.innerHTML = '';
    manageUsersAlert.appendChild(alert);
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxPostRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();
  
    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}

function sendAjaxGetRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();
    
    request.open(method, url + '?' + encodeForAjax(data), true);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.addEventListener('load', handler);
    request.send();
}

function searchUsers(){
    if(usernameInput){
        usernameInput.addEventListener('keyup', function(){
            sendAjaxGetRequest('get', '/api/admin/user', 
            {'search-username': usernameInput.value}, userSearchUpdateHandler)
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
    data = {'search-username': usernameInput.value, 'page': page}
    sendAjaxGetRequest('get', '/api/admin/user', 
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
let userManagementArea = document.getElementById('users-manage-area')
manageUsers();
searchUsers();
updateUsersPagination();