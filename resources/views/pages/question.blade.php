@extends('layouts.app')

@section('content')
<div id="page-top" class="page-margin question-page">
    <article class="question card">
        <div class="card-body">
            <header class="card-header">
                <div class="question-header d-flex align-items-center">
                    <!-- Mobile Question details -->
                    <div class="d-none question-details d-flex mb-3">
                        <!-- Course -->
                        @foreach ($question->courses as $course)
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            {{$course->name}}
                        </span>
                        @endforeach

                        <!-- Edit/Delete: only for Registred Users -->
                        @can('delete', $question) <!--Only checks for registratin, doenst check if it is the owner -->
                        <div class="edit-question ms-auto">
                            <a class="icon-hover" title="Edit"  href="{{route('edit-question', $question->id)}}">
                                <i class="far fa-edit"></i>
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="post" action="{{ route('delete-question', $question->id) }}" title="Delete">
                                @method('DELETE')
                                @csrf
                                <button class="icon-hover" type="submit">
                                    <i class="far fa-trash-alt"></i>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>

                    <!-- Question Title -->
                    <h2 class="card-title flex-grow-1">{{$question->title}}</h2> <!-- Question Title -->

                    <!-- Desktop Question details -->
                    <div class="question-details d-flex">


                        <!-- Edit/Delete: only for Registered Users -->
                        @can('delete', $question)
                        <div class="edit-question">
                            <a class="icon-hover" title="Edit" href="{{route('edit-question', $question->id)}}">
                                <i class="far fa-edit"></i>
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="post" action="{{ route('delete-question', $question->id) }}" title="Delete">
                                @method('DELETE')
                                @csrf
                                <button class="icon-hover" type="submit">
                                    <i class="far fa-trash-alt"></i>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>

                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="Profile Image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>{{$question->owner->username}}</span> <!-- Username -->
                        <span> {{ date('d-m-Y H:i', strtotime($question->date)) }} </span> <!-- Date -->
                    </div>
                </div>
            </header>

            <!-- Question Text -->
            <div class="row align-items-center px-3">
                <div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
                    <p class="points m-0">{{$question->score}}</p>
                    <button class="icon-hover vote_btn" title="Up Vote">
                        <i class="bi bi-caret-up"></i>
                        <i class="bi bi-caret-up-fill"></i>
                    </button>
                    <button class="icon-hover vote_btn" title="Down Vote">
                       <i class="bi bi-caret-down"></i>
                       <i class="bi bi-caret-down-fill"></i>
                    </button>
                </div>
                <div class="question-content md-content col align-self-start ps-4">
                    {{$question->content}}
                </div>
            </div>

            <!-- Tags -->
            <footer class="d-flex">
                <div class="question-tags">
                    @foreach ($question->tags as $tag)
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        {{$tag->name}}
                    </span>
                    @endforeach
                </div>

                <div class="ms-auto report-icon" title="Report">
                    <button class="icon-hover">
                        <i class="far fa-flag"></i>
                        <i class="fas fa-flag"></i>
                    </button>
                </div>
            </footer>

        </div>

    </article>

    <!-- Answer -->
    <!-- Questions -->
    <section class="answers">
        <header class="d-flex align-items-center">
            <h4 class="d-inline-block">{{$question->number_answer}} answers</h4>
            <a class="btn btn-primary ms-auto" href="#submit-answer">Add Answer</a>
        </header>
        <div class="answer card">
            @each('partials.answer-card', $question->answers, 'answer')
        </div>
    </section>

    <!-- Submit Answer Form -->
    <form id="submit-answer">
        <div class="mb-1 p-3">
            <label for="question-text-area" class="form-label">Post an Answer</label>
                <div class="border form-control" id="submitAnswerTextarea">
                    <textarea id="question-text-area" class="form-control" placeholder="Type your answer here"></textarea>
                </div>
        <button class="btn btn-primary mt-3" type="submit">Submit Answer</button>
        </div>
        <div class="back-top">
            <a class="btn btn-outline-primary mb-5" href=#page-top>Back to Top</a>
        </div>
    </form>
</div>
@endsection
