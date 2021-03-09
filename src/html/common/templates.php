<?php

function firstQuestions(){ ?>
     <!-- Question Example 1 -->
     <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>1</div>
            <div>answers</div>
        </div>
        <div class="counts">
            <div>5</div>
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">Should I learn MIPS? Or is it a waste of time nowadays?</a></h4>

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

            <!-- Tags and User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        MIPS
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        COMP
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Joaquina Almeida</span> <!-- Name -->
                        <span>15:02 - 10/05/2009</span> <!-- Date -->
                    </div>
                </div>
            </footer>
        </div>
        <div class="counts-mobile">
            <div>1 answers</div>
            <div>5 votes</div>
        </div>
    </article>

    <!-- Question Example 2 -->
    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>5</div>
            <div>answers</div>
        </div>
        <div class="counts">
            <div>2</div>
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">I can't solve this integral!</a></h4> <!-- Question Title -->

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

            <!-- Tags and User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        Amat
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Joaquina Almeida</span> <!-- Name -->
                        <span>15:02 - 10/05/2009</span> <!-- Date -->
                    </div>
                </div>
            </footer>

            <div class="counts-mobile">
                <div>2 answers</div>
                <div>2 votes</div>
            </div>
        </div>
    </article>

    <!-- Question Example 3 -->
    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>2</div>
            <div>answers</div>
        </div>
        <div class="counts">
            <div>5</div>
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">How did you prepare for the Exam?</a></h4> <!-- Question Title -->

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

            <!-- Tags and User -->
            <footer class="card-footer d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        SDIS
                    </span>
                    <span class="category tag badge bg-secondary">
                        <i class="fas fa-hashtag"></i>
                        EXAM
                    </span>
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Paulo Sousa</span> <!-- Name -->
                        <span>19:57 - 27/04/2018</span> <!-- Date -->
                    </div>
                </div>
            </footer>
        </div>
        <div class="counts-mobile">
            <div>2 answers</div>
            <div>5 votes</div>
        </div>
    </article>

<?php } ?>

<?php
function questionPreview(){

    firstQuestions();?>

    <!-- Question Example 4 -->
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">What is the best language to use in the project?</a></h4> <!-- Question Title -->

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
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Márcio Rebelo</span> <!-- Name -->
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">How to install pandas?</a></h4>

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
                    <img class="rounded-circle" src="images/profile.png" alt="profile_image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Paulo Reis</span> <!-- Name -->
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">Should I learn C instead of C++? Is C obsolete nowadays?</a></h4>

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
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Carlos Da Maia</span> <!-- Name -->
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

    
<?php } ?>

<?php
function answerPreview()
{ ?>
    
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">Should I learn C instead or C++? Is C obsolete nowadays?</a></h4>

                    <div class="d-flex flex-column justify-content-center col-auto">
                        <i class="fas fa-check text-center"></i>
                    </div>
                </div>
            </header>

            <!-- Question Text -->
            <div class="answer-content col-lg">
                <h4>My Answer</h4>
                <p>C is really just a simple language that can be easily read and understood. Also it has barely changed in the last 30 years, which means that many programmers know it well, thus you will find a lot of material online about everything you need while using C, and as a programmer, you often read more code that you write, so it is important to understand what many of your experienced coworkes have built.</p>
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
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Joaquina Almeida</span> <!-- Name -->
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
                    <h4 class="card-title flex-grow-1"><a href="question.php">How to install Pandas</a></h4> <!-- Question Title -->
                </div>
            </header>

            <!-- Question Text -->
            <div class="answer-content col-lg">
                <h4>My Answer</h4>
                <p>You might have missed a basic step in the provided guide.</p>
                <p>One simple mistake might have been related to compatibility issues. Pandas is only supported by Python version 3.71 and above. Use "python --version" command to check your current version and update it if necessary</p>
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
                    <img class="rounded-circle" src="images/profile.png" alt="profile image"> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Joaquina Almeida</span> <!-- Name -->
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

    
<?php } ?>
