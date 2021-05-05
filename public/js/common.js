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

export function sendDataAjaxRequest(method, url, data, token, handleResponse) {
    let dataJson = JSON.stringify(data);
    fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Request-With': "XMLHttpRequest",
                'X-CSRF-TOKEN': token,
            },
            method: method,
            credentials: 'same-origin',
            body: dataJson
        },
    ).then(response => response.json()).then(json => handleResponse(json));
}
