@extends('layouts.app')

@section('content')

@section('scripts')
    <script  src={{ asset('js/answer.js')}}  type="module"></script>
    <script  src={{ asset('js/comment.js')}}  type="module"></script>
    <script src={{ asset('js/report.js') }} type="module"></script>
@endsection

<div id="page-top" class="page-margin question-page">
    <article class="question card">
        <div class="card-body">
            <header class="card-header">
                <div class="question-header d-flex align-items-center">
                    <!-- Mobile Question details -->
                    <div class="d-none question-details d-flex mb-3">
                        <!-- Course -->
                    @include('partials.question.courses')

                    <!-- Edit/Delete: only for Registred Users -->
                        @include('partials.question.editDelete', ['margin' => 'ms-auto'])

                    </div>

                    <!-- Question Title -->
                    <h2 class="card-title flex-grow-1">{{$question->title}}</h2> <!-- Question Title -->

                    <!-- Desktop Question details -->
                    <div class="question-details d-flex">

                    @include('partials.question.courses')

                    <!-- Edit/Delete: only for Registred Users -->
                        @include('partials.question.editDelete', ['margin' => ''])
                    </div>
                </div>

                <!-- Question Owner details -->
                @include('partials.question.author')

            </header>

            <!-- Question Text -->
            <div class="row align-items-center px-3">
                @include('partials.question.questionText')
            </div>


            <!-- Footer -->
            <footer class="d-flex">

                <!-- Tags -->
            @include('partials.question.tags')

            <!-- Report Button -->
                @include('partials.report',['margin' => 'ms-auto', 'id'=>$question->id, 'type'=>'question'])

            </footer>

        </div>

    </article>

    <!-- Answer -->
    <section class="answers">
        <header class="d-flex align-items-center">
            <h4 id="question-number-answers" class="d-inline-block">{{$question->number_answer}} answers</h4>
            <a class="btn btn-primary ms-auto" href="#submit-answer">Add Answer</a>
        </header>
        <div class="answer card" id="all-answers">
            @include('partials.answers',['answer'=>$question->answers])
        </div>
    </section>

    <!-- Submit Answer Form -->
    <form id="submit-answer">
        <input type="hidden" name="questionID" value="{{$question->id}}">
        @include('partials.question.answer-form')
    </form>
</div>
@include('partials.report-modal')
@include('partials.common.toast')
@endsection
