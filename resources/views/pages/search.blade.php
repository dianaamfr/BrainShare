@extends('layouts.app')

@section('content')

    <div class="page-margin" id="search-page">

        @section('scripts')
            <script  src={{ asset('js/toastReplies.js')}}  type="module"></script>
        @endsection

        @if(session("message") != null)
            <script>let toastMessageReply = "{{session("message")}}"</script>
            @include('partials.common.toast')
            {{session()->forget("message")}}
        @endif

    <!-- Questions Results -->
        <div class="mt-md-5">
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
        <div class="mt-5 question-search-results">
            @include('partials.search.search-questions', $questions)
        </div>

    </div>
@endsection
