<?php function report_actions(){ ?>
    <form>
        <div class="input-group flex-nowrap">
            <select class="form-select">
                <option selected disabled value="none">Actions</option>
                <option value="all">Ban</option>
                <option value="users">Delete Content</option>
                <option value="answer">Discard Report</option>
            </select>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i>
            </button>
        </div>
    </form>

<?php } ?>

<!-- Sub nav bar - Mobile -->
<nav class="bd-subnavbar align-items-center p-2" aria-label="Secondary navigation">
  <ul class="d-flex m-0 p-0">
    <li class="nav-link nav-item"><a href="manage-categories.php">Categories</a></li>
    <li class="nav-link nav-item subnav-selected"><a href="manage-reports.php">Reports</a></li>
    <li class="nav-link nav-item"><a href="manage-users.php">Users</a></li>
  </ul>
</nav>

<div class="d-flex justify-content-between page-margin management" id="reports"> 
    <!-- Side Bar - will be a template -->
    <aside class="mt-5 col-md-3 col-lg-2 mt-5 d-md-block management-nav">
        <ul>
            <li><a href="manage-categories.php">Manage Categories</a></li>
            <li><a href="manage-reports.php" class="blue">Manage Reports</a></li>
            <li><a href="manage-users.php">Manage Users</a></li>
        </ul>
    </aside>

    <div class="col-md-9 ms-md-auto col-lg-9 px-md-4 side-content">
        <h2 class="mb- mt-5">Reports</h2>

        <form class="mt-5 d-flex justify-content-between flex-wrap mb-3">
            <div class="btn-toolbar w-100 align-items-end">
                <!--Type of report -->
                <div>
                    <label class="form-label" for="report-type">Report Type</label>
                    <select class="me-4 mb-3 form-select" id="report-type">
                        <option selected value="all">All</option>
                        <option value="users">Users</option>
                        <option value="answer">Answers</option>
                        <option value="comments">Comments</option>
                    </select>
                </div>

                <div class="input-group manage-search mb-3">
                    <input type="text" class="form-control" placeholder="Search by summary...">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <div class="table-entries">Showing 1 to 4 of 4 entries</div>
            <table class="table table-hover align-middle w-100">
                <thead >
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-sort"></i>Summary</th>
                        <th scope="col"><i class="fas fa-sort"></i>Type</th>
                        <th scope="col" id="reports-number"><i class="fas fa-sort"></i>Reports</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><a href="profile.php">joaquina123</a></td>
                        <td>User</td>
                        <td>2</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><a href="question.php">I can't solve this integral!</a></td>
                        <td>Question</td>
                        <td>3</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><a href="profile.php">joaquina123</a></td>
                        <td>Answer</td>
                        <td>6</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>   
                    <tr>
                        <th scope="row">4</th>
                        <td><a href="question.php">I doesn't really look that cool but do whatever man.</a></td>
                        <td>Comment</td>
                        <td>1</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <ul class="pagination justify-content-center">
            <li class="page-item page-1 active"><button class="page-link">1</button></li>
            <li class="page-item page-2"><button class="page-link">2</button></li>
            <li class="page-item page-3"><button class="page-link">3</button></li>
        </ul>
    </div>
</div>
