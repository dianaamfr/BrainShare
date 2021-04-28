<div id="courses-tags-search">
    <h6>Filter by Course</h6>
    <div class="dropdown">
        <button class="dropdown-toggle" type="button" id="courses-dropdown">{{$selected != null ? count($selected) : '0'}} selected</button>
        <div class="dropdown-menu" id="courses-dropdown-list">
            @foreach ($courses as $course)
                <div class="dropdown-item">
                    <input class="course-filter-input" name="courses" type="checkbox" hidden id="course-filter-{{$course->id}}" 
                        value="{{$course->id}}" {{$selected != null && in_array($course->id, $selected) ? 'checked' : ''}}>
                    <label for="course-filter-{{$course->id}}" class="course-filter list-group-item">{{$course->name}}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>