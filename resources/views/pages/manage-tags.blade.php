@extends('layouts.app')

@section('content')

     <!-- Mobile -  Management Navigation Top Bar-->
     @include('partials.management.mobile-side-bar')

    <div class="d-flex justify-content-between page-margin categories-content">
        <!-- Management Navigation SideBar -->
        @include('partials.management.side-bar')

        <div class="col-md-9 ms-md-auto col-lg-9 px-md-4 side-content">
        @include('partials.management.category.tabs')

        <!-- Manage tags-->
            <section id="pagination-item-1" class="management manage-categories w-100 mt-5">
                <h2 class="mb-4">Tags</h2>

                <div class="mt-5 d-flex justify-content-between flex-wrap mb-3" id="input-category">
                    <div class="input-group manage-search mb-3">
                        <input type="text" class="form-control" placeholder="Insert a tag...">
                        <button class="btn btn-primary">Add Tag</button>
                    </div>
                    <div class="input-group manage-search mb-3 ms-3">
                        <input type="text" class="form-control" placeholder="Search tag...">
                        <button class="btn btn-primary">Search Tag</button>
                    </div>
                </div>

                <div id="category-notify">

                </div>
                <div class="table-responsive" id="category-table">
                    @include('partials.management.category.table', ['categories' => $tags])
                </div>
            </section>

        </div>

    </div>

@endsection
