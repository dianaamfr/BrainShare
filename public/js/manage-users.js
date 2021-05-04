let userActions =  document.getElementsByClassName('user-actions');

if(userActions) {
    Array.from(userActions).forEach(userActionForm => { userActionForm.addEventListener('submit', updateUser);});
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
    if (this.status != 200) return;
    let user = JSON.parse(this.responseText);
    let element = document.querySelector('tr[data-user-id="' + user.id + '"]');
    element.remove();
}

function userUpdatedHandler(){
    if (this.status != 200) return;
    let user = JSON.parse(this.responseText);
    let element = document.querySelector('tr[data-user-id="' + user.id + '"]');

    element.querySelector('.ban-td').innerHTML = (user.ban == 1) ? 'T' : 'F';
    element.querySelector('.role-td').innerHTML = (user.user_role == 'RegisteredUser') ? 'Registered User' : user.user_role;

    // TODO: Update Available Actions
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
