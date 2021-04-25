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
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            MIEIC
                        </span>

                        <!-- Edit/Delete: only for Registred Users -->
                        <div class="edit-question ms-auto">
                            <div class="icon-hover" title="Edit">
                                <a href="edit-question.php"><i class="far fa-edit"></i></a>
                                <a href="edit-question.php"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="icon-hover" title="Delete">
                                <button><i class="far fa-trash-alt"></i></button>
                                <button><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Question Title -->
                    <h2 class="card-title flex-grow-1">{{$question->title}}</h2> <!-- Question Title -->

                    <!-- Desktop Question details -->
                    <div class="question-details d-flex">
                        <!-- Course -->
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            MIEIC
                        </span>

                        <!-- Edit/Delete: only for Registered Users -->
                        <div class="edit-question">
                            <div class="icon-hover" title="Edit">
                                <a href="edit-question.php"><i class="far fa-edit"></i></a>
                                <a href="edit-question.php"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="icon-hover" title="Delete">
                                <button><i class="far fa-trash-alt"></i></button>
                                <button><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="images/profile.png" alt="Profile Image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>joaquina123</span> <!-- Username -->
                        <span>15:02 - 10/05/2009</span> <!-- Date -->
                    </div>
                </div>
            </header>

            <!-- Question Text -->
            <div class="row align-items-center px-3">
                <div class="col-auto d-flex flex-column justify-content-center align-items-center">
                    <p class="points m-0">5</p>
                    <div class="icon-hover vote_btn" title="Up Vote">
                        <button><i class="bi bi-caret-up"></i></button>
                        <button><i class="bi bi-caret-up-fill"></i></button>
                    </div>
                    <div class="icon-hover vote_btn" title="Down Vote">
                        <button><i class="bi bi-caret-down"></i></button>
                        <button><i class="bi bi-caret-down-fill"></i></button>
                    </div>
                </div>
                <div class="question-content md-content col align-self-start ps-4">
                    {{$question->content}}
                </div>
            </div>

            <!-- Tags -->
            <footer class="d-flex">
                <div class="question-tags">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        MIPS
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        COMP
                    </span>
                </div>

                <div class="ms-auto report-icon" title="Report">
                    <div class="icon-hover">
                        <button><i class="far fa-flag"></i></button>
                        <button><i class="fas fa-flag"></i></button>
                    </div>
                </div>
            </footer>

        </div>

    </article>

    <!-- Answer -->
    <section class="answers">
        <header class="d-flex align-items-center">
            <h4 class="d-inline-block">1 Answer</h4>
            <a class="btn btn-primary ms-auto" href="#submit-answer">Add Answer</a>
        </header>
        <div class="answer card">
            <div class="card-body card">
                <header class="question-author pagination align-items-center justify-content-end card-header">
                    <img class="rounded-circle" src="images/profile.png" alt="Profile Image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>joaquina1234</span> <!-- Name -->
                        <span>15:02 - 10/05/2009</span> <!-- Date -->
                    </div>
                </header>

                <div class="row align-items-center px-3">
                    <div class="col-auto d-flex flex-column justify-content-center align-items-center">
                        <p class="points m-0">5</p>
                        <div class="icon-hover vote_btn" title="Up Vote">
                            <button><i class="bi bi-caret-up"></i></button>
                            <button><i class="bi bi-caret-up-fill"></i></button>
                        </div>
                        <div class="icon-hover vote_btn" title="Down Vote">
                            <button><i class="bi bi-caret-down"></i></button>
                            <button><i class="bi bi-caret-down-fill"></i></button>
                        </div>
                    </div>

                    <div class="col align-self-start ps-4">
                        <p>You only need to learn the basic concepts.</p>
                        <p>MIPS instructions will not be used in the exam, but it is an important topic you should be able to understand in order to build a compiler</p>
                    </div>

                    <div class="d-flex flex-column justify-content-center col-auto">
                        <i class="fas fa-check text-center"></i>
                    </div>
                </div>

                <footer class="d-flex align-items-center">
                    <span class="comments flex-grow-1">1 Comments</span>

                    <div class="report-icon" title="Report">
                        <div class="icon-hover">
                            <button><i class="far fa-flag"></i></button>
                            <button><i class="fas fa-flag"></i></button>
                        </div>
                    </div>

                    <a class="btn btn-link" data-bs-toggle="collapse" href="#collapseCommentForm" role="button" aria-expanded="false" aria-controls="collapseCommentForm">Add Comment</a>
                </footer>
            </div>
            <div class="comments">
                <div class="collapse" id="collapseCommentForm">
                    <form id="submit-comment">
                        <div class="mb-3 p-3">
                            <textarea class="form-control" rows="2" placeholder="Type your comment here"></textarea>
                            <div class="d-grid gap-2 d-flex justify-content-end">
                                <button class="btn btn-primary mt-3" type="submit">Submit</button>
                                <button class="btn btn-outline-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentForm" aria-expanded="false" aria-controls="collapseCommentForm">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                    <div class="comment">
                        <div class="comment-text d-inline-block">
                            <p>Yeah, as a student repeating this curricular unit, I can confirm it will rather likely not be presented in the exam, as we have already been evaluated on this topic 2 years ago .</p>
                        </div>
                        <div class="d-flex">
                            <div class="comment-author">
                                <span>carlitos</span> <!-- Username -->
                                <span>01:10 - 11/05/2009</span> <!-- Date -->
                            </div>
                            <div class="ms-auto report-icon" title="Report">
                                <div class="icon-hover">
                                    <button><i class="far fa-flag"></i></button>
                                    <button><i class="fas fa-flag"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="comment">
                        <div class="comment-text d-inline-block">
                            <p>Yeah, don't waste your time on learing MIPS.</p>
                            <p>The professor is only talking about it to remind us of basic assembly instructions</p>
                        </div>

                        <div class="d-flex">
                            <div class="comment-author">
                                <span>guilhermeee</span> <!-- Username -->
                                <span>08:35 - 12/05/2009</span> <!-- Date -->
                            </div>
                            <div class="ms-auto report-icon" title="Report">
                                <div class="icon-hover">
                                    <button><i class="far fa-flag"></i></button>
                                    <button><i class="fas fa-flag"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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