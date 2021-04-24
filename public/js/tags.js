// Disable submit on enter
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);

var tagsClean = [];
for(let i = 0; i < tags.length; i++) {
    tagsClean.push(tags[i].name);
}

var coursesClean = [];
for(let i = 0; i < courses.length; i++) {
    coursesClean.push(courses[i].name);
}

const tagContainer = document.querySelector('.tag-container');
const tagInput = document.querySelector('#questionTagsSelect'); 
let tagsList = [];

const courseContainer = document.querySelector('.course-container');
const courseInput = document.querySelector('#questionCourseSelect');
let coursesList = [];

function createTag(label) {
  const div = document.createElement('div');
  div.setAttribute('class', 'tag card rounded-1 manage-tag-card px-3 py-2 mt-3 mx-1');
  const innerDiv = document.createElement('div');
  innerDiv.setAttribute('class', 'card-body d-flex p-0');

  const span = document.createElement('span');
  span.innerHTML = label;

  const closeIcon = document.createElement('span');
  closeIcon.setAttribute('class', 'icon-hover');
  closeIcon.setAttribute('title', 'Delete');
  
  closeIcon.addEventListener('click', function(e) {
    clearTags();
    const tagLabel = e.target.getAttribute('data-item');
    const index = tagsList.indexOf(tagLabel);
    tagsList = [...tagsList.slice(0, index), ...tagsList.slice(index+1)];
    addTags();  
  });


  const buttonOne = document.createElement('button');
  buttonOne.setAttribute('class', 'p-0');
  const iOne = document.createElement('i');
  iOne.setAttribute('class', 'far fa-trash-alt');

  const buttonTwo = document.createElement('button');
  buttonTwo.setAttribute('class', 'p-0');
  const iTwo = document.createElement('i');
  iTwo.setAttribute('class', 'fas fa-trash-alt');
  iTwo.setAttribute('data-item', label);

  div.appendChild(innerDiv);
  innerDiv.appendChild(span);
  innerDiv.appendChild(closeIcon);

  closeIcon.appendChild(buttonOne);
  closeIcon.appendChild(buttonTwo);
  buttonOne.appendChild(iOne);
  buttonTwo.appendChild(iTwo);
  
  return div;
}

function clearTags() {
  document.querySelectorAll('div .tag').forEach(tag => {
    tag.parentElement.removeChild(tag);
  });
}

function addTags() {
  clearTags();
  tagsList.slice().reverse().forEach(tag => {
    tagContainer.prepend(createTag(tag));
  });
}

tagInput.addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
      e.target.value.split(',').forEach(tag => {
        if (tag != "" && tagsClean.includes(tag) && tagsList.length <= 4) {
            tagsList.push(tag); 
        }
      });
      
      addTags();
      tagInput.value = '';
    }
});


