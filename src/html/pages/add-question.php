
<?php
function questionForm($courses){ ?>
    <div class="page-margin ">
        <section class="container-sm add-question rounded-1">
            <h2 class="mb-4">Add Question</h2>
            <form>
                <!-- Question Title -->
                <div class="mb-3">
                    <label for="questionTitle" class="form-label">Question Title</label>
                    <input type="text" class="form-control" id="questionTitle" placeholder="Write the title here" aria-describedby="questionTitleHelp">
                    <div id="questionTitleHelp" class="form-text">Try to make the question as clear as possible.</div>
                </div>

                <!-- Question Body -->
                <div class="mb-3">
                    <label for="questionTextarea" class="form-label">Question Body</label>
                    <div class="container border form-control">
                        <textarea id="question-text-area" class="form-control" placeholder="Describe your problem here" id="questionTextarea" style="height: 100px" aria-describedby="questionBodyHelp"></textarea>
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
                    <input type="text" class="form-control" id="questionTagsSelect" placeholder="Associate Tags here">
                </div>
        
                <button type="submit" class="btn btn-primary mt-3">Add Question</button>
            </form>
        </section>
    </div>
<?php } ?>
