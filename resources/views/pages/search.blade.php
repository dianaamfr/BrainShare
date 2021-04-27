@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between page-margin" id="search-page">

  <!-- Questions Results -->
  <section class="container-sm">

    <div class="container-md mt-md-5">
      <header>
        <div id="search-header" class="d-flex">
          <h2>Search</h2>

          <!-- Search Results Order -->
          @include('partials.search.order')
        </div>

        <!-- Search Filters -->
       @include('partials.search.filters')

      </header>
    </div>

    <!-- Questions -->
    <div class="container-md mt-5 question-search-results">
        @include('partials.search-questions', $questions)
    </div>
  </section>

</div>
@endsection