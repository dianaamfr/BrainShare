@extends('layouts.app')

@section('content')
<div class="page-margin">
    <section class="background-light container-sm add-question card rounded-1">
        <h2 class="mb-4">Add Question</h2>
        <form method="POST" action="{{ route('question') }}" class="text-start" data-toggle="validator">
            {{ csrf_field() }}
    
            <!-- Question Title -->
            <div class="mb-3">
                <label for="questionTitle" class="form-label">Question Title*</label>
                <input type="text" class="form-control" name="title" id="questionTitle" placeholder="Write the title here" aria-describedby="questionTitleHelp" required>
                <div id="questionTitleHelp" class="form-text">Try to make the question as clear as possible.</div>
            </div>

            <!-- Question Body -->
            <div class="mb-3">
                <label for="question-text-area" class="form-label">Question Body*</label>
                <div class="border form-control">
                    <textarea id="question-text-area" class="form-control" placeholder="Describe your problem here" style="height: 100px" aria-describedby="questionBodyHelp" required>
                    </textarea>
                </div>
                <div id="questionBodyHelp" name="content" class="form-text">Describe all the details that may help others understand your question.</div>
            </div>

            <!-- Course -->
            <div class="mb-3">
                <label for="questionCourseSelect" class="form-label">Course</label>
                <select name="course" id="questionCourseSelect" class="form-select">
                    <option>No Course</option>

                    @foreach ($courses as $course)
                        <option value= {{ $course->id }} >{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Tags -->
            <div class="mb-3">
                <label for="questionTagsSelect" class="form-label">Tags</label>
                <input type="text" class="form-control" id="questionTagsSelect" placeholder="Associate Tags here">

                <div class="d-flex flex-wrap">
                    <div class='card rounded-1 manage-tag-card px-3 py-2 mt-3'>
                        <div class='card-body d-flex p-0'>
                            <span>MIPS</span>
                            <span class="icon-hover" title="Delete">
                                <button class="p-0"><i class="far fa-trash-alt"></i></button> 
                                <button class="p-0"><i class="fas fa-trash-alt"></i></button> 
                            </span>
                        </div>
                    </div>
                    <div class='card rounded-1 manage-tag-card px-3 py-2 mt-3 mx-1'>
                        <div class='card-body d-flex p-0'>
                            <span>COMP</span>
                            <span class="icon-hover" title="Delete">
                                <button class="p-0"><i class="far fa-trash-alt"></i></button> 
                                <button class="p-0"><i class="fas fa-trash-alt"></i></button> 
                            </span> 
                        </div>
                    </div> 
                </div>
            </div>
    
            <!--<button type="submit" class="btn btn-primary mt-3">Add Question</button>-->
            <button type="submit" class="btn btn-primary btn-block btn-register" value="Add Question">Add Question</button>
        </form>
    </section>
</div>
@endsection