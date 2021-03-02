  
<!-- Question Page total (não incluindo a sidebar)-->
<div id="search-page" >
  <header>
    <h1>Search</h1>
    <h2>by keyword </h2>
  
    <div class="input-group rounded" id="">
      <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
        aria-describedby="search-addon" />
      <span class="input-group-text border-0" id="search-addon">
        <i class="fas fa-search"></i>
      </span>
    </div>

    <div class="dropdown" id="mobile-dropdown-filters">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Courses
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="#">MIEIC</a></li>
        <li><a class="dropdown-item" href="#">MIB</a></li>
        <li><a class="dropdown-item" href="#">MIEC</a></li>
        <li><a class="dropdown-item" href="#">MIEGI</a></li>
        <li><a class="dropdown-item" href="#">MIEEC</a></li>
        <li><a class="dropdown-item" href="#">MIEM</a></li>
      </ul>
  </div>

  </header>

  
  <!-- Question -->
  <article class="question card">
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

                  <!-- Edit/Delete: only for Registred Users -->
                  <div class="edit-question ms-auto">
                      <button><i class="fas fa-edit"></i></button>
                      <button><i class="fas fa-trash-alt"></i></button>
                  </div>
              </div>

              <!-- Question Title -->
              <h2 class="card-title flex-grow-1">Should I learn MIPS? </h2> <!-- Question Title -->

              <!-- Desktop Question details -->
              <div class="question-details d-flex">
                  <!-- Course -->
                  <span class="category course badge rounded-pill bg-secondary">
                      <i class="fas fa-graduation-cap"></i>
                      MIEIC
                  </span>

                  <!-- Edit/Delete: only for Registred Users -->
                  <div class="edit-question">
                      <button><i class="fas fa-edit"></i></button>
                      <button><i class="fas fa-trash-alt"></i></button>
                  </div>
              </div>
          </div>
      
          <div class="question-author d-inline-flex align-items-center">
              <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
              <div class="d-flex flex-wrap">
                  <span>Joaquina Almeida</span> <!-- Name -->
                  <span >15:02 - 10/05/2009</span> <!-- Date -->
              </div>
          </div>
      </header>

      <!-- Question Text -->
      <div class="question-content card-body">
          <p>Is the MIPS programming language that beneficial to know? I'm a CS student and am taking a assembly class which focuses on MIPS. I'm very comfortable writing in high level languages, but MIPS has me a little bit down. Is MIPS something that I should really focus on and try to completely grasp it? Will it help me in the future?</p>
      </div>

      <!-- Tags -->
      <footer>
          <span class="category tag badge bg-secondary"> 
              <i class="fas fa-hashtag"></i>
              MIPS
          </span>
          <span class="category tag badge bg-secondary">
              <i class="fas fa-hashtag"></i>
              COMP
          </span>
      </footer>

      </div>

  </article>

  <article class="question card">
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

                  <!-- Edit/Delete: only for Registred Users -->
                  <div class="edit-question ms-auto">
                      <button><i class="fas fa-edit"></i></button>
                      <button><i class="fas fa-trash-alt"></i></button>
                  </div>
              </div>

              <!-- Question Title -->
              <h2 class="card-title flex-grow-1">I can't solve this integral!  </h2> <!-- Question Title -->

              <!-- Desktop Question details -->
              <div class="question-details d-flex">
                  <!-- Course -->
                  <span class="category course badge rounded-pill bg-secondary">
                      <i class="fas fa-graduation-cap"></i>
                      MIEIC
                  </span>

                  <!-- Edit/Delete: only for Registred Users -->
                  <div class="edit-question">
                      <button><i class="fas fa-edit"></i></button>
                      <button><i class="fas fa-trash-alt"></i></button>
                  </div>
              </div>
          </div>
      
          <div class="question-author d-inline-flex align-items-center">
              <img class="rounded-circle" src="images/profile.png" alt=""> <!-- Small Profile Image -->
              <div class="d-flex flex-wrap">
                  <span>Marcio123</span> <!-- Name -->
                  <span >15:02 - 10/05/2009</span> <!-- Date -->
              </div>
          </div>
      </header>

      <!-- Question Text -->
      <div class="question-content card-body">
          <p>Okay, everyone knows the basic methods to solve the basic integrals, namely u-substitution, integration by parts, partial fractions, trigonometric substitution. I have tried each of this methods to solve this integral in my program, but the result just doesn't make any sense.</p>
      </div>

      <!-- Tags -->
      <footer>
          <span class="category tag badge bg-secondary"> 
              <i class="fas fa-hashtag"></i>
              Amat
          </span>
      </footer>

      </div>

  </article>


</div>

<!-- Sidebar -->
<aside class="accordion" id="search-tab">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            New Questions
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Not sure what to input here, tbd
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Courses
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="col-4">
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
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Tags
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="col-4">
              <div class="list-group" id="list-tab" role="tablist">
                  <a class="list-group-item list-group-item-action active"  data-bs-toggle="list" href="#list-home" role="tab" aria-controls="home">PPIN</a>
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