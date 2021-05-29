import {sendDataAjaxRequest} from './common.js';

function deleteHandler(json) {
    if(json.success) {
        let obj = document.getElementById("notification-" + json.id);
        obj.remove();
    }
}

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

function deleteNotification(notificationId) {
    let data = {
        'id': notificationId,
    };

    sendDataAjaxRequest('POST', '/api/notification/delete/' + notificationId, data, deleteHandler);
}


if (document.getElementById('notificationsModal')) {
    let numberDivs = document.querySelectorAll('.notification-element');

    for (let i = 0; i < numberDivs.length; i++) {
        let notificationId = numberDivs[i].querySelector(".notification-id").innerHTML;
        numberDivs[i].querySelector('.mark-read-' + notificationId).addEventListener('click', function() { markRead(notificationId); });
        numberDivs[i].querySelector('.delete-' + notificationId).addEventListener('click', function() { deleteNotification(notificationId); });
    }
}