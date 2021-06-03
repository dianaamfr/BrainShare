@extends('layouts.app')

@section('content')

@section('scripts')
    <script src={{ asset('js/answer.js') }}  type="module"></script>
    <script src={{ asset('js/comment.js') }}  type="module"></script>
    <script src={{ asset('js/report.js') }} type="module"></script>
    <script src={{ asset('js/question.js') }} type="module"></script>
@endsection

<div id="page-top" class="page-margin question-page">

    <!-- Delete Question Alert -->
    @if($question->deleted === true)
        <div class="alert alert-danger deleted-alert max-size" role="alert">
            This Question has been deleted. Only Administrators and Moderators can see this page.
        </div>
    @endif

    <article class="question card">
        <div class="card-body">
            <header class="card-header">
                <div class="question-header d-flex align-items-center">
                    <!-- Mobile Question details -->
                    <div class="d-none question-details d-flex mb-3">
                        <!-- Course -->
                    @include('partials.question.courses')

                    <!-- Edit/Delete: only for Registred Users -->
                        @include('partials.question.update', ['margin' => 'ms-auto'])

                    </div>

                    <!-- Question Title -->
                    <h2 class="card-title flex-grow-1">{{$question->title}}</h2> <!-- Question Title -->

                    <!-- Desktop Question details -->
                    <div class="question-details d-flex">
                    @include('partials.question.courses')

                    <!-- Edit/Delete: only for Registred Users -->
                        @include('partials.question.update', ['margin' => ''])
                    </div>
                </div>

                <!-- Question Owner details -->
                @include('partials.question.author', ['element' => $question])

            </header>

            <!-- Question Text -->
            <div class="d-flex align-items-center px-3">
                @include('partials.question.question-content')
            </div>


            <!-- Footer -->
            <footer class="d-flex">

                <!-- Tags -->
                @include('partials.question.tags')

            <!-- Report Button -->
                @if(Auth::check() && $question->owner && $question->owner->id != Auth::user()->id)
                    @include('partials.common.report',['margin' => 'ms-auto', 'id'=>$question->id, 'type'=>'question'])
                @endif
            
            </footer>

        </div>

    </article>

    <div id="submit-answer-collapse">
        <button class="btn btn-primary mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapsed-form" aria-expanded="false" aria-controls="collapseExample">
            Add Answer
        </button>
        
        <div class="collapse mt-2" id="collapsed-form">
            <!-- Submit Answer Form -->
            <form id="submit-answer" >
                <input type="hidden" name="questionID" value="{{$question->id}}">
                <input type="hidden" name="answerCounter" value="{{$question->number_answer}}">
                @include('partials.question.answer-form')
            </form>
        </div>
    </div>

   
    <!-- Answer -->
    <section class="answers">
        <header class="d-flex align-items-center">
            <h4 id="question-number-answers" class="d-inline-block">{{$question->number_answer}} answers</h4>
        </header>
        <div class="answer card" id="all-answers">
            @if ($question->number_answer == 0)
                <p class="no-answers p-2">No answers yet!</p>
            @else
                @include('partials.common.answer-list',['answers'=>$answers])
            @endif
        </div>
    </section>

</div>

@include('partials.common.report-modal')
@include('partials.common.confirmation-modal')
@include('partials.common.toast')
@endsection
