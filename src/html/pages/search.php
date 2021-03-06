<?php include_once('html/common/templates.php'); ?>

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

<div class="d-flex justify-content-between page-margin" id="search-page">

  <!-- Sidebar -->
  <aside id="side-bar" class="col-md-3 col-lg-3 d-md-block bg-light sidebar accordion">
      <div class="accordion-item active">
        <h6 class="accordion-header">
          <button type="button" class="blue">New Questions
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
  <section id="search-questions" class="col-md-9 ms-md-auto col-lg-9 px-md-4">
    <header>
      <h2>Search</h2>
      <h5>by keyword </h5>
    
      <!-- Search Bar -->
      <form class="d-flex me-auto" id="questions-search-bar">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" title="Search">
          <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
    </header>
  
    <!-- Questions -->
    <section class="container-md mt-5" id="heyhey">
        <?php for($i = 0; $i < 2; $i++) { 
            questionPreview();
        } ?>
        <ul id="pagination-questions" class="pagination justify-content-center">
            <li class="page-item page-1 active"><button class="page-link">1</button></li>
            <li class="page-item page-2"><button class="page-link">2</button></li>
            <li class="page-item page-3"><button class="page-link">3</button></li>
        </ul>
    </section>
</section> 
