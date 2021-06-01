<form class="me-auto" id="questions-search-bar">
    <div class="d-flex">
        <!-- Search by text -->
        <input class="form-control" type="search" name="search-input" 
            value="{{ app('request')->get('search-input') }}" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="search-submit" value="relevance">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="navbar py-0 justify-content-start mt-3 flex-nowrap align-items-start">
        <!-- Filter by Course -->
        @include('partials.search.courses', ['selected' => json_decode(app('request')->get('courses'))])

        <!-- Filter by Tag -->
        @include('partials.search.tags', ['selected' => json_decode(app('request')->get('tags'))])
    </div>
    <a class="d-block my-1 reset-search" href="{{route('search')}}">Reset search</a>
</form>