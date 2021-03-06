<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    
    <!-- Our Css -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    
    <!-- Font Awesom -->
    <script src="https://kit.fontawesome.com/cf05cece41.js" crossorigin="anonymous"></script>
    
    <!-- Pagination -->
    <script src="js/pagination.js" defer></script>

    <!-- Rich Text -->
    <link rel="stylesheet" href="http://lab.lepture.com/editor/editor.css" />
    <script type="text/javascript" src="http://lab.lepture.com/editor/editor.js" defer></script>
    <script type="text/javascript" src="http://lab.lepture.com/editor/marked.js" defer></script>
    
    <!-- Our Rich Text script -->
    <script src="js/editor.js" defer></script> 
    <script src="js/parseMD.js" defer></script> 

    <!-- Carousel -->
    <!-- <script src="js/homepage-carousel.js" defer></script> -->
    
    <!-- Library to translate MD to html  --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha512-L03kznCrNOfVxOUovR6ESfCz9Gfny7gihUX/huVbQB9zjODtYpxaVtIaAkpetoiyV2eqWbvxMH9fiSv5enX7bw==" crossorigin="anonymous"></script> 
    
    <title>BrainShare</title> 

  </head>

<body>
  <header class="fixed-top m-auto">
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
      <div class="container-fluid">

        <!-- Logo - link to Home Page -->
        <a class="navbar-brand" href="index.php">BrainShare</a>

        <!-- Tablet Search Bar -->
        <form class="header-search d-flex me-auto tablet-header-search" action="search.php" >
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
        
        <!-- Mobile Notifications Icon -->
        <div class="icon-hover notifications-mobile">
          <button><i class="far fa-bell"></i></button>
          <button><i class="fas fa-bell"></i></button>
        </div>

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

          <!-- Main Pages -->
          <ul class="navbar-nav mb-2 mb-xl-0">

            <?php // Registered Users options
              if(/* isset($_SESSION['username']) && ($_SESSION['username'] !== '') */true){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="add-question.php">Add Question</a>
                </li>
            <?php }?>
            
            <!-- TODO: If the User is a Moderator show this options --> 
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Management
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="manage-categories.php">Manage Categories</a></li>
                <li><a class="dropdown-item" href="manage-reports.php">Manage Reports</a></li>
                <li><a class="dropdown-item" href="manage-users.php">Manage Users</a></li>
              </ul>
            </li>
          </ul>

          <!-- Registration/Account -->
          <div class="registration-menu btn-toolbar mb-2 mb-xl-0 align-items-center flex-nowrap">

            <?php // Registered Users options
              if(/*isset($_SESSION['username']) && ($_SESSION['username'] !== '')*/true){ ?>
                <a class="nav-link profile-button registration-button">
                    <img src="images/profile.png" alt="profile picture" class="rounded-circle">
                    Joaquina Almeida<!-- Name goes here -->
                </a>
                <div class="registration-button icon-hover notifications">
                  <button><i class="far fa-bell"></i></button>
                  <button><i class="fas fa-bell"></i></button>
              </div>
                <a class="registration-button btn btn-outline-primary" href="#">Logout</a>
            <?php }
            else { // Unregistered Users options ?> 
                <a class="registration-button btn btn-primary" href="login.php">Login</a>
                <a class="registration-button btn btn-primary" href="register.php">Register</a>
            <?php } ?>
            
          </div>

        </div>
      </div>
    </nav>
  </header>
  <main class="flex-grow-1">