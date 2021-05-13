'use strict'

function addEvenListeners(){
    form.addEventListener('submit',function(event){

        event.preventDefault();

        let form = document.getElementById('submit-answer');
        let text = form.querySelector('textarea').value; // testar .textContent se value não der´

        sendAjaxRequest('post','/api/question/' + id + '/answer/add',{text: text},submitAnswerHandler);

    });

}


function submitAnswerHandler() {
    let answer = JSON.parse(this.responseText);
    let element = document.querySelector('li.item[data-id="' + item.id + '"]');
}

function createAnswer(text){
    let answersDiv = document.querySelector('#page-top section.answers div.answer' );

}



function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}
