@extends('layouts.app')

@section('content')
    @section('scripts')
        <script src={{ asset('js/profile.js') }} type="module"></script>
        <script src={{ asset('js/report.js') }} type="module"></script>

        <script src={{ asset('js/pagination.js') }} defer></script>
    @endsection

    <div class="page-margin">

        <!-- Banned User Alert -->
        @if($user->ban === true)
            <div class="alert alert-danger deleted-alert container-lg" role="alert">
                This User <strong>{{$user->username}}</strong> has been banned. Only Administrators and Moderators can see this page.
            </div>
        @endif

        <!-- Profile Info -->
        @include('partials.profile.profile-info', $user)

        <!-- Questions/Answers Navigation -->
        <div class="container-lg p-0 mt-5">
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-5">
                <li class="page-question active nav-item ">
                    <button id="pagination-button-1" class="nav-link page-link">Questions</button>
                </li>
                <li class="page-answer nav-item">
                    <button id="pagination-button-2" class="nav-link page-link">Answers</button>
                </li>
            </ul>
        </div>

        <section id="pagination-item-1" class="container-lg mt-5 profile-questions-preview px-0">
            <!-- Search Bar -->
            <form class="me-auto" id="search-questions">
                <div class="d-flex">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="d-block my-1 reset-search mb-3" id="reset-search-questions">Reset search</button>
            </form>

            <div>
                @include('partials.profile.question-list', $questions)
            </div>
        </section>

        <section id="pagination-item-2" class="container-lg mt-5 profile-questions-preview px-0">
            <!-- Search Bar -->
            <form class="me-auto" id="search-answers">
                <div class="d-flex">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="d-block my-1 reset-search mb-3" id="reset-search-answers">Reset search</button>
            </form>
            
            <div>
                @include('partials.profile.answer-list', $answers)
            </div>
        </section>
    </div>
    @include('partials.common.report-modal')
    @include('partials.common.toast')
@endsection
