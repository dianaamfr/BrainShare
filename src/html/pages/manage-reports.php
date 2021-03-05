<header class="text-center my-bg-main-blue">
    <h1>Manage Reports</h1>
</header>

<div class="user-administration bg-light page-margin">

    <section class="p-4 management">
        <header>
            <h3 class="mb-4">Management Options</h3>

            <!-- Filter -->
            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <button class="btn btn-primary dropdown-toggle me-4 mb-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    All
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Users</a></li>
                    <li><a class="dropdown-item" href="#">Answers</a></li>
                    <li><a class="dropdown-item" href="#">Questions</a></li>
                    <li><a class="dropdown-item" href="#">Comments</a></li>
                </ul>
                <div class="input-group rounded flex-grow-1 mb-3">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
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
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Ban</a></li>
                                    <li><a class="dropdown-item" href="#">Delete Account</a></li>
                                    <li><a class="dropdown-item" href="#">Discard Report</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>I can't solve this integral!</td>
                        <td>Question</td>
                        <td>3</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Ban</a></li>
                                    <li><a class="dropdown-item" href="#">Delete Account</a></li>
                                    <li><a class="dropdown-item" href="#">Discard Report</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>joaquina123</td>
                        <td>Answer</td>
                        <td>6</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Ban</a></li>
                                    <li><a class="dropdown-item" href="#">Delete Account</a></li>
                                    <li><a class="dropdown-item" href="#">Discard Report</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>   
                    <tr>
                        <th scope="row">4</th>
                        <td>I doesn't really look that cool but do whatever man.</td>
                        <td>Comment</td>
                        <td>1</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Ban</a></li>
                                    <li><a class="dropdown-item" href="#">Delete Account</a></li>
                                    <li><a class="dropdown-item" href="#">Discard Report</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div