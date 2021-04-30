 /**
 * Creates the trash button.
 * @returns Returns the button.
 */
export default function createButtonTrash(){
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
