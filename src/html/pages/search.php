<?php include_once('html/common/templates.php'); ?>

<!-- Sub nav bar - Mobile -->
<nav class="bd-subnavbar align-items-center" aria-label="Secondary navigation">
  <ul class="d-flex m-0 p-0">
    <li class="nav-link nav-item subnav-selected"><button>Newest</button></li>
    <li class="nav-link nav-item"><button>Popular</button></li>

    <li class="nav-link nav-item">
      <select>
          <option selected disabled>Courses</option>
          <option>MIEIC</option>
          <option>MIB</option>
          <option>MIEC</option>
          <option>MIEGI</option>
          <option>MIEEC</option>
          <option>MIEM</option>
      </select>
    </li>
    <li class="nav-link nav-item">
      <select>
            <option selected disabled>Tags</option>
            <option>PPIN</option>
            <option>COMP</option>
            <option>LBAW</option>
            <option>IART</option>
            <option>SDIS</option>
            <option>exam</option>
        </select>
    </li>
  </ul>
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
      <h6 class="accordion-header">
        <button type="button">Popular Questions
        </button>
      </h6>
    </div>
    <div class="accordion-item">
      <h6 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" data-bs-parent="#side-bar">
          Courses
        </button>
      </h6>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#side-bar">
        <div class="accordion-body">
          <div>
            <nav class="list-group">
              <button class="list-group-item list-group-item-action" data-bs-toggle="list">MIEIC</button>
              <button class="list-group-item list-group-item-action"  data-bs-toggle="list">MIB</button>
              <button class="list-group-item list-group-item-action"  data-bs-toggle="list">MIEC</button>
              <button class="list-group-item list-group-item-action"  data-bs-toggle="list">MIEGI</button>
              <button class="list-group-item list-group-item-action"  data-bs-toggle="list">MIEEC</button>
              <button class="list-group-item list-group-item-action"  data-bs-toggle="list">MIEM</button>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h6 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" data-bs-parent="#side-bar">
          Tags
        </button>
      </h6>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#side-bar">
        <div class="accordion-body">
          <div>
            <div class="list-group">
              <button class="list-group-item list-group-item-action" data-bs-toggle="list">PPIN</button>
              <button class="list-group-item list-group-item-action" data-bs-toggle="list">COMP</button>
              <button class="list-group-item list-group-item-action" data-bs-toggle="list">LBAW</button>
              <button class="list-group-item list-group-item-action" data-bs-toggle="list">IART</button>
              <button class="list-group-item list-group-item-action" data-bs-toggle="list">SDIS</button>
              <button class="list-group-item list-group-item-action" data-bs-toggle="list">exam</button>
            </div>
          </div>
        </div >
      </div>
    </div>
  </aside>
  
  <!-- Questions Results -->
  <section id="search-questions" class="col-md-9 ms-md-auto col-lg-9 px-md-4">

    <div class="container-md mt-5">
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
    </div>
  
    <!-- Questions -->
    <section class="container-md mt-5">
        <?php 
            questionPreview();
        ?>
        <ul id="pagination-questions" class="pagination justify-content-center">
            <li class="page-item page-1 active"><button class="page-link">1</button></li>
            <li class="page-item page-2"><button class="page-link">2</button></li>
            <li class="page-item page-3"><button class="page-link">3</button></li>
        </ul>
    </section>
  </section>

</div>
