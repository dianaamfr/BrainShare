<div class="mb-3">
    <label for="questionTitle" class="form-label">Question title*</label>
    <input type="text" class="form-control" name="title" id="questionTitle" value="{{$value}}" placeholder="Write the title here" aria-describedby="questionTitleHelp" required>
    @if ($errors->has('title'))
        <span class="error">
            {{ $errors->first('title') }}
        </span>
    @endif
    <div id="questionTitleHelp" class="form-text">Try to make the question as clear as possible.</div>
</div>

