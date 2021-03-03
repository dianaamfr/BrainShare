"use strict";

/**
 * Code to change between undefined number of pages predifined.
 * Example: At profile page, the user may want to visualize the questions
 * made or answers. Thus it's necessary to use the pagination mechanism
 * to switch between them.
 *
 * @usage In the html/php page, the items for the pagination must have an id
 * using the following sintax: pagination-item-x. Where x is a number and the
 * pages must have distincts and consecutives x's.
 * Example: pagination-item-1; pagination-item-2.
 *
 * Similarly buttons must have the following syntax: pagination-button-x.
 *
 *
 */

let pagination_button_list = [];  // Instances of pagination-button-x.
let pagination_item_list = [];    // Instances of pagination-item-x.
let still_available_pages = true,
  counter = 1;

// Get all the pagination items and buttons. 
while (still_available_pages) {
  const pagination_button = document.querySelector( "#pagination-button-" + counter);
  const pagination_item = document.querySelector("#pagination-item-" + counter); 
  if (pagination_button !== null && pagination_item !== null) {
    pagination_button_list.push(pagination_button);
    pagination_item_list.push(pagination_item);
    counter++;
  } else still_available_pages = false;
}

// addEventListener for each button.
pagination_button_list.forEach((element) => {
  element.addEventListener("click", (e) => { 
    const pagination_button = e.target; 
    const pagination_number = pagination_button.id.split("-")[2]; // Get the number of the button.
    const pagination_item = document.querySelector( "#pagination-item-" + pagination_number); // Get the item to be changed to.  
    toggleItem(pagination_item, pagination_button); 
  });
}); 

/**
 * Set the current pagination item as visible and the others as invisible.  
 * @param {html element} pagination_item - Item to be set visible. 
 * @param {html element} pagination_button  - Button to be set as active. 
 */
function toggleItem(pagination_item, pagination_button){
  setButtonsInactive(); 
  setItemsInvisible();  
  pagination_button.parentNode.classList.add('active');  
  pagination_item.style.display = "block"; 

}

/**
 * Set display none for all the pagination-item's.
 */
function setItemsInvisible(){
  pagination_item_list.forEach(element => { 
    element.style.display = "none"; 
  })
}
/**
 * Removes the active instance from all pagination-button's.
 */
function setButtonsInactive(){
  pagination_button_list.forEach(element => { 
    console.log(element.parentNode);
    if (element.parentNode.classList.contains('active')) 
    
    element.parentNode.classList.remove('active'); 
  });   
}
