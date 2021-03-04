<?php

include_once(dirname(__DIR__) . "\common\header.php");

$tags = ['PPIN', 'MF_II', 'Exam', 'COMP', 'IART', 'Python'];
$courses = ['MIEIC', 'MIEEC', 'MIEC', 'MIEIM'];

function display_cards($array)
{
    foreach ($array as $element)
        echo get_card($element);
}

function get_card($element)
{

    $trash =   '<span class="icon-hover">
                    <button><i class="far fa-trash-alt"></i></button> 
                    <button><i class="fas fa-trash-alt"></i></button> 
                    </span>';

    return "<div class='card mt-3 mx-1 col-md-3 manage-card'>
                    <div class='card-body  manage-tag-card'>
                        <span>$element</span>
                        $trash 
                    </div>
                </div> ";
}

?>


<div class="text-center my-bg-main-blue">
    <h1>Manage Categories</h1>
</div>

<div class="bg-light">
    <!-- pagination -->
    <ul id="main-pagination" class="pagination justify-content-center mt-0">
        <li class="page-item page-question active"><button id="pagination-button-1" class="page-link">My Questions</button></li>
        <li class="page-item page-answer"><button id="pagination-button-2" class="page-link">My Answers</button></li>
    </ul>

    <!-- Manage tags-->
    <section id="pagination-item-1" class="p-4 w-100 mx-1 ">
        <div class="container">

            <h2 class="display-5 mb-5 mx-5">Tags</h2>
            <!-- Tags -->
            <div class="row">
                <?= display_cards($tags) ?>
            </div>
            <form class="card mt-5">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Insert a tag...">
                    <button class="btn my-bg-main-green">Add Tag</button>
                    </input>
                </div>
            </form>

        </div>
    </section>

    <!-- Manage courses -->
    <section id="pagination-item-2" class="p-4 w-100 mx-1">
        <div class="container">

            <h2 class="display-5 mb-5 mx-5">Courses</h2>
            <!-- Courses -->
            <class class="row">
                <?= display_cards($courses) ?>
            </class>
            <form class="card mt-5">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Insert a course...">
                    <button class="btn my-bg-main-green">Add Course</button>
                    </input>
                </div>
            </form>
        </div>

    </section>

</div>