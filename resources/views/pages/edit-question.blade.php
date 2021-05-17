
@extends('layouts.app')

@section('content')
<div class="page-margin">
    <section class="background-light container-sm add-question card rounded-1">
        <h2 class="mb-4">Edit Question</h2>
        <form action="{{ route('edit-question', $question->id) }}" method="post"  class="text-start" data-toggle="validator" autocomplete="off">
            @method('PUT')
            @csrf

            <!-- Question Title -->
            @include('partials.add-question.title', ["value" => $question->title ])

            <!-- Question Body -->
            @include('partials.add-question.body', ["value" => $question->content ])

            <!-- Course -->
            @include('partials.add-question.courses')

            <!-- Tags -->
            @include('partials.add-question.tags')

            <!-- Toast -->
            @include('partials.common.toast')

            <input value="{{$question->id}}" name="id" hidden>
            <button type="submit" class="btn btn-primary btn-block btn-register" value="Update Question">Update Question</button>
        </form>
    </section>
</div>

<script> const tags = @json($tags);</script>
<script> const courses = @json($courses);</script>
<script> const max_tags = 5; </script>
<script> const oldTagsList = @json($question->tags); </script>
<script> const oldCoursesList = @json($question->courses);</script>
@endsection
