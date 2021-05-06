
export function getCategoryName(deleteButton, deleteButtons){
    const categoryRow = deleteButtons[0].parentElement.parentElement;
    return categoryRow.querySelector('td').innerText;
}
