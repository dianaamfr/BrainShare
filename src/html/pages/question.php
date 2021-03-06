<div id="page-top" class="page-margin question-page">

    <!-- Question -->
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
                    <h2 class="card-title flex-grow-1">Should I learn MIPS? </h2> <!-- Question Title -->

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
                        <span>Joaquina Almeida</span> <!-- Name -->
                        <span>15:02 - 10/05/2009</span> <!-- Date -->
                    </div>
                </div>
            </header>

            <!-- Question Text -->
            <div class="row align-items-center px-3">
                <div class="col-auto d-flex flex-column justify-content-center align-items-center">
                    <p class="points m-0">5</p>
                    <i class="bi bi-chevron-up d-flex"></i>
                    <i class="bi bi-chevron-down d-flex"></i>
                </div>
                <div class="question-content md-content col align-self-start ps-4">
                    Is the MIPS programming language that beneficial to know? I'm a CS student and am taking a assembly class which focuses on MIPS. I'm very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future? I mean, look at this: <br>
                    ```
                    .text  <br> 
                    .globl main  <br> 
                    main:   <br> 
                    #The following block of code is to pre-load the integer values representing the various instructions into registers for storage <br> 
                    li $t3, 1 #This is to load the immediate value of 1 into the temporary register $t3 <br> 
                    li $t4, 2 #This is to load the immediate value of 2 into the temporary register $t4 <br> 
                    li $t5, 3 #This is to load the immediate value of 3 into the temporary register $t5 <br>
                    ```
                </div>
            </div>

            <!-- Tags -->
            <footer>
                <span class="category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    MIPS
                </span>
                <span class="category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    COMP
                </span>

                <div class="d-inline-flex align-items-right report-icon" title="Report">
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
                        <span>Joaquina Almeida</span> <!-- Name -->
                        <span>15:02 - 10/05/2009</span> <!-- Date -->
                    </div>
                </header>

                <div class="row align-items-center px-3">
                    <div class="col-auto d-flex flex-column justify-content-center align-items-center">
                        <p class="points m-0">5</p>
                        <i class="bi bi-chevron-up d-flex"></i>
                        <i class="bi bi-chevron-down d-flex"></i>
                    </div>

                    <div class="col align-self-start ps-4">
                        <p>I doesn't really look that cool but do whatever man.</p>
                        <p>Just trust in your heart!</p>
                    </div>

                    <div class="d-flex flex-column justify-content-center col-auto">
                        <i class="fas fa-check text-center"></i>
                    </div>
                </div>

                <footer class="d-flex align-items-center">
                    <span class="comments flex-grow-1">1 Comments</span>

                    <div class="d-inline-flex align-items-right report-icon" title="Report">
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
                    <form id="submit-comment" action="" method="">
                        <div class="mb-3 p-3">
                            <textarea class="form-control" rows="2" placeholder="Type your comment here"></textarea>
                            <div class="d-grid gap-2 d-flex justify-content-end">
                                <button class="btn btn-secondary mt-3" type="submit">Submit</button>
                                <button class="btn btn-outline-secondary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentForm" aria-expanded="false" aria-controls="collapseCommentForm">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php for ($i = 0; $i < 2; $i++) { ?>
                    <div class="comment">
                        <div class="comment-text d-inline-block">
                            <p>Please don't use C unless you have to.</p>
                        </div>
                        <span class="comment-author">
                            <span>- Joaquina Almeida</span> <!-- Name -->
                            <span>15:02 - 10/05/2009</span> <!-- Date -->
                        </span>
                        <div class="d-inline-flex align-items-right report-icon" title="Report">
                            <div class="icon-hover">
                                <button><i class="far fa-flag"></i></button>
                                <button><i class="fas fa-flag"></i></button>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </section>
    <!-- Submit Answer Form -->
    <form id="submit-answer" action="" method="">
        <div class="mb-1 p-3">
            <label for="question-text-area" class="form-label">Post an Answer</label>
                <div class="border form-control" id="submitAnswerTextarea">
                    <textarea id="question-text-area" class="form-control" placeholder="Type your answer here"></textarea>
                </div>
        <button class="btn btn-primary mt-3" type="submit">Submit Answer</button>
        </div>
        <div class="back-top">
            <a class="btn btn-outline-secondary mb-5" href=#page-top>Back to Question</a>
        </div>
    </form>
    
</div>