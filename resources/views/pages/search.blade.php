@extends('layouts.app')

@section('content')
<!-- Sub nav bar - Mobile -->
<nav class="bd-subnavbar align-items-center p-2" aria-label="Secondary navigation">
  <ul class="d-flex m-0 p-0">
    <li class="nav-link nav-item subnav-selected"><button>Newest</button></li>
    <li class="nav-link nav-item"><button>Most Voted</button></li>

    <li class="nav-link nav-item">
      <select>
        <option selected disabled>Courses</option>
        @foreach ($courses as $course)
          <option value="{{$course->id}}">{{$course->name}}</option>
        @endforeach
      </select>
    </li>
    <li class="nav-link nav-item"><button>Tags</button></li>
  </ul>
</nav>

<div class="d-flex justify-content-between page-margin" id="search-page">

  <!-- Sidebar -->
  <aside id="side-bar" class="mt-5 col-md-3 col-lg-3 d-md-block bg-light sidebar accordion">
    <div class="accordion-item">
      <h6 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" data-bs-parent="#side-bar">
          Courses
        </button>
      </h6>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#side-bar">
        <div class="accordion-body">
          <div>
            <div class="list-group">
              @foreach ($courses as $course)
                  <input class="course-filter-input" type="checkbox" hidden id="course-filter-{{$course->id}}" value="{{$course->id}}">
                  <label for="course-filter-{{$course->id}}" class="course-filter list-group-item">{{$course->name}}</label>
              @endforeach
              </div>
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
      <div id="collapseThree" class="accordion-collapse collapse accordion-search" aria-labelledby="headingThree" data-bs-parent="#side-bar">
        <!-- Search Bar -->
        <form class="d-flex me-auto">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
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
        </div>
      </div>
    </div>
  </aside>

  <!-- Questions Results -->
  <section class="col-md-9 ms-md-auto col-lg-9 px-md-4 side-content">

    <div class="container-md mt-md-5">
      <header>
        <div id="search-header" class="d-flex">
        <h2>Search</h2>

        <!-- Filter -->
        <ul class="nav ms-auto" id="search-filters">
          <li {{ old('nav-search-input') ? '' : 'hidden' }}>
            <input id="order-filter-1" type="radio" name="filter" class="nav-link" value="relevance" hidden {{ old('nav-search-input') ? 'checked' : '' }}>
            <label for="order-filter-1">Relevance</label>
          </li>
          <li>
            <input id="order-filter-2" type="radio" name="filter" class="nav-link" value="new" hidden hidden {{ old('nav-search-input') ? '' : 'checked' }}>
            <label for="order-filter-2">Newest</label>
          </li>
          <li>
            <input id="order-filter-3" type="radio" name="filter" class="nav-link" value="votes" hidden>
            <label for="order-filter-3">Most Voted</label>
          </li>
        </ul>
        </div>

        <!-- Search Bar -->
        <form class="d-flex me-auto" id="questions-search-bar">
          <input class="form-control" type="search" name="search-input" value="{{ old('nav-search-input') }}" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="search-submit" value="relevance">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
        <a href="{{route('search')}}" id="reset-search" {{ old('nav-search-input') ? '' : 'hidden' }}>Reset search</a>
      </header>
    </div>

    <!-- Questions -->
    <div class="container-md mt-5 question-search-results">
        @each('partials.question-card', $questions, 'question')
        {{ $questions->links() }}
    </div>
  </section>

</div>
@endsection