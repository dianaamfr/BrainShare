@extends('layouts.app')

@section('content')

    @section('scripts')
        <script  src={{ asset('js/manage-users.js') }} type="module"></script>
    @endsection

    <!-- Mobile -  Management Navigation Top Bar-->
    @include('partials.management.mobile-side-bar')
  
    <div class="d-flex justify-content-between page-margin management management-content" id="users"> 
        <!-- Management Navigation SideBar -->
        @include('partials.management.side-bar')
  
        <div class="col-md-9 ms-md-auto col-lg-10 px-md-4" id="users-manage-area">
            <h2 class="mb- mt-5 mb-4">Users</h2>

            <!-- Search by username -->
            <div class="input-group manage-search mb-3">
                <input type="text" class="form-control" id="search-username" placeholder="Search by username" value="{{app('request')->get('search-username')}}">
            </div>

            <div id="manage-users-alert">
            </div>

            <div id="users-table">
                @include('partials.management.users.users-table')
            </div>
        </div>
    </div>

@endsection
