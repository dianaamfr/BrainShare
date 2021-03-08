<?php include_once('html/common/templates.php'); ?>

  <!-- Banner -->
    <div class="position-relative text-center homepage-container-hero text-light">
        <div class="banner-text col-md-6 mx-auto">
            <h1 class="display-3 pb-2"> BrainShare </h1>
            <p class="lead pb-2"> The FEUP website for questions and answers. We connect students to solutions to improve your academic experience. </p>
            <div class="d-flex justify-content-center">
                <a href="search.php" class="btn btn-primary mx-3">Search</a>
                <a href="add-question.php" class="btn btn-primary mx-3">Add Question</a>
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
                    <a href="about.php" class="btn btn-outline-secondary mb-4">About Us</a>
                </div>
                <div class="col-md-5 homepage-feature-image1">
                </div>
            </div>

            <!-- Courses -->
            <section class="homepage-course position-relative"> 
                <h2 class="mb-4 text-center">Courses</h2>
                <div class="row gx-0 ">
                    <div class="col-md-4 homepage-course-container my-5 d-flex flex-column align-items-center text-center">
                        <div class="course-icon" id="course-icon1"></div>
                        <h3 class="mt-4">MIEIC</h3>
                        <p class="mb-3">Matesters in Informatics and Computation Engineering</p>
                        <a href="search.php#" class="btn btn-outline-secondary">Check questions</a>
                    </div>
                    <div class="col-md-4 homepage-course-container my-5 d-flex flex-column align-items-center text-center">
                        <div class="course-icon" id="course-icon2"></div>
                        <h3 class="mt-4">MIEC</h3>
                        <p class="mb-3">Masters in Civil Engineering</p>
                        <a href="search.php#" class="btn btn-outline-secondary">Check questions</a>
                    </div>
                    <div class="col-md-4 homepage-course-container my-5 d-flex flex-column align-items-center text-center">
                        <div class="course-icon" id="course-icon3"></div>
                        <h3 class="mt-4">MIEEC</h3>
                        <p class="mb-3">Master in Electrical and Computers Engineering</p>
                        <a href="search.php#" class="btn btn-outline-secondary">Check questions</a>
                    </div>
                </div>

                <!-- Arrows -->
                <button class="carousel-control-prev" data-slide="prev">
                    <span class="display-4 text-dark"> &lt; </span>
                    <span class="sr-only">Next</span>
                </button>
                <button class="carousel-control-next" data-slide="next">
                    <span class="display-4 text-dark"> &gt; </span>
                    <span class="sr-only">Previous</span>
                </button>
            </section>

            <section class="feature questions">
                <h2 class="mb-4 text-center">Featured Questions</h2>
                <div class="my-5">
                    <?php
                        firstQuestions();
                    ?>
                </div>  
            </section>
        </div>
    </div>
