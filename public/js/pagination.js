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
 */

let page_link_list = []; // Instances of pagination-button-x.
let page_item_list = []; // Instances of pagination-item-x.
let still_available_pages = true,
  counter = 1;

// Get all the pagination items and buttons.
try {
  while (still_available_pages) {
    const page_link = document.querySelector("#pagination-button-" + counter);
    const page_item = document.querySelector("#pagination-item-" + counter);
    if (page_link !== null && page_item !== null) {
      page_link_list.push(page_link);
      page_item_list.push(page_item);
      counter++;
    } else still_available_pages = false;
  }

  // Set first item as visible and the others invisible.
  setItemsInvisible();
  page_item_list[0].style.display = "block";

  // addEventListener for each button.
  page_link_list.forEach((element) => {
    element.addEventListener("click", (e) => {
      const page_link = e.target;
      const pagination_number = page_link.id.split("-")[2]; // Get the number of the button.
      const page_item = document.querySelector(
        "#pagination-item-" + pagination_number
      ); // Get the item to be changed to.
      toggleItem(page_item, page_link);
    });
  });
} catch (e) {
  console.warn("No paginations");
}
/**
 * Set the current pagination item as visible and the others as invisible.
 * @param {html element} page_item - Item to be set visible.
 * @param {html element} page_link  - Button to be set as active.
 */
function toggleItem(page_item, page_link) {
  setButtonsInactive();
  setItemsInvisible();
  page_link.parentNode.classList.add("active");
  page_item.style.display = "block";
}

/**
 * Set display none for all the pagination-item's.
 */
function setItemsInvisible() {
  page_item_list.forEach((element) => {
    element.style.display = "none";
  });
}

/**
 * Removes the active instance from all pagination-button's.
 */
function setButtonsInactive() {
  page_link_list.forEach((element) => {
    if (element.parentNode.classList.contains("active"))
      element.parentNode.classList.remove("active");
  });
}
