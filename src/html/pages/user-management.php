<div class="user-administration">

    <header>
        <h1>Users</h1>

        <div class="input-group rounded" id="">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-secondary">Search</button>
        </div>
    </header>

    <table class="table table-bordered border-0 table-responsive-sm">
        <thead>
            <tr>
                <th scope="col" >#</th>
                <th scope="col"><i class="fas fa-sort"></i>Username</th>
                <th scope="col"><i class="fas fa-sort"></i>Name</th>
                <th scope="col"><i class="fas fa-sort"></i>Register Date</th>
                <th scope="col"><i class="fas fa-sort"></i>Status</th>
                <th scope="col"><i class="fas fa-sort"></i>Role</th>
                <th scope="col"><i class="fas fa-sort"></i>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Joaquina</td>
                <td>Maria Joaquina</td>
                <td>12/01/2020</td>
                <td>Active</td>
                <td>Moderator</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Promote to Administrator</a></li>
                            <li><a class="dropdown-item" href="#">Demote from Moderator</a></li>
                            <li><a class="dropdown-item" href="#">Ban</a></li>
                            <li><a class="dropdown-item" href="#">Delete Account</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>MarcioRB</td>
                <td>Marcio Rebelo</td>
                <td>10/02/2020</td>
                <td>Banned</td>
                <td>User</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Promote to Administrator</a></li>
                            <li><a class="dropdown-item" href="#">Promote to Moderator</a></li>
                            <li><a class="dropdown-item" href="#">Remove ban</a></li>
                            <li><a class="dropdown-item" href="#">Delete Account</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div
    