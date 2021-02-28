<article class="question card">
    <div class="card-body">
    <header class="card-header">
        <div class="question-header d-flex align-items-center">
            <!-- Question Title -->
            <h2 class="card-title flex-grow-1">Should I learn MIPS? </h2> <!-- Question Title -->

            <!-- Course -->
            <span class="category course badge rounded-pill bg-secondary">
                <i class="fas fa-graduation-cap"></i>
                MIEIC
            </span>

            <!-- Edit/Delete: only for Registred Users -->
            <!-- <div class="edit-question">
                <button><i class="fas fa-edit"></i></button>
                <button><i class="fas fa-trash-alt"></i></button>
            </div> -->
        </div>
    
        <div class="question-author d-inline-flex">
            <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
            <span>Joaquina Almeida</span> <!-- Name -->
            <span >15:02 - 10/05/2009</span> <!-- Date -->
        </div>
    </header>

    <!-- Question Text -->
    <div class="question-content card-body">
        <p>Is the MIPS programming language that beneficial to know? I'm a CS student and am taking a assembly class which focuses on MIPS. I'm very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?</p>
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
    </footer>

    </div>

</article>

<section class="answers">
    <header>
        <h4 class="d-inline-block">1 Answer</h4>
        <a class="btn btn-primary float-end" href="#submit-answer">Add Answer</a>
    </header>
    <div class="answer card">
        <div class="card-body card">
            <header>
            <div class="question-author pagination justify-content-end text-muted align-items-center">
                <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                <span>Joaquina Almeida</span> <!-- Name -->
                <span>15:02 - 10/05/2009</span> <!-- Date -->
            </div>
            </header>

            <div class="row align-items-center">
                <div class="col-md-auto d-flex flex-column justify-content-md-center align-items-center">
                    <p class="points m-0">5</p>
                    <i class="bi bi-chevron-up d-flex"></i>
                    <i class="bi bi-chevron-down d-flex"></i>
                </div>

                <div class="col align-self-start">
                    <p>I doesn't really look that cool but do whatever man.</p>
                    <p>Just trust in your heart!</p>
                </div>

                <div class="d-flex flex-column justify-content-md-center col-md-auto">
                    <i class="fas fa-check text-center"></i>
                </div>
            </div>

            <footer class="d-flex align-items-center">
                <span class="comments flex-grow-1">1 Comments</span>
                <a class="btn btn-link" data-bs-toggle="collapse" href="#collapseCommentForm" role="button" aria-expanded="false" aria-controls="collapseCommentForm">Add Comment</a>
            </footer>
        </div>
        <div class="comments">
            <div class="collapse" id="collapseCommentForm">
                <form id="submit-comment" action="" method="">
                    <div class="mb-3">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Type your comment here"></textarea>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-secondary mt-3" type="submit">Submit</button>
                        <button class="btn btn-outline-secondary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentForm" aria-expanded="false" aria-controls="collapseCommentForm">Cancel</button>
                    </div>
                    </div>
                </form>
            </div>
            <?php for($i = 0; $i < 2; $i++){ ?>
                <div class="comment">
                <div class="comment-text d-inline-block">
                    <p>Please don't use C unless you have to.</p>
                </div>
                <span class="comment-author">
                    <span>- Joaquina Almeida</span> <!-- Name -->
                    <span>15:02 - 10/05/2009</span> <!-- Date -->
                </span>
            </div>
            <?php }
        ?>
        </div>
    </div>
</section>

<form id="submit-answer" action="" method="">
    <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Post an Answer</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type your answer here"></textarea>
    <button class="btn btn-primary mt-3" type="submit">Submit Answer</button>
    </div>
</form>