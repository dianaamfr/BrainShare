<?php
    function questionPreview(){ ?>
        <article class="question-preview card flex-row align-items-center">
            <div class="counts">
            <div>2</div>
            <div>answers</div>
            </div>
            <div class="counts">
            <div>1</div>
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
                        <h4 class="card-title flex-grow-1">Should I learn MIPS? Or is it a waist of time nowadays? </h4> <!-- Question Title -->

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
                        <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                        <div class="d-flex flex-wrap">
                            <span>Joaquina Almeida</span> <!-- Name -->
                            <span >15:02 - 10/05/2009</span> <!-- Date -->
                        </div>
                    </div>
                </footer>
            </div>
            <div class="counts-mobile">
                <div>2 answers</div>
                <div>1 votes</div>
            </div>
        </article>


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
                    <h4 class="card-title flex-grow-1">I can't solve this integral!</h4> <!-- Question Title -->

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
                    <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                    <div class="d-flex flex-wrap">
                        <span>Joaquina Almeida</span> <!-- Name -->
                        <span >15:02 - 10/05/2009</span> <!-- Date -->
                    </div>
                </div>
            </footer>
            
            <div class="counts-mobile">
                <div>2 answers</div>
                <div>2 votes</div>
            </div>
            </div>
        </article>
<?php } ?>

<?php
    function answerPreview(){ ?>
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
                        <h4 class="card-title flex-grow-1">Should I learn MIPS? Or is it a waist of time nowadays? </h4>

                        <div class="d-flex flex-column justify-content-center col-auto">
                            <i class="fas fa-check text-center"></i>
                        </div>
                    </div>
                </header>

                <!-- Question Text -->
                <div class="answer-content col-lg">
                    <h4>My Answer</h4>
                    <p>Yes! I think MIPS is worth learning even nowadays. Even though it may be hard, it can help you to develop skills that will be usefull for some types of jobs. I really works your brain!</p>
                </div>

                <!-- User -->
                <footer class="card-footer d-flex align-items-center flex-wrap">
                    <div class="question-author d-inline-flex align-items-center">
                        <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                        <div class="d-flex flex-wrap">
                            <span>Joaquina Almeida</span> <!-- Name -->
                            <span >15:02 - 10/05/2009</span> <!-- Date -->
                        </div>
                    </div>
                </footer>

                <div class="counts-mobile">
                    <div>2 answers</div>
                    <div>2 comments</div>
                </div>
            </div>
        </article>


        <article class="question-preview card flex-row align-items-center">
            <div class="counts">
                <div>5</div>
                <div>comments</div>
            </div>
            <div class="counts">
                <div>3</div>
                <div>votes</div>
            </div>
            <div class="card-body">
                <header class="card-header">
                    <div class="question-header d-flex align-items-center">
                        <!-- Question Title -->
                        <h4 class="card-title flex-grow-1">I can't solve this integral!</h4> <!-- Question Title -->
                    </div>
                </header>

                <!-- Question Text -->
                <div class="answer-content col-lg">
                    <h4>My Answer</h4>
                    <p>Yes! I think MIPS is worth learning even nowadays. Even though it may be hard, it can help you to develop skills that will be usefull for some types of jobs. I really works your brain!</p>
                </div>

                <!--User -->
                <footer class="card-footer d-flex align-items-center flex-wrap">
                    <div class="flex-grow-1 mb-1">
                        <span class="category tag badge bg-secondary"> 
                            <i class="fas fa-hashtag"></i>
                            Amat
                        </span>
                    </div>
                    <div class="question-author d-inline-flex align-items-center">
                        <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                        <div class="d-flex flex-wrap">
                            <span>Joaquina Almeida</span> <!-- Name -->
                            <span >15:02 - 10/05/2009</span> <!-- Date -->
                        </div>
                    </div>
                </footer>

                <div class="counts-mobile">
                    <div>2 answers</div>
                    <div>2 comments</div>
                </div>
            </div>
        </article>
<?php } ?>
