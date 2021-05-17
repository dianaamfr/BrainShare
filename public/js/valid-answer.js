/* TO IMPORT
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
/* TO IMPORT
*/

function markValidHandler(json) {
    let element = document.querySelector(".valid-icon-" + json.answerId);
    let text = document.querySelector('.mark-valid-' + json.answerId)
    if(json.valid) {
        element.innerHTML = '<i class="fas fa-check text-center"></i>';
        text.innerHTML = 'Unmark as valid';
    } else {
        element.innerHTML = '';
        text.innerHTML = 'Mark as valid';
    }
}

function markValidAnswer(answerId) {
    let data = {
        'answerId': answerId,
    };

    sendDataAjaxRequest('POST', '/api/answer/valid/' + answerId, data, markValidHandler);
}

if (document.querySelector('.mark-valid')) {
    let numberDivs = document.querySelectorAll('.answer-question-card');
    for (let i = 0; i < numberDivs.length; i++) {
        let answerId = numberDivs[i].querySelector(".answer-id").value;
        
        document.querySelector('.mark-valid-' + answerId).addEventListener('click', function() { markValidAnswer(answerId); });
    }
}