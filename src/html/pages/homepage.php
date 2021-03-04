<?php

include_once(dirname(__DIR__) . "\common\header.php");

$question1 =
    '<article class="profile-question container my-4 border shadow rounded">
        <!-- Question Title -->
        <div class="row">
            <div class="col-lg-2">
                <h4>0 answers</h4>
            </div>

            <div class="d-flex align-items-center col-lg">
                <h2 class="card-title flex-grow-1"><a href="#">Should I learn MIPS?</a></h2> <!-- Question Title -->

                <span class="category course badge rounded-pill bg-primarya">
                    <i class="fas fa-graduation-cap"></i>
                    MIEIC
                </span>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-2">
                <span class="category-profile-question category tag badge bg-secondary"> 
                    <i class="fas fa-hashtag"></i>
                    MIPS
                </span>
                <span class="category-profile-question category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    COMP
                </span>
            </section>

            <!-- Question Text -->
            <div class="question-content col-lg">
                <p>Is the MIPS programming language that beneficial to know? Im a CS student and am taking a assembly class which focuses on MIPS. Im very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?</p>
            </div>
        </div>

        <!-- Question Date -->
        <section class="date-user-text">
            <p>
                <img class="rounded-circle date-user-image" src="images/profile.png" alt="Profile Image">
                <span>Joaquina Almeida</span>
                <span >15:02 - 10/05/2009</span>
            </p>
        </section>
        </article>';

$question2 =
    '<article class="profile-question container my-4 border shadow rounded">
        <!-- Question Title -->
        <div class="row">
            <div class="col-lg-2">
                <h4>0 answers</h4>
            </div>

            <div class="d-flex align-items-center col-lg">
                <h2 class="card-title flex-grow-1"><a href="#">TESTE 1</a></h2> <!-- Question Title -->

                <span class="category course badge rounded-pill bg-secondary">
                    <i class="fas fa-graduation-cap"></i>
                    MIEIC
                </span>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-2">
                <span class="category-profile-question category tag badge bg-secondary"> 
                    <i class="fas fa-hashtag"></i>
                    MIPS
                </span>
                <span class="category-profile-question category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    COMP
                </span>
            </section>

            <!-- Question Text -->
            <div class="question-content col-lg">
                <p>Is the MIPS programming language that beneficial to know? Im a CS student and am taking a assembly class which focuses on MIPS. Im very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?</p>
            </div>
        </div>

        <!-- Question Date -->
        <section class="date-user-text">
            <p>
                <img class="rounded-circle date-user-image" src="images/profile.png" alt="Profile Image">
                <span>Joaquina Almeida</span>
                <span >15:02 - 10/05/2009</span>
            </p>
        </section>
        </article>';

$question3 =
    '<article class="profile-question container my-4 border shadow rounded">
        <!-- Question Title -->
        <div class="row">
            <div class="col-lg-2">
                <h4>0 answers</h4>
            </div>

            <div class="d-flex align-items-center col-lg">
                <h2 class="card-title flex-grow-1"><a href="#">TESTE 2</a></h2> <!-- Question Title -->

                <span class="category course badge rounded-pill bg-secondary">
                    <i class="fas fa-graduation-cap"></i>
                    MIEIC
                </span>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-2">
                <span class="category-profile-question category tag badge bg-secondary"> 
                    <i class="fas fa-hashtag"></i>
                    MIPS
                </span>
                <span class="category-profile-question category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    COMP
                </span>
            </section>

            <!-- Question Text -->
            <div class="question-content col-lg">
                <p>Is the MIPS programming language that beneficial to know? Im a CS student and am taking a assembly class which focuses on MIPS. Im very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?</p>
            </div>
        </div>

        <!-- Question Date -->
        <section class="date-user-text">
            <p>
                <img class="rounded-circle date-user-image" src="images/profile.png" alt="Profile Image">
                <span>Joaquina Almeida</span>
                <span >15:02 - 10/05/2009</span>
            </p>
        </section>
        </article>';

?>

<!-- Banner -->
<div class="position-relative text-center homepage-container-hero text-light">
    <div class="banner-text col-md-5 mx-auto">
        <h1 class="display-3"> BrainShare </h1>
        <p class="lead fw-normal mb-3"> The FEUP website for questions and answers. We connect students to solutions to improve your academic grow. </p>
        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-primary mx-3">Search</a>
            <a href="#" class="btn btn-primary mx-3">Add Question</a>
        </div>
    </div>

</div>

<div class="page-margin">

    <div class="mx-3">

        <!-- Featured text  -->
        <div class="row py-5 homepage-feature">
            <div class="col-md-6 homepage-feature-text">
                <h2 class="mb-4 ">What is BrainShare? <span class="text-muted ">The way to learn.</span> </h2>
                <p class="mb-5">BrainShare is a Q&A forum that allows FEUP students to answer their own doubts about about their courses!
                    All our features are completely free, since our goal is to be the center of information in our college.</p>
                <a href="#" class="btn btn-outline-primary mb-4">About Us</a>
            </div>
            <div class="col-md-5 homepage-feature-image1">
            </div>
        </div>

        <!-- Courses -->
        <section class="homepage-course"> 
            <h2 class="mb-4 text-center">Courses</h2>
            <div class="row">
                <div class="col-lg-4 homepage-course-container my-5 d-flex flex-column align-items-center">
                    <div class="course-icon" id="course-icon1"></div>
                    <h3 class="mt-4">MIEIC</h3>
                    <p>Matesters in Informatics and Computation Engineering</p>
                    <a href="#" class="btn btn-outline-primary">Check questions</a>
                </div>
                <div class="col-lg-4 homepage-course-container my-5 d-flex flex-column align-items-center">
                    <div class="course-icon" id="course-icon2"></div>
                    <h3 class="mt-4">MIEC</h3>
                    <p>Masters in Civil Engineering</p>
                    <a href="#" class="btn btn-outline-primary">Check questions</a>
                </div>
                <div class="col-lg-4 homepage-course-container my-5 d-flex flex-column align-items-center">
                    <div class="course-icon" id="course-icon3"></div>
                    <h3 class="mt-4">MIEEC</h3>
                    <p>Master in Electrical and Computers Engineering</p>
                    <a href="#" class="btn btn-outline-primary">Check questions</a>
                </div>
            </div>
        </section>

            <!-- Carousel  
            <div class="carousel slide my-4" data-ride="carousel" id="featuretted-questions"> 
                <h2 class="mb-4 fw-normal text-center">Featuretted questions</h2>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    </div>
                    <div class="carousel-item">
                    </div>
                    <div class="carousel-item">
                </div>
            </div> --->

            <section class="feature questions">
                <h2 class="mb-4 fw-normal text-center">Featured Questions</h2>
                    <div>
                        <?= $question1 ?>
                    </div>
                    <div>
                        <?= $question2 ?>
                    </div>
                    <div>
                        <?= $question3 ?>
                </div>
            </section>
            <!-- Nav buttons -->

            <button class="carousel-control-prev" role="button" data-slide="prev">
                <span class="display-4 text-dark"> &lt; </span>
                <span class="sr-only">Next</span>
            </button>
            <button class="carousel-control-next" role="button" data-slide="next">
                <span class="display-4 text-dark"> &gt; </span>
                <span class="sr-only">Previous</span>
            </button>

        </div>

    </div>

</div>