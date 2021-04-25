@extends('layouts.app')

<script>var tags = @json($tags);</script>
<script>var courses = @json($courses);</script>

@section('content')
<div class="page-margin">
    <section class="background-light container-sm add-question card rounded-1">
        <h2 class="mb-4">Add Question</h2>
        <form method="POST" action="{{ route('question') }}" class="text-start" data-toggle="validator" autocomplete="off">
            {{ csrf_field() }}
    
            <!-- Question Title -->
            <div class="mb-3">
                <label for="questionTitle" class="form-label">Question Title*</label>
                <input type="text" class="form-control" name="title" id="questionTitle" value="{{ old('title') }}" placeholder="Write the title here" aria-describedby="questionTitleHelp" required>
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
                    <textarea id="question-text-area" name="content" class="form-control" placeholder="Describe your problem here" style="height: 100px" aria-describedby="questionBodyHelp" required> </textarea>
                </div>
                @if ($errors->has('content'))
                    <span class="error">
                        {{ $errors->first('content') }}
                    </span>
                @endif
                <div id="questionBodyHelp" class="form-text">Describe all the details that may help others understand your question.</div>
            </div>

            <!-- Course -->
            <div class="mb-3" >
                <label for="questionCourseSelect" class="form-label">Course</label>

                <div class="d-flex flex-wrap course-container autocomplete">
                    <input class="form-control autoCompleteCourses" id="questionCoursesSelect" placeholder="Associate Courses here">
                </div>
            </div>
            
            <!-- Tags -->
            <div class="mb-3" >
                <label for="questionTagsSelect" class="form-label">Tags</label>

                <div class="d-flex flex-wrap tag-container autocomplete">
                    <input class="form-control autoCompleteTags" id="questionTagsSelect" placeholder="Associate Tags here">
                </div>
            </div>

            <!--<button type="submit" class="btn btn-primary mt-3">Add Question</button>-->
            <button type="submit" class="btn btn-primary btn-block btn-register" value="Add Question">Add Question</button>
        </form>
    </section>
</div>
@endsection