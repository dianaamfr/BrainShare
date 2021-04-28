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


function selectCourse() {
    if (courseContainer != null && courseInput != null) {
        // Case the course is selected using the keyboard.
        courseInput.addEventListener("keyup", (e) => {
            if (e.key === "Enter") processCourse();

            let suggestionListCourse = document.getElementById(
                "questionCoursesSelectautocomplete-list"
            );
            // Case the course is selected using the mouse.
            if (suggestionListCourse !== null) {
                suggestionListCourse.addEventListener("click", () => processCourse());
            }
        });
    }
}

function processCourse() {
    courseInput.value.split(",").forEach((course) => {
        if ( course != "" && coursesClean.includes(course) && coursesList.length <= 1 && !coursesList.includes(course)) {
            coursesList.push(course);
        } else if (course != "" && coursesList.includes(course)){
            toastBodyCourse.innerText = "Course already included.";
            toastListCourse[0].show();
        } else if (course != "") {
            toastBodyCourse.innerText = "Number of courses must be less than 3.";
            toastListCourse[0].show();
        }
    });

    addCourses();
    courseInput.value = "";
}

function populateOldCourses() {
    if (typeof oldCoursesList !== "undefined") {
        oldCoursesList.forEach((course) => {
            coursesList.push(course["name"]);
        });
        addCourses();
    }
}

/**
 * Creates the card of a course for the given label.
 * @param {String} label - name of the course.
 * @returns
 */
function createCourse(label) {
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

    const closeIcon = document.createElement("span");
    closeIcon.setAttribute("class", "icon-hover");
    closeIcon.setAttribute("title", "Delete");

    closeIcon.addEventListener("click", function (e) {
        clearCourses();
        const courseLabel = e.target.getAttribute("data-item");
        const index = coursesList.indexOf(courseLabel);
        coursesList = [
            ...coursesList.slice(0, index),
            ...coursesList.slice(index + 1),
        ];
        addCourses();
    });

    const buttonOne = document.createElement("button");
    buttonOne.setAttribute("class", "p-0");
    const iOne = document.createElement("i");
    iOne.setAttribute("class", "far fa-trash-alt");

    const buttonTwo = document.createElement("button");
    buttonTwo.setAttribute("class", "p-0");
    const iTwo = document.createElement("i");
    iTwo.setAttribute("class", "fas fa-trash-alt");
    iTwo.setAttribute("data-item", label);

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
    document.querySelectorAll("div .course").forEach((course) => {
        course.parentElement.removeChild(course);
    });
}

function addCourses() {
    clearCourses();
    coursesList
        .slice()
        .reverse()
        .forEach((course) => {
            courseContainer.prepend(createCourse(course));
        });
}
