function createCourses(label) {
  let id;
  for(let i = 0; i < courses.length; i++) {
    if (courses[i].name == label)
      id = courses[i].id;
  }

  const div = document.createElement('div');
  div.setAttribute('class', 'course card rounded-1 manage-tag-card px-3 py-2 mx-1');
  const innerDiv = document.createElement('div');
  innerDiv.setAttribute('class', 'card-body d-flex p-0');

  const span = document.createElement('span');
  span.innerHTML = label

  const hiddenV = document.createElement('input');
  hiddenV.setAttribute('name', 'courseList[]');
  hiddenV.setAttribute('value', id);
  hiddenV.readOnly = true; 
  hiddenV.hidden = true;

  const closeIcon = document.createElement('span');
  closeIcon.setAttribute('class', 'icon-hover');
  closeIcon.setAttribute('title', 'Delete');
  
  closeIcon.addEventListener('click', function(e) {
    clearCourses();
    const tagLabel = e.target.getAttribute('data-item');
    const index = coursesList.indexOf(tagLabel);
    coursesList = [...coursesList.slice(0, index), ...coursesList.slice(index+1)];
    addCourses();  
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
  div.appendChild(hiddenV);
  innerDiv.appendChild(span);
  innerDiv.appendChild(closeIcon);

  closeIcon.appendChild(buttonOne);
  closeIcon.appendChild(buttonTwo);
  buttonOne.appendChild(iOne);
  buttonTwo.appendChild(iTwo);
  
  return div;
}

function clearCourses() {
  document.querySelectorAll('div .course').forEach(tag => {
    tag.parentElement.removeChild(tag);
  });
}

function addCourses() {
  clearCourses();
  coursesList.slice().reverse().forEach(tag => {
    courseContainer.prepend(createCourses(tag));
  });
}

// Disable submit on enter
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);

if(typeof courses !== 'undefined') {
  var coursesClean = [];
  for(let i = 0; i < courses.length; i++) {
      coursesClean.push(courses[i].name);
  }

  let coursesList = [];

  const courseContainer = document.querySelector('.course-container');
  const courseInput = document.querySelector('#questionCoursesSelect');

  if(courseContainer != null && courseInput != null) {
    courseInput.addEventListener('keyup', (e) => {
        if (e.key === 'Enter') {
            
          e.target.value.split(',').forEach(tag => {
            console.log(tag)
            if (tag != "" && coursesClean.includes(tag) && coursesList.length <= 1) {
                coursesList.push(tag); 
            }
          });
          
          addCourses();
          courseInput.value = '';
        }
    });
  }
}