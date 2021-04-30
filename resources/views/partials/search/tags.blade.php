<div class="courses-tags-search">
    <h6>Tags</h6>
    <div id="tags-selected">
        <input class="form-control" name="tag-input" type="search" placeholder="Search tags">
        @if ($selected != null)
        @foreach ($selected as $tagId)
            <span class="badge bg-primary selected-tag ms-2" data-tag-id="{{$tagId}}">
                <i class="fas fa-times"></i>
            </span>
        @endforeach
    @endif
    </div>
    <div id="tags-search-results">
    </div>
</div>