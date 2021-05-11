<div class="card-body card">
    <header class="question-author pagination align-items-center justify-content-end card-header">
        <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="Profile Image"> <!-- Small Profile Image -->
        <div class="d-flex flex-wrap">
            <span> {{$answer->owner->username}}</span> <!-- Username -->
            <span> {{ date('d-m-Y H:i', strtotime($answer->date)) }} </span> <!-- Date -->
        </div>
    </header>

    <div class="row align-items-center px-3">
        <div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
            <p class="points m-0">{{$answer->score}}</p>
            <form method="POST" action="{{ route('vote-answer', [$answer->question_id, $answer->id]) }}" title="UpVote">
                @csrf
                <input type="number" class="form-control" name="vote" value="1" hidden>
                <button class="icon-hover vote_btn" title="Up Vote" type="submit">
                    <i class="bi bi-caret-up"></i>
                    <i class="bi bi-caret-up-fill"></i>
                </button>
            </form>

            <form method="POST" action="{{ route('vote-answer', [$answer->question_id, $answer->id]) }}" title="DownVote">
                @csrf
                <input type="number" class="form-control" name="vote" value="-1" hidden>
                <button class="icon-hover vote_btn" title="Down Vote" type="submit">
                    <i class="bi bi-caret-down"></i>
                    <i class="bi bi-caret-down-fill"></i>
                </button>
            </form>
        </div>

        <div class="col align-self-start ps-4">
            {{ $answer->content }}
        </div>

        <div class="d-flex flex-column justify-content-center col-auto">
            <i class="fas fa-check text-center"></i>
        </div>
    </div>

    <footer class="d-flex align-items-center">
        <span class="comments flex-grow-1"> {{ @count($answer->comments) }} Comments</span>

        <div class="report-icon" title="Report">
            @include('partials.question.report', ['margin' => ''])
        </div>

        <a class="btn btn-link" data-bs-toggle="collapse" href="#collapseCommentForm" role="button" aria-expanded="false" aria-controls="collapseCommentForm">Add Comment</a>
    </footer>
</div>

<div class="comments">
    <div class="collapse" id="collapseCommentForm">
        <form id="submit-comment">
            <div class="mb-3 p-3">
                <textarea class="form-control" rows="2" placeholder="Type your comment here"></textarea>
                <div class="d-grid gap-2 d-flex justify-content-end">
                    <button class="btn btn-primary mt-3" type="submit">Submit</button>
                    <button class="btn btn-outline-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentForm" aria-expanded="false" aria-controls="collapseCommentForm">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    @each('partials.comment-card', $answer->comments, 'comment')
</div>

