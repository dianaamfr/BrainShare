<div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
    <p id="question-vote-id" hidden>{{ $question->id }}</p>

    <button id="score" class="icon-hover vote_btn" title="Up Vote" type="submit">
        <i class="bi bi-caret-up upvote-question"></i>
        <i class="bi bi-caret-up-fill upvote-question"></i>
    </button>
    <p class="points m-0 question-score">{{$question->score}}</p>
    <button class="icon-hover vote_btn" title="Down Vote" type="submit">
        <i class="bi bi-caret-down downvote-question"></i>
        <i class="bi bi-caret-down-fill downvote-question"></i>
    </button>

</div>
<div class="question-content md-content col align-self-start ps-4">
    {{ $question->content }}
</div>
