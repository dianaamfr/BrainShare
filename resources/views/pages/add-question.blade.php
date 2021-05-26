@extends('layouts.app')

@section('content')
<div class="page-margin">
    <section class="background-light container-sm add-question card rounded-1">
        <h2 class="mb-4">Add Question</h2>
        <form method="POST" action="{{ route('question') }}" class="text-start" data-toggle="validator" autocomplete="off">
            @csrf

            <!-- Question Title -->
            @include('partials.add-question.title', ["value" => old('title')])

            <!-- Question Body -->
            @include('partials.add-question.body', ["value" => old('content')])

            <!-- Course -->
            @include('partials.add-question.courses')

            <!-- Tags -->
            @include('partials.add-question.tags')

            <!-- Toast -->
            @include('partials.common.toast')

            <button type="submit" class="btn btn-primary btn-block btn-register" value="Add Question">Add Question</button>
        </form>
    </section>
</div>

<script>const tags = @json($tags);</script>
<script>const courses = @json($courses);</script>
<script>const max_tags = 5; </script>
@endsection

