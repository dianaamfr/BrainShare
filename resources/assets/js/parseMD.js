
/**
 * @usage The elements that need to be parsed to markdown 
 * must be envolved in a <div class="md-content"></div> with just 
 * text inside. 
 * New lines must be declared as <br>. In the case of this project, 
 * the text editor already handles this operation. 
 */

const converter = new showdown.Converter(); 
// Must not set id's on elements, due the possibility of conflicts.
converter.setOption('noHeaderId', true);             
// Style. 
converter.setFlavor('github'); 

try { 
  const md_element_list = document.getElementsByClassName("md-content"); 
  
  // Convert all the text marked as .md-content to html. 
  for (let i = 0; i < md_element_list .length; i++) { 
    const md_item = md_element_list[i]; 
    const html_text = converter.makeHtml(md_item.innerText);  
    md_item.innerHTML = html_text; 
  } 

} catch (e) {
  console.warn("No content to parse to MD");
}
