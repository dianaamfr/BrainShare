@extends('layouts.app')

@section('content')
    @section('scripts')
        <script src={{ asset('js/profile.js') }} type="module"></script>
        <script src={{ asset('js/report.js') }} type="module"></script>

        <script src={{ asset('js/pagination.js') }} defer></script>
    @endsection

    <div class="page-margin">
        <!-- Profile Info -->
        @include('partials.profile.profile-info', $user)

        <!-- Questions/Answers Navigation -->
        <div class="container-lg p-0 mt-5">
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-5">
                <li class="page-question active nav-item ">
                    <button id="pagination-button-1" class="nav-link page-link">My Questions</button>
                </li>
                <li class="page-answer nav-item">
                    <button id="pagination-button-2" class="nav-link page-link">My Answers</button>
                </li>
            </ul>

            <!-- Search Bar -->
            <form class="d-flex me-auto" id="profile-search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <section id="pagination-item-1" class="container-lg mt-5 profile-questions-preview px-0">
            <h3 class="mb-4">My Questions</h3>
            @include('partials.profile.question-list', $questions)
        </section>

        <section id="pagination-item-2" class="container-lg mt-5 profile-questions-preview px-0">
            <h3 class="mb-4">My Answers</h3>
            @include('partials.profile.answer-list', $answers)
        </section>
    </div>
    @include('partials.common.report-modal')
    @include('partials.common.toast')
@endsection
