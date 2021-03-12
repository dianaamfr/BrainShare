
<?php
function questionForm($courses){ ?>
    <div class="page-margin">
        <section class="background-light container-sm add-question card rounded-1">
            <h2 class="mb-4">Add Question</h2>
            <form>
                <!-- Question Title -->
                <div class="mb-3">
                    <label for="questionTitle" class="form-label">Question Title*</label>
                    <input type="text" class="form-control" id="questionTitle" placeholder="Write the title here" value="Should I learn MIPS?" aria-describedby="questionTitleHelp" required>
                    <div id="questionTitleHelp" class="form-text">Try to make the question as clear as possible.</div>
                </div>

                <!-- Question Body -->
                <div class="mb-3">
                    <label for="question-text-area" class="form-label">Question Body*</label>
                    <div class="border form-control">
                        <textarea id="question-text-area" class="form-control" placeholder="Describe your problem here" style="height: 100px" aria-describedby="questionBodyHelp" required>Is the MIPS programming language that beneficial to know? I'm a CS student and am taking a assembly class which focuses on MIPS. I'm very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future? I mean, look at this:
                    ```
                    .text 
                    .globl main
                    main:
                    #The following block of code is to pre-load the integer values representing the various instructions into registers for storage
                    li $t3, 1 #This is to load the immediate value of 1 into the temporary register $t3
                    li $t4, 2 #This is to load the immediate value of 2 into the temporary register $t4 
                    li $t5, 3 #This is to load the immediate value of 3 into the temporary register $t5
                    ```</textarea>
                    </div>
                    <div id="questionBodyHelp" class="form-text">Describe all the details that may help others understand your question.</div>
                </div>

                <!-- Course -->
                <div class="mb-3">
                    <label for="questionCourseSelect" class="form-label">Course</label>
                    <select id="questionCourseSelect" class="form-select">
                        <option>No Course</option>
                        <?php foreach($courses as $course){
                            if($course == 'MIEIC') {?>
                                <option value=<?= $course ?>><?= $course ?></option>
                            <?php } else { ?>
                                <option value=<?= $course ?>><?= $course ?></option>
                        <?php } } ?>
                    </select>
                </div>
                
                <!-- Tags -->
                <div class="mb-3">
                    <label for="questionTagsSelect" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="questionTagsSelect" placeholder="Associate Tags here">

                    <div class="d-flex flex-wrap">
                        <div class='card rounded-1 manage-tag-card px-3 py-2 mt-3'>
                            <div class='card-body d-flex p-0'>
                                <span>MIPS</span>
                                <span class="icon-hover" title="Delete">
                                    <button class="p-0"><i class="far fa-trash-alt"></i></button> 
                                    <button class="p-0"><i class="fas fa-trash-alt"></i></button> 
                                </span>
                            </div>
                        </div>
                        <div class='card rounded-1 manage-tag-card px-3 py-2 mt-3 mx-1'>
                            <div class='card-body d-flex p-0'>
                                <span>COMP</span>
                                <span class="icon-hover" title="Delete">
                                    <button class="p-0"><i class="far fa-trash-alt"></i></button> 
                                    <button class="p-0"><i class="fas fa-trash-alt"></i></button> 
                                </span> 
                            </div>
                        </div> 
                    </div>
                </div>
        
                <!--<button type="submit" class="btn btn-primary mt-3">Add Question</button>-->
                <a class="btn btn-primary mt-3" href="question.php">Add Question</a>
            </form>
        </section>
    </div>
<?php } ?>
