<?php function report_actions(){ ?>
    <form>
        <div class="input-group flex-nowrap">
            <select class="reportsDropdownActions form-select">
                <option selected disabled value="none">Actions</option>
                <option value="all">Ban</option>
                <option value="users">Delete Account</option>
                <option value="answer">Discard Report</option>
            </select>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i>
            </button>
        </div>
    </form>

<?php } ?>

<div class="d-flex justify-content-between page-margin management" id="reports"> 
    <aside class="mt-5 col-md-3 col-lg-3 mt-5 d-md-block management-nav">
        <ul>
            <li><a href="manage-categories.php">Manage Categories</a></li>
            <li><a href="manage-reports.php" class="blue">Manage Reports</a></li>
            <li><a href="manage-users.php">Manage Users</a></li>
        </ul>
    </aside>

    <section id="search-questions" class="col-md-9 ms-md-auto col-lg-9 px-md-4">
        <h2 class="mb- mt-5">Reports</h2>

        <form class="mt-5 d-flex justify-content-between flex-wrap mb-3">
            <div class="btn-toolbar mb-3 w-100 align-items-end">
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

        <section class="w-100 mt-5">
            <table class="table table-hover align-middle">
                <thead >
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-sort"></i>Summary</th>
                        <th scope="col"><i class="fas fa-sort"></i>Type</th>
                        <th scope="col" id="reports-number"><i class="fas fa-sort"></i>Reports</th>
                        <th scope="col"><i class="fas fa-sort"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Joaquina123</td>
                        <td>User</td>
                        <td>2</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>I can't solve this integral!</td>
                        <td>Question</td>
                        <td>3</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>joaquina123</td>
                        <td>Answer</td>
                        <td>6</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>   
                    <tr>
                        <th scope="row">4</th>
                        <td>I doesn't really look that cool but do whatever man.</td>
                        <td>Comment</td>
                        <td>1</td>
                        <td>
                            <?php report_actions(); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </section>
</div>
