<header class="text-center my-bg-main-blue">
    <h1>Manage Users</h1>
</header>

<div class="user-administration bg-light page-margin">
    
    <section class="p-4 management">
        <header>
            <h3 class="mb-4">Management Options</h3>

            <div class="input-group rounded flex-grow-1 mb-3">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
                <button type="button" class="btn btn-primary">Search</button>
            </div>
        </header>

        <div class="table-responsive">
            <table class="table table-hover  align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-sort"></i>Username</th>
                        <th scope="col"><i class="fas fa-sort"></i>Name</th>
                        <th scope="col" id="users-register-date"><i class="fas fa-sort big-row"></i>Date</th>
                        <th scope="col"><i class="fas fa-sort"></i>Status</th>
                        <th scope="col"><i class="fas fa-sort"></i>Role</th>
                        <th scope="col"><i class="fas fa-sort"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img class="rounded-circle" src="images/profile.png" alt="">maria_albertina2</td>
                        <td>Maria Joaquina</td>
                        <td>12/01/2020</td>
                        <td>Active</td>
                        <td>Moderator</td>
                        <td>
                            <select class="reportsDropdownActions me-4 mb-3 form-select">
                                <option selected disabled value="none">Actions</option>
                                <option value="all">Make Administrator</option>
                                <option value="users">Remove ban</option>
                                <option value="answer">Delete Account</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><img class="rounded-circle" src="images/profile.png" alt="">marcioRb34</td>
                        <td>Marcio Rebelo</td>
                        <td>10/02/2020</td>
                        <td>Banned</td>
                        <td>User</td>
                        <td>
                            <select class="reportsDropdownActions me-4 mb-3 form-select">
                                <option selected disabled value="none">Actions</option>
                                <option value="all">Make Administrator</option>
                                <option value="users">Remove ban</option>
                                <option value="answer">Delete Account</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div
    