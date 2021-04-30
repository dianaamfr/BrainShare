@extends('layouts.app')

@section('content')
<div class="page-margin">
    <section id="profile-main" class="card grid-profile container-lg">
        <div class="one">
            <h3 class="nickname mb-4">joaquina123</h3>
            <div class="profile-pic col-md mb-4">
                <img class="rounded-circle img-thumbnail" src="{{asset('images/profile.png')}}" alt="Profile Image">
            </div>
            <p><span class="score">User Score:</span> <span class="points">17 points</span></p>
        </div>
        <div class="two row">
            <section class="profile-info col-md mb-4">
                <h3>Personal</h3>
                <p><span class="profile-small-title"><i class="fas fa-user"></i> Name:</span> Maria Joaquina</p>
                <p><span class="profile-small-title"><i class="fas fa-at"></i> E-mail:</span> up201806230@fe.up.pt</p>
                <p><span class="profile-small-title"><i class="fa fa-calendar" aria-hidden="true"></i> Birthday:</span> 09/02/1997</p>
            </section>

            <section class="profile-about-me col-md mb-4">
                <h3>About Me</h3>
                <p>Hello! It's Joaquina! I'm currently studying Informatic Engineering (MIEIC) at FEUP. My dream is to work at google and become a great software engineer. I love dogs and cats, I hope I love you too.</p>
            </section>
        </div>
        <section class="three profile-academic-info">
            <div class="row">
                <div class="col-md mb-4">
                    <h3>Academic Information</h3>
                    <p><span class="profile-small-title"><i class="fas fa-graduation-cap"></i> Course:</span>MIEIC</p>
                    <div>
                        <p><span class="profile-small-title"><i class="fas fa-tags"></i>Tags:</span>
                            <span class="category tag badge bg-secondary"> 
                                <i class="fas fa-hashtag"></i>
                                MIPS
                            </span>
                            <span class="category tag badge bg-secondary">
                                <i class="fas fa-hashtag"></i>
                                COMP
                            </span>
                        </p>
                    </div>
                </div>
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
        <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>3</div>
            <div>answers</div>
        </div>
        <div class="counts">
            <div>7</div>
            <div>votes</div>
        </div>
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
                    </div>

                    <!-- Question Title -->
                    <h4 class="card-title flex-grow-1"><a href="#">What is the best language to use in the project?</a></h4> <!-- Question Title -->

                    <!-- Desktop Question details -->
                    <div class="question-details d-flex">
                        <!-- Course -->
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            MIEIC
                        </span>

                    </div>
                </div>
            </header>

            <!-- card body -->
           <div class="limited-text-3 card-body md-content md-remove"> 
                <h2>I just love python. </h2> 
                <p>But I don't know if it will be slow for artifitial intelligence. <br>
                Guys, what do you think? </p>

            </div>

            <!-- Tags and User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        IART
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        JAVA
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        Python
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>marciod</span> <!-- Username -->
                        <span>17:30 - 8/03/2020</span> <!-- Date -->
                    </div>
                </div>
            </footer>
        </div>
        <div class="counts-mobile">
            <div>3 answers</div>
            <div>7 votes</div>
        </div>
    </article>


    <!-- Question Example 5 -->
    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>1</div>
            <div>answers</div>
        </div>
        <div class="counts">
            <div>6</div>
            <div>votes</div>
        </div>
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
                    </div>

                    <!-- Question Title -->
                    <h4 class="card-title flex-grow-1"><a href="#">How to install pandas?</a></h4>

                    <!-- Desktop Question details -->
                    <div class="question-details d-flex">
                        <!-- Course -->
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            MIEIC
                        </span>

                    </div>
                </div>
            </header>

            <!-- card body -->
           <div class="limited-text-3 card-body md-content md-remove"> 
                My professor has asked me to use pandas to get some statistics. <br>
                however i'm having a terrible time to install it. <br>
                i've asked some collegues and they also don't know how to do it. i know it may be a foolish question, because there's the official website explaining how to do it, but the instructions were so confused that it didn't work. can someone help me, please? 

                i've asked some collegues and they also don't know how to do it. i know it may be a foolish question, because there's the official website explaining how to do it, but the instructions were so confused that it didn't work. can someone help me, please?
                i've asked some collegues and they also don't know how to do it. i know it may be a foolish question, because there's the official website explaining how to do it, but the instructions were so confused that it didn't work. can someone help me, please?

            </div>

            <!-- Tags and User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        IART
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        Python
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile_image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>prd</span> <!-- Username -->
                        <span>22:23 - 21/02/2021</span> <!-- Date -->
                    </div>
                </div>
            </footer>
        </div>
        <div class="counts-mobile">
            <div>1 answers</div>
            <div>6 votes</div>
        </div>
    </article>

    <!-- Question Example 6 -->
    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>2</div>
            <div>answers</div>
        </div>
        <div class="counts">
            <div>12</div>
            <div>votes</div>
        </div>
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
                    </div>

                    <!-- Question Title -->
                    <h4 class="card-title flex-grow-1"><a href="#">Should I learn C instead of C++? Is C obsolete nowadays?</a></h4>

                    <!-- Desktop Question details -->
                    <div class="question-details d-flex">
                        <!-- Course -->
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            MIEIC
                        </span>

                    </div>
                </div>
            </header>
            <!-- card body -->
           <div class="limited-text-3 card-body md-content md-remove"> 
                I was thinking of learning a new language. I know C is very popular, but if I learn C++ will I learn C too?
            </div>


            <!-- Tags and User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        C
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        C++
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>carlosmaia</span> <!-- Username -->
                        <span>17:41 - 25/09/2020</span> <!-- Date -->
                    </div>
                </div>
            </footer>
        </div>
        <div class="counts-mobile">
            <div>2 answers</div>
            <div>12 votes</div>
        </div>
    </article>

        <ul class="pagination justify-content-center">
            <li class="page-item page-1 active"><button class="page-link">1</button></li>
            <li class="page-item page-2"><button class="page-link">2</button></li>
            <li class="page-item page-3"><button class="page-link">3</button></li>
        </ul>
    </section>

    <section id="pagination-item-2" class="container-lg mt-5 profile-questions-preview px-0">
    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>2</div>
            <div>comments</div>
        </div>
        <div class="counts">
            <div>1</div>
            <div>votes</div>
        </div>
        <div class="card-body">
            <header class="card-header">
                <div class="question-header d-flex align-items-center">

                    <!-- Question Title -->
                    <h4 class="card-title flex-grow-1"><a href="#">Should I learn C instead or C++? Is C obsolete nowadays?</a></h4>

                    <div class="d-flex flex-column justify-content-center col-auto">
                        <i class="fas fa-check text-center"></i>
                    </div>
                </div>
            </header>

            <!-- Question Text -->
            <div class="answer-content col-lg">
                <h4>My Answer</h4>
                <div class="limited-text-3 md-content md-remove">
                    C is really just a simple language that can be easily read and understood. Also it has barely changed in the last 30 years, which means that many programmers know it well, thus you will find a lot of material online about everything you need while using C, and as a programmer, you often read more code that you write, so it is important to understand what many of your experienced coworkes have built.
                </div>
            </div>

            <!-- User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        C
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        C++
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>joaquina123</span> <!-- Username -->
                        <span>17:30 - 17/04/2009</span> <!-- Date -->
                    </div>
                </div>
            </footer>

            <div class="counts-mobile">
                <div>2 answers</div>
                <div>1 comments</div>
            </div>
        </div>
    </article>




    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>0</div>
            <div>comments</div>
        </div>
        <div class="counts">
            <div>6</div>
            <div>votes</div>
        </div>
        <div class="card-body">
            <header class="card-header">
                <div class="question-header d-flex align-items-center">
                    <!-- Question Title -->
                    <h4 class="card-title flex-grow-1"><a href="#">How to install Pandas</a></h4> <!-- Question Title -->
                </div>
            </header>

            <!-- Question Text -->
            <div class="answer-content col-lg">
                <h4>My Answer</h4>

                <div class="limited-text-3 md-content md-remove">
                    <p> You might have missed a basic step in the provided guide. <br> 
                    One simple mistake might have been related to compatibility issues. Pandas is only supported by Python version 3.71 and above. Use "python --version" command to check your current version and update it if necessary  </p> 
                </div>
            </div>

            <!--User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        IART
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>joaquina123</span> <!-- Username -->
                        <span>13:02 - 14/05/2009</span> <!-- Date -->
                    </div>
                </div>
            </footer>
            <div class="counts-mobile">
                <div>0 answers</div>
                <div>6 comments</div>
            </div>
        </div>
    </article>

        <h3 class="mb-4">My Answers</h3>
        <ul id="pagination-answers" class="pagination justify-content-center profile-answers">
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
        </ul>
    </section>
</div>
@endsection