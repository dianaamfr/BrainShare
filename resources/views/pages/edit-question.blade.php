
@extends('layouts.app')

@section('content')

<div class="page-margin">
    <section class="background-light container-sm add-question card rounded-1">
        <h2 class="mb-4">Edit Question</h2>
        <form action="{{ route('edit-question', $question->id) }}" method="post"  class="text-start" data-toggle="validator" autocomplete="off">
            @method('PUT')
            @csrf

            <!-- Question Title -->
            <div class="mb-3">
                <label for="questionTitle" class="form-label">Question title*</label>
                <input type="text" class="form-control" name="title" id="questionTitle" value="{{ $question->title }}" placeholder="Write the title here" aria-describedby="questionTitleHelp" required>
                @if ($errors->has('title'))
                    <span class="error">
                        {{ $errors->first('title') }}
                    </span>
                @endif
                <div id="questionTitleHelp" class="form-text">Try to make the question as clear as possible.</div>
            </div>


            <!-- Question Body -->
            <div class="mb-3">
                <label for="question-text-area" class="form-label">Question Body*</label>
                <div class="border form-control">
                    <textarea id="question-text-area" name="content" class="form-control" placeholder="Describe your problem here" style="height: 100px" aria-describedby="questionBodyHelp" required> {{$question->content}} </textarea>
                </div>
                @if ($errors->has('content'))
                    <span class="error">
                        {{ $errors->first('content') }}
                    </span>
                @endif
                <div id="questionBodyHelp" class="form-text">Describe all the details that may help others understand your question.</div>
            </div>

            <!-- Course -->
            <div class="mb-3 position-relative" >
                <label for="questionCourseSelect" class="form-label">Course</label>

                <div class="d-flex flex-wrap course-container autocomplete overflow-hidden">
                    <input class="form-control autoCompleteCourses" id="questionCoursesSelect" placeholder="Associate Courses here">
                </div>
                @if ($errors->has('courseList'))
                    <span class="error">
                        Courses must be different and can't be more than 2!
                    </span>
                @endif
            </div>

            <!-- Tags -->
            <div class="mb-3 position-relative" >
                <label for="questionTagsSelect" class="form-label">Tags</label>

                <div class="d-flex flex-wrap tag-container autocomplete overflow-hidden">
                    <input class="form-control autoCompleteTags" id="questionTagsSelect" placeholder="Associate Tags here">
                </div>

                @if ($errors->has('tagList'))
                    <span class="error">
                        Tags must be different and can't be more than 5!
                    </span>
                @endif
            </div>

            <!-- Toast -->
            <div class="toast position-fixed bottom-0 end-0 p-3 bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                  <div class="toast-body">
                 </div>
                  <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>

            <input value="{{$question->id}}" name="id" hidden>
            <button type="submit" class="btn btn-primary btn-block btn-register" value="Update Question">Update Question</button>
        </form>
    </section>
</div>

<script> const tags = @json($tags);</script>
<script> const courses = @json($courses);</script>

<script> const oldTagsList = @json($question->tags); </script>
<script> const oldCoursesList = @json($question->courses);</script>
@endsection
