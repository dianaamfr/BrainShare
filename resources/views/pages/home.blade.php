@extends('layouts.app')

@section('content')
<div class="position-relative text-center homepage-container-hero text-light">
    <div class="banner-text col-md-6 mx-auto">
        <h1 class="display-3 pb-2"> BrainShare </h1>
        <p class="lead pb-2"> The FEUP website for questions and answers. We connect students to solutions to improve your academic experience. </p>
        <div class="d-flex justify-content-center">
            <a href="{{ route('search') }}" class="btn btn-primary mx-3">Search</a>
            <a href="{{ route('question') }}" class="btn btn-primary mx-3">Add Question</a>
        </div>
    </div>
</div>

<div class="page-margin">
    <div>
        <!-- Featured text  -->
        <div class="row py-5 homepage-feature gx-0">
            <div class="col-md-6 homepage-feature-text mb-5">
                <h2 class="mb-4 ">What is BrainShare? <span class="text-muted ">The way to learn.</span> </h2>
                <p class="mb-5">BrainShare is a Q&A forum that allows FEUP students to answer their own doubts about about their courses!
                    All our features are completely free, since our goal is to be the center of information in our college.</p>
                <a href="{{ route('about') }}" class="btn btn-outline-primary mb-4">About Us</a>
            </div>
            <div class="col-md-5 homepage-feature-image1">
            </div>
        </div>

        <section class="feature questions">
            <h2 class="mb-4 text-center">Featured Questions</h2>
            <div class="my-5">
                <!-- First questions -->
                @each('partials.common.question-card', $questions, 'question')
            </div> 
        </section>
    </div>
</div>
@endsection