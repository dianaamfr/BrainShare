<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/cf05cece41.js" crossorigin="anonymous"></script>

    <!-- Pagination -->
    <script type="text/javascript" src={{ asset('js/pagination.js') }} defer>

    <!-- Rich Text -->
    <link rel="stylesheet" href="http://lab.lepture.com/editor/editor.css" />
    <script src="https://lab.lepture.com/editor/editor.js" defer></script>
    <script src="https://lab.lepture.com/editor/marked.js" defer></script>
    
    <!-- Scripts -->
    <script type="text/javascript" src={{ asset('js/editor.js') }} defer>
    <script type="text/javascript" src={{ asset('js/parseMD.js') }} defer>
    <script type="text/javascript" src={{ asset('js/removeMD.js') }} defer>

    <!-- Carousel -->
    <!-- <script src="js/homepage-carousel.js" defer></script> -->

    <!-- Library to translate MD to html --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw==" crossorigin="anonymous"></script> 
    
</script>
  </head>
  <body>
    <main>
    <header class="fixed-top m-auto">
      <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <div class="container-fluid">

          <!-- Logo - link to Home Page -->
          <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'BrainShare') }}</a>

          <!-- Tablet Search Bar -->
          <form class="header-search d-flex me-auto tablet-header-search" action="search.php" >
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">
              <i class="fas fa-search"></i>
              </button>
            </div>
          </form>

          <!-- Mobile Menu Icon -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>      

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Search Bar -->
          <form class="header-search d-flex me-auto main-search" action="search.php" >
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">
              <i class="fas fa-search"></i>
              </button>
            </div>
          </form>

            <!-- Registration/Account -->
            <div class="ms-4 registration-menu btn-toolbar mb-2 mb-xl-0 align-items-center flex-nowrap">

              <!-- Registered Users options -->
              @if (Auth::check())
                <a class="nav-link profile-button registration-button" href="profile.php">
                    <img src="images/profile.png" alt="profile picture" class="rounded-circle">
                    {{ Auth::user()->username }}
                </a>
                <div class="registration-button icon-hover notifications " data-bs-toggle="modal" data-bs-target="#notificationsModal">
                  <button><i class="far fa-bell"></i></button>
                  <button><i class="fas fa-bell"></i></button>
                </div>
                <a class="registration-button btn btn-outline-primary" href="{{ route('logout') }}">Logout</a>
              @else 
                <a class="registration-button btn btn-primary" href="{{ route('login') }}">Login</a>
                <a class="registration-button btn btn-primary" href="{{ route('register') }}">Register</a>
              @endif
            </div>

          </div>
        </div>
      </nav>

    </header>
    <section id="content">
      @yield('content')
    </section>
    </main>

    <footer class="pt-5 pb-3">
        <nav class="row container m-auto">
            <div class="col-6 col-md">
                <h5>Who we are</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary" href="index.php">Home</a></li>
                    <li><a class="link-secondary" href="about.php">About us</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Authentication</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary" href="login.php">Login</a></li>
                    <li><a class="link-secondary" href="register.php">Register</a></li>
                    <li><a class="link-secondary" href="profile.php">Profile</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary" href="search.php">Search Questions</a></li>
                    <li><a class="link-secondary" href="add-question.php">Add Question</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Management</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary" href="manage-categories.php">Manage Categories</a></li>
                    <li><a class="link-secondary" href="manage-reports.php">Manage Reports</a></li>
                    <li><a class="link-secondary" href="manage-users.php">Manage Users</a></li>
                </ul>
            </div>
        </nav>
    </footer>
  </body>
</html>
