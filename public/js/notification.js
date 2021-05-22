"use strict";

/* 
 * TO IMPORT
 */

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendDataAjaxRequest(method, url, data, handleResponse) {
    let dataJson = JSON.stringify(data);
    fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Request-With': "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            method: method,
            credentials: 'same-origin',
            body: dataJson
        },
    ).then(response => response.json()).then(json => handleResponse(json));
}

/* 
 * TO IMPORT
 */

function deleteHandler(json) {
    if(json.success) {
        console.log(json.sucess)
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