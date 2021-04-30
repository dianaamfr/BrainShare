<div class="mb-3 position-relative" >
    <label for="questionTagsSelect" class="form-label">Tags</label>

    <div class="d-flex flex-wrap tag-container autocomplete overflow-hidden">
        <input class="form-control autoCompleteTags" id="questionTagsSelect" placeholder="Associate Tags here">
    </div>

    @if ($errors->has('tagList'))
        <span class="error">
            Tags must be different and can't be more than 5!
        </span>
    @endif
</div>
