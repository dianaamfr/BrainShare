<div class="page-margin">
    <section id="register" class="container-sm card p-5">
        <h2 class="mb-4">Register</h2>
        <form class="text-start" data-toggle="validator">
            <div class="mb-4 text-center">
                <img class="bd-placeholder-img img-thumbnail rounded-circle mb-3" id="register-image" src="images/profile.png" alt="profile image">
                <div class="mb-4">
                <input type="file" id="register-file" class="form-control-file">
                <label for="register-file" class="custom-file-upload btn-link">
                    <i class="fa fa-upload"></i> Profile picture
                </label>
            </div>
            </div>
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" data-error="That email address is invalid" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" data-minlength="8" class="form-control" placeholder="Password" required>
                <div id="questionBodyHelp" class="form-text">Password must have 8 letters</div>
            </div>
            <div class="mb-4">
                <label for="password2" class="form-label">Password</label>
                <input type="password" id="password2" class="form-control" data-match="#password" data-match-error="Whoops, these don't match" placeholder="Repeat Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-register">Register</button>
        </form>
    </section> 
</div>