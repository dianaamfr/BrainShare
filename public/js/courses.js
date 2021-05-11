import {createButtonTrash} from './common.js';

// Disable submit on enter
window.addEventListener( "keydown", function (e) { if ( e.keyIdentifier == "U+000A" || e.keyIdentifier == "Enter" || e.keyCode == 13) { if (e.target.nodeName == "INPUT" && e.target.type == "text") { e.preventDefault(); return false; } } }, true);

var coursesClean = [];
var toastElListCourse = [].slice.call(document.querySelectorAll('.toast'));
let toastBodyCourse = document.querySelector('.toast-body');
var toastListCourse = toastElListCourse.map(function (toastEl) {
  return new bootstrap.Toast(toastEl);
});

if (typeof courses !== 'undefined'){
    for (let i = 0; i < courses.length; i++) {
        coursesClean.push(courses[i].name);
    }
}

let coursesList = [];

const courseContainer = document.querySelector(".course-container");
const courseInput = document.querySelector("#questionCoursesSelect");
populateOldCourses();
selectCourse();

/**
 * Remove all courses from the input bar.
 */
function clearCourses() {
    document.querySelectorAll("div .course").forEach((course) => {
        course.parentElement.removeChild(course);
    });
}

/**
 * Add courses in the courseList array to the input bar.
 */
function addCourses() {
    clearCourses();
    coursesList
        .slice()
        .reverse()
        .forEach((course) => {
            courseContainer.prepend(createCourseCard(course));
        });
}
/**
 * If it is at the edit page, populate the input field with the desired courses.
 */
function populateOldCourses() {
    if (typeof oldCoursesList !== "undefined") {
        oldCoursesList.forEach((course) => {
            coursesList.push(course["name"]);
        });
        addCourses();
    }
}

/**
 * Handle events to add the selected course to the input.
 */
function selectCourse() {
    if (courseContainer != null && courseInput != null) {
        // Case the course is selected using the keyboard.
        courseInput.addEventListener("keyup", (e) => {
            if (e.key === "Enter") addCourseOnInput();

            let suggestionListCourse = document.getElementById(
                "questionCoursesSelectautocomplete-list"
            );
            // Case the course is selected using the mouse.
            if (suggestionListCourse !== null) {
                suggestionListCourse.addEventListener("click", () => addCourseOnInput());
            }
        });
    }
}

/**
 * Adds the selected course to the input.
 */
function addCourseOnInput() {
    courseInput.value.split(",").forEach((course) => {
        if ( course != "" && coursesClean.includes(course) && coursesList.length <= 1 && !coursesList.includes(course)) {
            coursesList.push(course);
        } else if (course != "" && coursesList.includes(course)){
            toastBodyCourse.innerText = "Course already included.";
            toastListCourse[0].show();
        } else if (coursesList.length > 1) {
            toastBodyCourse.innerText = "Number of courses must be less than 3.";
            toastListCourse[0].show();
        }
    });

    addCourses();
    courseInput.value = "";
}


/**
 * Creates the card of a course for the given label.
 * @param {String} label - name of the course.
 * @returns
 */
function createCourseCard(label) {
    let id;
    for (let i = 0; i < courses.length; i++) {
        if (courses[i].name == label) id = courses[i].id;
    }

    const div = document.createElement("div");
    div.setAttribute(
        "class",
        "course card rounded-1 manage-tag-card px-3 py-2 mx-1"
    );
    const innerDiv = document.createElement("div");
    innerDiv.setAttribute("class", "card-body d-flex p-0");

    const span = document.createElement("span");
    span.innerHTML = label;

    const hiddenV = document.createElement("input");
    hiddenV.setAttribute("name", "courseList[]");
    hiddenV.setAttribute("value", id);
    hiddenV.readOnly = true;
    hiddenV.hidden = true;


    let buttonClose = createButtonTrash();
    clickButtonTrashCourse(buttonClose);


    div.appendChild(innerDiv);
    div.appendChild(hiddenV);
    innerDiv.appendChild(span);
    innerDiv.appendChild(buttonClose);

     return div;
}


/**
 * Handles the action of pressing the trash click button.
 */
function clickButtonTrashCourse(buttonClose){
    buttonClose.addEventListener("click", function (e) {
        clearCourses();
        let cardElement = e.target.parentElement.parentElement;
        let courseLabel = cardElement.querySelector("span").innerText;
        const index = coursesList.indexOf(courseLabel);
        coursesList.splice(index, 1);
        addCourses();
    });
}
