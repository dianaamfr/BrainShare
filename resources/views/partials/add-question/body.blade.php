<div class="mb-3">
    <label for="question-text-area" class="form-label">Question Body*</label>
    <div class="border form-control">
        <textarea id="question-text-area" name="content" class="form-control" placeholder="Describe your problem here" style="height: 100px" aria-describedby="questionBodyHelp" required> {{$value}} </textarea>
    </div>
    @if ($errors->has('content'))
        <span class="error">
            {{ $errors->first('content') }}
        </span>
    @endif
    <div id="questionBodyHelp" class="form-text">Describe all the details that may help others understand your question.</div>
</div>
