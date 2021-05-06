import {createButtonTrash, getDate} from "../common.js";



// TODO: update the page link.
export function addCategoryToHTML(json){
    let tbody = document.querySelector('tbody');
    let newTagRow = document.createElement('tr');
    let buttonTrash = createButtonTrash();
    let element = [ json['category']['name'], 0, getDate(json['category']['creation_date'])];

    // Set id col.
    let idHead = document.createElement('th');
    idHead.setAttribute('scope', 'row');
    idHead.innerText = json['category']['id'];
    newTagRow.appendChild(idHead);

    // Other cols.
    element.forEach(value => {
        let tableData = document.createElement('td');
        tableData.innerText = value;
        newTagRow.appendChild(tableData);
    });

    // Add button trash.
    let tableDate = document.createElement('td');
    buttonTrash.classList.remove('p-0');
    tableDate.appendChild(buttonTrash);
    newTagRow.appendChild(tableDate);

    tbody.appendChild(newTagRow);
}


/**
 * Updates the message that shows how many entries the table has and how many elements
 * are being displayed.
 */
export function updateShowingMessage(){
    let message = document.querySelector('.table-entries');
    let trEntries = document.querySelectorAll('tbody tr');
    let messageWords = message.innerText.split(" ");
    messageWords[1] = trEntries.length;
    messageWords[3] = parseInt(messageWords[3])+1;
    message.innerText = messageWords.join(" ");
}
