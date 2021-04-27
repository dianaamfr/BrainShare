<form class="me-auto" id="questions-search-bar">
    <div class="d-flex">
        <input class="form-control" type="search" name="search-input" value="{{ old('nav-search-input') }}" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="search-submit" value="relevance">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="navbar justify-content-start mt-3 flex-nowrap align-items-start">
        <div id="courses-tags-search">
            <h6>Filter by Course</h6>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="courses-dropdown">
                    Select Courses
                </button>
                <div class="dropdown-menu" id="courses-dropdown-list">
                    <div class="dropdown-item">
                        @foreach ($courses as $course)
                            <input class="course-filter-input" type="checkbox" hidden id="course-filter-{{$course->id}}" value="{{$course->id}}">
                            <label for="course-filter-{{$course->id}}" class="course-filter list-group-item">{{$course->name}}</label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h6>Tags</h6>
            <div id="tags-selected">
                <input class="form-control" name="tag-input" type="search" placeholder="Search tags">
            </div>
            <div id="tags-search-results">
            </div>
        </div>
    </div>
</form>
