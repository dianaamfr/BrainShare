"use strict"

if(document.getElementById('question-text-area') != null) {
  var editor = new Editor({
    element: document.getElementById('question-text-area')
  });

  editor.render();
  window.scrollTo(0,0);
}

