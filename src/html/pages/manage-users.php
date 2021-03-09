<!-- Sub nav bar - Mobile -->
<nav class="bd-subnavbar align-items-center p-2" aria-label="Secondary navigation">
  <ul class="d-flex m-0 p-0">
    <li class="nav-link nav-item"><a href="manage-categories.php">Categories</a></li>
    <li class="nav-link nav-item"><a href="manage-reports.php">Reports</a></li>
    <li class="nav-link nav-item subnav-selected"><a href="manage-users.php">Users</a></li>
  </ul>
</nav>

<div class="d-flex justify-content-between page-margin management" id="users"> 
    <!-- Side Bar - will be a template -->
    <aside class="mt-5 col-md-3 col-lg-3 mt-5 d-md-block management-nav">
        <ul>
            <li><a href="manage-categories.php">Manage Categories</a></li>
            <li><a href="manage-reports.php">Manage Reports</a></li>
            <li><a href="manage-users.php" class="blue">Manage Users</a></li>
        </ul>
    </aside>

    <div class="col-md-9 ms-md-auto col-lg-9 px-md-4 side-content">
        <h2 class="mb- mt-5">Users</h2>

        <form class="mt-5 d-flex justify-content-between flex-wrap mb-3">
            <div class="input-group manage-search mb-3">
                <input type="text" class="form-control" placeholder="Search by username">
                <button class="btn btn-primary">Search</button>
            </div>
        </form>

            <div class="table-responsive w-100">
                <div class="table-entries">Showing 1 to 2 of 2 entries</div>
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><i class="fas fa-sort"></i>Username</th>
                            <th scope="col"><i class="fas fa-sort big-row"></i>Date</th>
                            <th scope="col"><i class="fas fa-sort"></i>Banned</th>
                            <th scope="col"><i class="fas fa-sort"></i>Role</th>
                            <th scope="col"><i class="fas fa-sort"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><img class="rounded-circle" src="images/profile.png" alt="profile icon"><a href="profile.php">maria_albertina2</a></td>
                            <td>12/01/2020</td>
                            <td>N</td>
                            <td>Moderator</td>
                            <td>
                            <form>
                                <div class="input-group flex-nowrap">
                                    <select class="form-select">
                                        <option selected disabled value="none">Actions</option>
                                        <option value="all">Make Administrator</option>
                                        <option value="all">Demote Moderator</option>
                                        <option value="users">Remove ban</option>
                                        <option value="answer">Ban</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </form>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td><img class="rounded-circle" src="images/profile.png" alt="profile icon"><a href="profile.php">marcioRb34</a></td>
                            <td>10/02/2020</td>
                            <td>Y</td>
                            <td>User</td>
                            <td>
                                <form>
                                    <div class="input-group flex-nowrap">
                                        <select class="form-select">
                                            <option selected disabled value="none">Actions</option>
                                            <option value="all">Make Administrator</option>
                                            <option value="all">Make Moderator</option>
                                            <option value="users">Remove ban</option>
                                            <option value="answer">Ban</option>
                                        </select>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>
