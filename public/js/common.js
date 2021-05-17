/**
 * Creates the trash button.
 * @returns Returns the button.
 */
export function createButtonTrash() {
    const buttonClose = document.createElement("button");
    buttonClose.setAttribute("class", "p-0 icon-hover");

    const iTrashFar = document.createElement("i");
    iTrashFar.setAttribute("class", "far fa-trash-alt");

    const iTrashFas = document.createElement("i");
    iTrashFas.setAttribute("class", "fas fa-trash-alt");

    buttonClose.appendChild(iTrashFar);
    buttonClose.appendChild(iTrashFas);

    return buttonClose;
}

/**
 * Given a timestamp string (with date and hour) get the date.
 * @returns Returns the date string in the format dd-mm-yyyy.
 */
export function getDate(timestamp) {
    const date = new Date(timestamp);
    const isoString = date.toISOString();
    const splitedDate = isoString.split(/[-T]/);
    return splitedDate[2] + "-" + splitedDate[1] + "-" + splitedDate[0];
}

export function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

export function sendAjaxGetRequest(url, data, handler) {
    let request = new XMLHttpRequest();
    
    request.open("get", url + '?' + encodeForAjax(data), true);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.addEventListener('load', handler);
    request.send();
}

/**
 * This function sends the ajax request as a json file.
 * @param method POST, PUT, DELETE or GET
 * @param url Target endpoint.
 * @param data{json} Information to be sent.
 * @param token Send to token for authentication.
 * @param handleResponse Function that will be called to handle the response.
 */
export function sendDataAjaxRequest(method, url, data, handleResponse) {
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


export function sendAjaxRequest(method, url, data, handleResponse) {
    let dataJson = JSON.stringify(data);
    fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Request-With': "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content'),
            },
            method: method,
            credentials: 'same-origin',
            body: dataJson
        },
    ).then(response => response.json()).then(json => handleResponse(json));
}

// TODO: ask the professor if this is safe.
export function getToken(){
    return document.querySelector("meta[name='csrf-token']").getAttribute('content');
}

/**
 * src: https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
 * This function get's the value of query parameters
 * @param name {String} name of the field.
 * @param url {String} Url where it will be searched.
 * @returns {string|null} Value of the paramater.
 */
//
export function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

/**
 * Show success or error alert on the screen when the response to an action is received.
 * @param message {String }Message to be displayed.
 * @param type {String} Message type: error or not.
 * @param element {Element} Element where the message will added to.
 */
export function showAlert(message, type, element){
    let alert = document.createElement('div');
    alert.classList.add('alert','alert-dismissible','fade','show');
    alert.innerHTML = message;

    let closeBtn = document.createElement('button');
    closeBtn.classList.add('btn-close');
    closeBtn.setAttribute('data-bs-dismiss', 'alert');

    alert.appendChild(closeBtn);

    if(type === "error"){
        alert.classList.remove('alert-success');
        alert.classList.add('alert-danger');
    }
    else {
        alert.classList.remove('alert-danger')
        alert.classList.add('alert-success');
    }

    element.innerHTML = '';
    element.appendChild(alert);
}
