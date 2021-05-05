
function manageUsers(){
    let userActions =  document.getElementsByClassName('user-actions');

    if(userActions) {
        Array.from(userActions).forEach(userActionForm => { userActionForm.addEventListener('submit', updateUser);});
    }
}

function updateUser(event){
    event.preventDefault();
    let actionValue = this.querySelector('#user-action').value;
    if(actionValue == 'none') return;
    
    let id = this.getAttribute('data-user-id');
        
    if(actionValue == "delete") sendAjaxPostRequest('delete', '/api/admin/user/' + id, null, userDeletedHandler);
    else sendAjaxPostRequest('put', '/api/admin/user/' + id, {action: actionValue}, userUpdatedHandler);
}

function userDeletedHandler(){
    let response = JSON.parse(this.responseText);
    console.log(response);

    let element = document.querySelector('tr[data-user-id="' + response.user.id + '"]');
    element.remove();
}

function userUpdatedHandler(){
    let response = JSON.parse(this.responseText);
    
    if(response.hasOwnProperty('error')){
        // TODO: change to beautiful alert
        alert(response.error);
        return;
    }

    let element = document.querySelector('tr[data-user-id="' + response.id + '"]');
    while (element.children.length > 2) {
        element.removeChild(element.lastChild);
    }

    // Update Available Actions
    element.innerHTML = element.innerHTML + response.html;
    manageUsers();
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

manageUsers();