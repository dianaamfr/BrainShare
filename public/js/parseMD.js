
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

convertMD("md-content");

/**
 * Converts a text to markDown.
 */
export default function convertMD(className){
    try {
        const md_element_list = document.querySelectorAll('.' + className);
        
        // Convert all the text marked as .md-content to html.
        for (let i = 0; i < md_element_list.length; i++) {
            let md_item = md_element_list[i];
            let text = removeTab(md_item);
            const html_text = converter.makeHtml(text);
            md_item.innerHTML = html_text;
        }

    } catch (e) {
        console.warn("No content to parse to MD");
    }
}

/**
 * Remove tab in the first line.
 */
function removeTab(md_item ){
    let md_list = md_item.innerHTML.split("\n");
    let text = "";

    if(md_list.length < 2) return md_list[0];
    
    md_list[1] = md_list[1].trim();

    md_item.innerHTML = "";
    md_list.forEach((element) => text+= element + "\n");

    return text;

}
