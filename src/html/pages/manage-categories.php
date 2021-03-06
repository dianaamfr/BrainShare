<?php

$tags = ['PPIN', 'MF_II', 'Exam', 'COMP', 'IART', 'Python'];
$courses = ['MIEIC', 'MIEEC', 'MIEC', 'MIEIM'];

function display_cards($array)
{
    foreach ($array as $element)
        echo get_card($element);
}

function get_card($element)
{

    $trash =   '<span class="icon-hover" title="Delete">
                    <button class="p-0"><i class="far fa-trash-alt"></i></button> 
                    <button class="p-0"><i class="fas fa-trash-alt"></i></button> 
                    </span>';

    return "<div class='card rounded-1 manage-tag-card px-3 py-2 mt-3 mx-1'>
                    <div class='card-body d-flex p-0'>
                        <span>$element</span>
                        $trash 
                    </div>
                </div> ";
}

?>


<header class="text-center my-bg-main-blue">
    <h1>Manage Categories</h1>
</header>

<div class="page-margin">
    <!-- pagination -->
    <ul id="main-pagination" class="pagination justify-content-center mt-0">
        <li class="page-item page-question active"><button id="pagination-button-1" class="page-link">Tags</button></li>
        <li class="page-item page-answer"><button id="pagination-button-2" class="page-link">Courses</button></li>
    </ul>

    <!-- Manage tags-->
    <div id="pagination-item-1" class="management">
        <section class="p-4 w-100 mx-1">
            <h3 class="mb-4">Tags</h3>
            <!-- Tags -->
            <div class="row">
                <?php for($i = 0; $i < 3; $i++){ display_cards($tags);} ?>
            </div>
        </section>

        <form class="mt-5 d-flex justify-content-between flex-wrap">
            <div class="input-group manage-search m-3">
                <input type="text" class="form-control" placeholder="Insert a tag...">
                <button class="btn btn-primary">Add Tag</button>
            </div>
            <div class="input-group manage-search m-3">
                <input type="text" class="form-control" placeholder="Search tag...">
                <button class="btn btn-primary">Search Tag</button>
            </div>
        </form>
    </div>

    <!-- Manage courses -->
    <div id="pagination-item-2" class="management">
        <section class="p-4 w-100 mx-1">
            <h3 class="mb-4">Courses</h3>
            <!-- Courses -->
            <div class="row">
                <?= display_cards($courses) ?>
            </div>
        </section>

        <form class="mt-5 d-flex justify-content-between flex-wrap">
            <div class="input-group manage-search m-3">
                <input type="text" class="form-control" placeholder="Insert a course...">
                <button class="btn btn-primary">Add Course</button>
            </div>
        </form>
    </div>
</div>