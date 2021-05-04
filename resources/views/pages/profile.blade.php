@extends('layouts.app')

@section('content')
<div class="page-margin">
    <section id="profile-main" class="card grid-profile container-lg">
        <div class="one">
            <h3 class="nickname mb-4">{{ $user->username }}</h3>
            <div class="profile-pic col-md mb-4">
                <img class="rounded-circle img-thumbnail" src="{{asset('images/profile.png')}}" alt="Profile Image">
            </div>
            <p><span class="score">User Score:</span> <span class="points">{{ $user->score }}</span></p>
        </div>
        <div class="two row">
            <section class="profile-info col-md mb-4">
                <h3>Personal</h3>
                <p><span class="profile-small-title"><i class="fas fa-user"></i> Name:</span> {{ $user->name }}</p>
                <p><span class="profile-small-title"><i class="fas fa-at"></i> E-mail:</span> {{ $user->email }}</p>
                <p><span class="profile-small-title"><i class="fa fa-calendar" aria-hidden="true"></i> Birthday:</span> {{ $user->birthday }}</p>
            </section>

            <section class="profile-about-me col-md mb-4">
                <h3>About Me</h3>
                <p> {{ $user->description }}</p>
            </section>
        </div>
        <section class="three profile-academic-info">
            <div class="row">
                <div class="col-md mb-4">
                    <h3>Academic Information</h3>
                    <p><span class="profile-small-title"><i class="fas fa-graduation-cap"></i> Course:</span> {{ $user->course->name }}</p>
                    <div>
                        <p><span class="profile-small-title"><i class="fas fa-tags"></i>Tags:</span>
                            @foreach ($user->tags as $tag)
                                <span class="category tag badge bg-secondary"> 
                                    <i class="fas fa-hashtag"></i>
                                    {{$tag->name}}
                                </span>
                            @endforeach
                        </p>
                    </div>
                </div>
                <!-- Check if its user page -->
                <div class="col-md d-flex justify-content-end align-items-end">
                    <a class="btn btn-primary my-2" href="/user/profile/edit">Edit Profile</a>
                </div>
            </div>
        </section>
    </section>

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
        @each('partials.question-card', $user->questions, 'question')
        <ul class="pagination justify-content-center">
            <li class="page-item page-1 active"><button class="page-link">1</button></li>
            <li class="page-item page-2"><button class="page-link">2</button></li>
            <li class="page-item page-3"><button class="page-link">3</button></li>
        </ul>
    </section>

    <section id="pagination-item-2" class="container-lg mt-5 profile-questions-preview px-0">
        <h3 class="mb-4">My Answers</h3>
        @each('partials.answer-card', $user->answers, 'answer')
        <ul id="pagination-answers" class="pagination justify-content-center profile-answers">
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
        </ul>
    </section>
</div>
@endsection