@extends('layouts.app')

@section('content')
    @section('scripts')
        <script  src={{ asset('js/manage-reports.js') }} type="module"></script>
    @endsection

    <!-- Mobile -  Management Navigation Top Bar-->
    @include('partials.management.mobile-side-bar')

    <div class="d-flex justify-content-between page-margin management management-content" id="reports">
        <!-- Management Navigation SideBar -->
        @include('partials.management.side-bar')

        <div class="col-md-9 ms-md-auto col-lg-10 px-md-4">
            <h2 class="mb- mt-5">Reports</h2>

            <!-- Reports Search Filters -->
            <form class="mt-5 d-flex justify-content-between flex-wrap mb-3">
                <div class="btn-toolbar w-100 align-items-end">
                    <!--Type of report -->
                    <div>
                        <label class="form-label" for="report-type">Report Type</label>
                        <select class="me-4 mb-3 form-select" id="report-type" name="report-type">
                            <option selected value="all">All</option>
                            <option value="users">Users</option>
                            <option value="questions">Questions</option>
                            <option value="answers">Answers</option>
                            <option value="comments">Comments</option>
                        </select>
                    </div>

                    <div class="input-group manage-search mb-3">
                        <input type="text" class="form-control" placeholder="Search by content owner..." name="search-username-report">
                    </div>
                </div>
            </form>

            <div id="manage-reports-alert">    
            </div>
            
            <div id="reports-table">
                @include('partials.management.reports.reports-table')
            </div>

        </div>
    </div>
@endsection
