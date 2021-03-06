<header class="text-center my-bg-main-blue">
    <h1>Manage Reports</h1>
</header>

<div class="user-administration page-margin" id="reports">

    <section class="p-4 management">
        <header>
            <h3 class="mb-4">Management Options</h3>

            <!-- Filter -->
            <div class="btn-toolbar mb-3">
                <select class="reportsDropdown me-4 mb-3 form-select">
                    <option selected value="all">All</option>
                    <option value="users">Users</option>
                    <option value="answer">Answers</option>
                    <option value="comments">Comments</option>
                </select>

                <div class="input-group rounded flex-grow-1 mb-3">
                    <input type="search" class="form-control rounded" placeholder="Search"/>
                    <button type="button" class="btn btn-primary">Search</button>
                </div>
            </div>
        </header>
    
        <div class="table-responsive">
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
                            <select class="reportsDropdownActions me-4 mb-3 form-select">
                                <option selected disabled value="none">Actions</option>
                                <option value="all">Ban</option>
                                <option value="users">Delete Account</option>
                                <option value="answer">Discard Report</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>I can't solve this integral!</td>
                        <td>Question</td>
                        <td>3</td>
                        <td>
                            <select class="reportsDropdownActions me-4 mb-3 form-select">
                                <option selected disabled value="none">Actions</option>
                                <option value="all">Ban</option>
                                <option value="users">Delete Account</option>
                                <option value="answer">Discard Report</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>joaquina123</td>
                        <td>Answer</td>
                        <td>6</td>
                        <td>
                            <select class="reportsDropdownActions me-4 mb-3 form-select">
                                <option selected disabled value="none">Actions</option>
                                <option value="all">Ban</option>
                                <option value="users">Delete Account</option>
                                <option value="answer">Discard Report</option>
                            </select>
                        </td>
                    </tr>   
                    <tr>
                        <th scope="row">4</th>
                        <td>I doesn't really look that cool but do whatever man.</td>
                        <td>Comment</td>
                        <td>1</td>
                        <td>
                            <select class="reportsDropdownActions me-4 mb-3 form-select">
                                <option selected disabled value="none">Actions</option>
                                <option value="all">Ban</option>
                                <option value="users">Delete Account</option>
                                <option value="answer">Discard Report</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>