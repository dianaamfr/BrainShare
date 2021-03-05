
<?php
function editQuestionForm($courses) { ?>
    <div class="page-margin" id="add-question-page">
        <section class="container-sm add-question bg-light rounded-1">
            <h2 class="mb-4">Edit Question</h2>
            <form>
                <!-- Question Title -->
                <div class="mb-3">
                    <label for="questionTitle" class="form-label">Question Title</label>
                    <input type="text" class="form-control" id="questionTitle" value="Should I learn MIPS?">
                    <div id="questionTitleHelp" class="form-text">Try to make the question as clear as possible.</div>
                </div>

                <!-- Question Body -->
                <div class="mb-3">
                    <label for="questionTextarea" class="form-label">Question Body</label>
                    <div class="container border form-control">
                        <textarea id="question-text-area" class="form-control" placeholder="Describe your problem here" id="questionTextarea" style="height: 100px" aria-describedby="questionBodyHelp">Is the MIPS programming language that beneficial to know? I'm a CS student and am taking a assembly class which focuses on MIPS. I'm very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?
                        </textarea>
                    </div>
                    <div id="questionBodyHelp" class="form-text">Describe all the details that may help others understand your question.</div>
                </div>

                <!-- Course -->
                <div class="mb-3">
                    <label for="questionCourseSelect" class="form-label">Course</label>
                    <select id="questionCourseSelect" class="form-select">
                        <option selected>No Course</option>
                        <?php foreach($courses as $course){?>
                            <option value=<?= $course ?>><?= $course ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <!-- Tags -->
                <div class="mb-3">
                    <label for="questionTagsSelect" class="form-label">Tags</label>
                    <input type="text" class="form-control" placeholder="Associate Tags here">
                </div>
        
                <button type="submit" class="btn btn-primary mt-3">Edit Question</button>
            </form>
        </section>
    </div>
<?php } ?>
