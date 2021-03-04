  

<!-- Sub nav bar - Mobile -->
<nav class="bd-subnavbar align-items-center" aria-label="Secondary navigation">
  <li class="nav-link nav-item subnav-selected"><button>New Questions</button></li>
  <li class="nav-link nav-item dropdown">
    <button class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      By Course
    </button>
    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
        <li><a class="dropdown-item" href="#">MIEIC</a></li>
        <li><a class="dropdown-item" href="#">MIB</a></li>
        <li><a class="dropdown-item" href="#">MIEC</a></li>
        <li><a class="dropdown-item" href="#">MIEGI</a></li>
        <li><a class="dropdown-item" href="#">MIEEC</a></li>
        <li><a class="dropdown-item" href="#">MIEM</a></li>
      </ul>
  </li>
  <li class="nav-link nav-item"><button>By Tag</button></li>
</nav>

<div class="row page-margin" id="search-page">

  <!-- Sidebar -->
  <aside id="side-bar" class="col-md-3 col-lg-3 d-md-block bg-light sidebar accordion">
      <div class="accordion-item active">
        <h6 class="accordion-header">
          <button type="button">New Questions
          </button>
        </h6>
      </div>
    <div class="accordion-item">
      <h6 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Courses
        </button>
      </h6>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div>
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#list-home" role="tab" >MIEIC</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-profile" role="tab">MIB</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-messages" role="tab" >MIEC</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-settings" role="tab" >MIEGI</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-settings" role="tab" >MIEEC</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-settings" role="tab" a>MIEM</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h6 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Tags
        </button>
      </h6>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div>
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-home" role="tab" aria-controls="home">PPIN</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="profile">COMP</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="messages">LBAW</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="settings">IART</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="settings">SDIS</a>
                <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="settings">EXAM</a>
            </div>
          </div>
        </div >
      </div>
    </div>
  </aside>
  
  <!-- Questions Results -->
  <section id="search-questions" class="col-md-9 ms-sm-auto col-lg-9 px-md-4">
    <header>
      <h2>Search</h2>
      <h5>by keyword </h5>
    
      <!-- Search Bar -->
      <form class="d-flex me-auto" id="questions-search-bar">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
          <i class="fas fa-search"></i>
          </button>
        </div>
      </form>

    </header>
  
    <!-- Questions -->
    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
          <div>2</div>
          <div>answers</div>
        </div>
        <div class="counts">
          <div>1</div>
          <div>votes</div>
        </div>
        <div class="card-body">
          <header class="card-header">
              <div class="question-header d-flex align-items-center">

                  <!-- Mobile Question details -->
                  <div class="d-none question-details d-flex mb-3">
                      <!-- Course -->
                      <span class="category course badge rounded-pill bg-secondary">
                          <i class="fas fa-graduation-cap"></i>
                          MIEIC
                      </span>
                  </div>

                  <!-- Question Title -->
                  <h4 class="card-title flex-grow-1">Should I learn MIPS? </h4> <!-- Question Title -->

                  <!-- Desktop Question details -->
                  <div class="question-details d-flex">
                      <!-- Course -->
                      <span class="category course badge rounded-pill bg-secondary">
                          <i class="fas fa-graduation-cap"></i>
                          MIEIC
                      </span>

                  </div>
              </div>
          </header>

          <!-- Tags and User -->
          <footer class="card-footer d-flex align-items-center flex-wrap">
              <div class="flex-grow-1 mb-1">
                <span class="category tag badge bg-secondary"> 
                    <i class="fas fa-hashtag"></i>
                    MIPS
                </span>
                <span class="category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    COMP
                </span>
              </div>
              <div class="question-author d-inline-flex align-items-center">
                  <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                  <div class="d-flex flex-wrap">
                      <span>Joaquina Almeida</span> <!-- Name -->
                      <span >15:02 - 10/05/2009</span> <!-- Date -->
                  </div>
              </div>
          </footer>
        </div>
        <div class="counts-mobile">
          <div>2 answers</div>
          <div>2 comments</div>
        </div>
    </article>


    <article class="question-preview card flex-row align-items-center">
        <div class="counts">
          <div>5</div>
          <div>answers</div>
        </div>
        <div class="counts">
          <div>2</div>
          <div>votes</div>
        </div>
        <div class="card-body">
          <header class="card-header">
              <div class="question-header d-flex align-items-center">

                  <!-- Mobile Question details -->
                  <div class="d-none question-details d-flex mb-3">
                      <!-- Course -->
                      <span class="category course badge rounded-pill bg-secondary">
                          <i class="fas fa-graduation-cap"></i>
                          MIEIC
                      </span>
                  </div>

                  <!-- Question Title -->
                  <h4 class="card-title flex-grow-1">I can't solve this integral!</h4> <!-- Question Title -->

                  <!-- Desktop Question details -->
                  <div class="question-details d-flex">
                      <!-- Course -->
                      <span class="category course badge rounded-pill bg-secondary">
                          <i class="fas fa-graduation-cap"></i>
                          MIEIC
                      </span>

                  </div>
              </div>
          </header>

          <!-- Tags and User -->
          <footer class="card-footer d-flex align-items-center flex-wrap">
              <div class="flex-grow-1 mb-1">
                <span class="category tag badge bg-secondary"> 
                    <i class="fas fa-hashtag"></i>
                    Amat
                </span>
              </div>
              <div class="question-author d-inline-flex align-items-center">
                  <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
                  <div class="d-flex flex-wrap">
                      <span>Joaquina Almeida</span> <!-- Name -->
                      <span >15:02 - 10/05/2009</span> <!-- Date -->
                  </div>
              </div>
          </footer>
        </div>
    </article>

