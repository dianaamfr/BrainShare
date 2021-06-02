import {sendDataAjaxRequest, sendAjaxGetRequest} from './common.js';

let CURRENT_PAGE = 1;

// --- Open Notifications --- //
function loadNotifications() {
    CURRENT_PAGE = 1;

    let data = {
        'page': CURRENT_PAGE,
    };
    
    sendAjaxGetRequest('/api/notification', data, requestNotificationsHandler);
    updateNotifications();
}

if(document.querySelector('.notification-open') != null) {
    let open = document.querySelector('.notification-open');
    open.addEventListener('click', loadNotifications);
}

// --- Close Notifications --- //
function closeNotifications() {
    CURRENT_PAGE = 1;

    let goalDiv = document.querySelector('.goal-notification');
    goalDiv.innerHTML = "";

    if(document.querySelector('.show-more-notifications')) {
        let button = document.querySelector('.show-more-notifications');
        button.remove();
    }
}

if(document.querySelector('.notification-close') != null) {
    let open = document.querySelector('.notification-close');
    open.addEventListener('click', closeNotifications);
    document.addEventListener('hidden.bs.modal', closeNotifications);
}


// --- Delete Notification --- //
function deleteHandler(json) {
    if(json.success) {
        let obj = document.getElementById("notification-" + json.id);
        obj.remove();
    }
    
    let goalDiv = document.querySelector('.goal-notification');
    if(json.response) {
        goalDiv.innerHTML += json.response;
    }

    if(json.lastPage == CURRENT_PAGE) {
        if(document.querySelector('.show-more-notifications')) {
            let button = document.querySelector('.show-more-notifications');
            button.remove();

            goalDiv.innerHTML += `<p class="mb-2 mt-2 text-center" >No more notifications to be displayed</p>`;
        }
    }
    
    updateNotifications();
}

function deleteNotification(notificationId) {
    let data = {
        'id': notificationId,
        'page': CURRENT_PAGE,
    };

    sendDataAjaxRequest('DELETE', '/api/notification/' + notificationId, data, deleteHandler);
}


// ---  Mark as Read Notification --- //
function readHandler(json) {
    if(json.viewed) {
        let elem = document.getElementById("viewed-" + json.id);
        elem.remove();
    } else {
        let elem = document.getElementById("notifcation-info-" + json.id);
        elem.innerHTML += "<i id=\"viewed-"+ json.id + "\" class=\"fas fa-circle ms-auto\"></i>"
    }
}

function markRead(notificationId) {
    let data = {
        'id': notificationId,
    };

    sendDataAjaxRequest('POST', '/api/notification/' + notificationId, data, readHandler);
}

// --- Notification infinite scroll --- //
function requestNotificationsHandler() {

    let json = JSON.parse(this.responseText);

    let goalDiv = document.querySelector('.goal-notification');
    goalDiv.innerHTML += json.response;

    if(json.lastPage == CURRENT_PAGE) {
        if(document.querySelector('.show-more-notifications')) {
            let button = document.querySelector('.show-more-notifications');
            button.remove();
        }
        goalDiv.innerHTML += `<p class="mb-2 mt-2 text-center" >No more notifications to be displayed</p>`;
    } else if (CURRENT_PAGE == 1) {
        document.querySelector('.notification-group').innerHTML += `<button type="button" class="btn btn-primary show-more-notifications mb-3">Show More</button>`;
    }

    updateNotifications();
}

function loadMore() {
    CURRENT_PAGE += 1;

    let data = {
        'page': CURRENT_PAGE,
    };
    
    sendAjaxGetRequest('/api/notification', data, requestNotificationsHandler);
}


function updateNotifications() {
    if (document.getElementById('notificationsModal')) {
        let goalDiv = document.querySelector('.goal-notification');
        goalDiv.innerHTML = goalDiv.innerHTML;

        let numberDivs = document.querySelectorAll('.notification-element');

        for (let i = 0; i < numberDivs.length; i++) {
            let notificationId = numberDivs[i].querySelector(".notification-id").innerHTML;

            numberDivs[i].querySelector('.mark-read-' + notificationId).addEventListener('click', function() { markRead(notificationId); });
            numberDivs[i].querySelector('.delete-' + notificationId).addEventListener('click', function() { deleteNotification(notificationId); });
        }
        let showMore = document.querySelector('.show-more-notifications');
        if(showMore) showMore.addEventListener('click', loadMore);
    }
}
