@extends('layouts.app')

@section('content')

    @section('scripts')
        <script src={{ asset('js/manage-categories/course.js') }} type="module"></script>
    @endsection

    <!-- Mobile -  Management Navigation Top Bar-->
    @include('partials.management.mobile-side-bar')

    <div class="d-flex justify-content-between page-margin management-content">
        <!-- Management Navigation SideBar -->
        @include('partials.management.side-bar')

        <div class="col-md-9 ms-md-auto col-lg-10 px-md-4">

        <!-- Manage courses-->
            <section class="management manage-categories w-100 mt-5">
                <h2 class="mb-4">Course</h2>

                <div class="mt-5 d-flex justify-content-between flex-wrap mb-3" id="input-category">
                    <div class="input-group manage-search mb-3">
                        <input type="text" class="form-control" placeholder="Insert a course...">
                        <button class="btn btn-primary">Add Course</button>
                    </div>
                    <div class="input-group manage-search mb-3 ms-3">
                        <input type="text" class="form-control" placeholder="Search course..." value="{{ app('request')->get('search-name')}}">
                    </div>
                </div>


                <div id="category-notify">

                </div>
                <div class="table-responsive" id="category-table">
                    @include('partials.management.category.table', ['categories' => $courses])
                </div>
            </section>
        </div>
    </div>

    @include('partials.common.confirmation-modal')

@endsection
