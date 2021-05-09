<div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
    <p class="points m-0">{{$question->score}}</p>

    <form method="POST" action="{{ route('upvote-question', $question->id) }}" title="UpVote">
        @csrf
        <button class="icon-hover vote_btn" title="Up Vote" type="submit">
            <i class="bi bi-caret-up"></i>
            <i class="bi bi-caret-up-fill"></i>
        </button>
    </form>

    <form method="POST" action="{{ route('downvote-question', $question->id) }}" title="DownVote">
        @csrf
        <button class="icon-hover vote_btn" title="Down Vote" type="submit">
            <i class="bi bi-caret-down"></i>
            <i class="bi bi-caret-down-fill"></i>
        </button>
    </form>

</div>
<div class="question-content md-content col align-self-start ps-4">
    {{$question->content}}
</div>
