import {sendDataAjaxRequest, sendAjaxGetRequest} from './common.js';

// Delete Notification
function deleteHandler(json) {
    if(json.success) {
        let obj = document.getElementById("notification-" + json.id);
        obj.remove();
    }
}

function deleteNotification(notificationId) {
    let data = {
        'id': notificationId,
    };

    sendDataAjaxRequest('POST', '/api/notification/delete/' + notificationId, data, deleteHandler);
}


// Mark as Read Notification
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

    sendDataAjaxRequest('POST', '/api/notification/read/' + notificationId, data, readHandler);
}

// Notification infinite scroll
function requestNotificationsHandler() {
    if (this.status != 200) window.location = '';
    let json = JSON.parse(this.responseText);

    let goalDiv = document.querySelector('.goal-notification');
    goalDiv.innerHTML += json.response;
    if(json.lastPage == currentPage) {
        let button = document.querySelector('.show-more-notifications');
        button.remove();
        goalDiv.innerHTML += `<p class="mb-2 mt-2 text-center" >No more notifications to be displayed</p>`;
    };

    currentPage += 1;
}

function loadMore() {
    let data = {
        'page': currentPage,
    };
    
    sendAjaxGetRequest('/api/notification/load', data, requestNotificationsHandler);
}


let currentPage = 2;
if (document.getElementById('notificationsModal')) {
    let numberDivs = document.querySelectorAll('.notification-element');

    for (let i = 0; i < numberDivs.length; i++) {
        let notificationId = numberDivs[i].querySelector(".notification-id").innerHTML;
        numberDivs[i].querySelector('.mark-read-' + notificationId).addEventListener('click', function() { markRead(notificationId); });
        numberDivs[i].querySelector('.delete-' + notificationId).addEventListener('click', function() { deleteNotification(notificationId); });
    }

    let showMore = document.querySelector('.show-more-notifications');
    if(showMore) showMore.addEventListener('click', loadMore);
}