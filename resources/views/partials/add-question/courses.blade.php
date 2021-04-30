<div class="mb-3 position-relative" >
    <label for="questionCoursesSelect" class="form-label">Course</label>

    <div class="d-flex flex-wrap course-container autocomplete overflow-hidden">
        <input class="form-control autoCompleteCourses" id="questionCoursesSelect" placeholder="Associate Courses here">
    </div>
    @if ($errors->has('courseList'))
        <span class="error">
            Courses must be different and can't be more than 2!
        </span>
    @endif
</div>

