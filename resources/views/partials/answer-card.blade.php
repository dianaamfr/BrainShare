<div class="card-body card answer-question-card">
    <header class="question-author pagination align-items-center justify-content-end card-header">
        <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="Profile Image"> <!-- Small Profile Image -->
        <div class="d-flex flex-wrap">
            <span> {{$answer->owner->username}}</span> <!-- Username -->
            <span> {{ date('d-m-Y H:i', strtotime($answer->date)) }} </span> <!-- Date -->
        </div>
    </header>

    <div class="row align-items-center px-3">
        <div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
            <p class="answer-score-{{ $answer->id }} points m-0">{{$answer->score}}</p>
            <input class="answer-id" value="{{ $answer->id }}" hidden />
            <button class="icon-hover vote_btn" title="Up Vote" type="submit">
                <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up"></i>
                <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up-fill"></i>
            </button>

            <button class="icon-hover vote_btn" title="Down Vote" type="submit">
                <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down"></i>
                <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down-fill"></i>
            </button>
        </div>

        <div class="col align-self-start ps-4">
            {{ $answer->content }}
        </div>

        
        <div class="d-flex flex-column justify-content-center col-auto valid-icon-{{$answer->id}}">
            @if ($answer->valid)
                <i class="fas fa-check text-center"></i>
            @endif
        </div>
        
    </div>

    <footer class="d-flex align-items-center">
        <span class="comments flex-grow-1"> {{ @count($answer->comments) }} Comments</span>

        <!-- if question owner -->
        @if (($answer->valid) && (Auth::id() === $answer->question->question_owner_id))
            <button class="btn btn-link mark-valid-{{ $answer->id }} mark-valid" title="Down Vote" type="submit">Unmark as valid</button>
        @elif (Auth::id() === $answer->question->question_owner_id)
            <button class="btn btn-link mark-valid-{{ $answer->id }}" title="Down Vote" type="submit">Mark as valid</button>
        @endif

        <div class="report-icon" title="Report">
            @include('partials.question.report', ['margin' => ''])
        </div>

        <a class="btn btn-link" data-bs-toggle="collapse" href="#collapseCommentForm{{$answer->id}}" role="button" aria-expanded="false" aria-controls="collapseCommentForm{{$answer->id}}">Add Comment</a>
    </footer>
</div>

<div class="comments">
    <div class="collapse" id="collapseCommentForm-{{$answer->id}}">
        <form class ="submit-comments">
            <input type="hidden" value="{{$answer->question_id}}">
            <div class="mb-3 p-3">
                <textarea class="form-control" rows="2" placeholder="Type your comment here"></textarea>
                <div class="d-grid gap-2 d-flex justify-content-end">
                    <button class="btn btn-primary mt-3" type="submit">Submit</button>
                    <button class="btn btn-outline-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentForm{{$answer->id}}" aria-expanded="false" aria-controls="collapseCommentForm{{$answer->id}}">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <div id="question-comments">
        @each('partials.comment-card', $answer->comments, 'comment')
    </div>
</div>

