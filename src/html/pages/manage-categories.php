<?php include_once('html/common/templates.php');

function trash(){ ?>
    <span class="icon-hover" title="Delete">
        <button class="p-0"><i class="far fa-trash-alt"></i></button> 
        <button class="p-0"><i class="fas fa-trash-alt"></i></button> 
    </span>
<?php } ?>

<?php 
function tags_table(){ ?>
    <div class="table-responsive">
        <div class="table-entries">Showing 1 to 6 of 11 entries</div>
        <table class="table table-hover align-middle w-100">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><i class="fas fa-sort"></i>Tag</th>
                    <th scope="col"><i class="fas fa-sort"></i>Number of uses</th>
                    <th scope="col"><i class="fas fa-sort big-row"></i>Date</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>SOPE</td>
                    <td>30</td>
                    <td>12/01/2020</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>PPIN</td>
                    <td>50</td>
                    <td>04/02/2020</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>exam</td>
                    <td>45</td>
                    <td>28/01/2020</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>IART</td>
                    <td>26</td>
                    <td>18/08/2020</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Mechanics</td>
                    <td>24</td>
                    <td>28/12/2019</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Design</td>
                    <td>19</td>
                    <td>05/07/2017</td>
                    <td><?php trash();?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php function courses_table(){ ?>
    <div class="table-responsive">
        <div class="table-entries">Showing 1 to 4 of 4 entries</div>
        <table class="table table-hover align-middle w-100">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><i class="fas fa-sort"></i>Course</th>
                    <th scope="col"><i class="fas fa-sort"></i>Number of uses</th>
                    <th scope="col"><i class="fas fa-sort big-row"></i>Date</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>MIEIC</td>
                    <td>300</td>
                    <td>12/01/2020</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>MIEC</td>
                    <td>50</td>
                    <td>04/02/2020</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>MIEGI</td>
                    <td>45</td>
                    <td>28/01/2020</td>
                    <td><?php trash();?></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>MIEIM</td>
                    <td>26</td>
                    <td>12/01/2020</td>
                    <td><?php trash();?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<!-- Sub nav bar - Mobile -->
<nav class="bd-subnavbar align-items-center p-2" aria-label="Secondary navigation">
  <ul class="d-flex m-0 p-0">
    <li class="nav-link nav-item subnav-selected"><a href="manage-categories.php">Categories</a></li>
    <li class="nav-link nav-item"><a href="manage-reports.php">Reports</a></li>
    <li class="nav-link nav-item"><a href="manage-users.php">Users</a></li>
  </ul>
</nav>

<div class="d-flex justify-content-between page-margin management-content">
    <!-- Side Bar - will be a template -->
    <aside class="mt-5 col-md-3 col-lg-2 mt-5 d-md-block management-nav">
        <ul>
            <li><a href="manage-categories.php" class="blue">Manage Categories</a></li>
            <li><a href="manage-reports.php">Manage Reports</a></li>
            <li><a href="manage-users.php">Manage Users</a></li>
        </ul>
    </aside>

    <div class="col-md-9 ms-md-auto col-lg-9 px-md-4 side-content">
        <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="page-question active nav-item">
            <li class="page-question active nav-item">
                <button id="pagination-button-1" class="nav-link">Tags</button>
            </li>
            <li class="page-answer nav-item">
                <button id="pagination-button-2" class="nav-link">Courses
                </button>
            </li>
        </ul>

        <!-- Manage tags-->
        <section id="pagination-item-1" class="management manage-categories w-100 mt-5">
            <h2 class="mb-4">Tags</h2>

            <form class="mt-5 d-flex justify-content-between flex-wrap mb-3">
                <div class="input-group manage-search mb-3">
                    <input type="text" class="form-control" placeholder="Insert a tag...">
                    <button class="btn btn-primary">Add Tag</button>
                </div>
                <div class="input-group manage-search mb-3 ms-3">
                    <input type="text" class="form-control" placeholder="Search tag...">
                    <button class="btn btn-primary">Search Tag</button>
                </div>
            </form>

            <!-- Tags -->
            <?php  tags_table(); ?>

            <!-- Pagination -->
            <ul class="pagination justify-content-center">
                <li class="page-item page-1 active"><button class="page-link">1</button></li>
                <li class="page-item page-2"><button class="page-link">2</button></li>
                <li class="page-item page-3"><button class="page-link">3</button></li>
            </ul>
        </section>

        <!-- Manage courses -->
        <section id="pagination-item-2" class="management manage-categories w-100 mt-5">
            <h2 class="mb-4">Courses</h2>

            <form class="mt-5 d-flex justify-content-between flex-wrap mb-3">
                <div class="input-group manage-search  mb-3">
                    <input type="text" class="form-control" placeholder="Insert a course...">
                    <button class="btn btn-primary">Add Course</button>
                </div>
            </form>

            <!-- Courses -->
            <?php  courses_table(); ?>

            <!-- Pagination -->
            <ul class="pagination justify-content-center">
                <li class="page-item page-1 active"><button class="page-link">1</button></li>
                <li class="page-item page-2"><button class="page-link">2</button></li>
                <li class="page-item page-3"><button class="page-link">3</button></li>
            </ul>
        </section>

    </div>
</div>