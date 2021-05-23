<div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
    <p id="question-vote-id" hidden>{{ $question->id }}</p>

    @php
        $value = 0;
        foreach ($question->votes as $element) { 
            if ($element['user_id'] == Auth::user()->id) {
                $value = $element['value_vote'];
            }
        }
    @endphp

    @if ($value == 1)
        <button id="score" class="icon-hover vote_btn" title="Up Vote" type="submit">
            <i class="bi bi-caret-up-fill upvote-question"></i>
            <i class="bi bi-caret-up upvote-question"></i>
        </button>
        <p class="points m-0 question-score">{{$question->score}}</p>
        <button class="icon-hover vote_btn" title="Down Vote" type="submit">
            <i class="bi bi-caret-down downvote-question"></i>
            <i class="bi bi-caret-down-fill downvote-question"></i>
        </button>
    @elseif ($value == -1)
        <button id="score" class="icon-hover vote_btn" title="Up Vote" type="submit">
            <i class="bi bi-caret-up upvote-question"></i>
            <i class="bi bi-caret-up-fill upvote-question"></i>
        </button>
        <p class="points m-0 question-score">{{$question->score}}</p>
        <button class="icon-hover vote_btn" title="Down Vote" type="submit">
            <i class="bi bi-caret-down-fill downvote-question"></i>
            <i class="bi bi-caret-down downvote-question"></i>
        </button>
    @else
        <button id="score" class="icon-hover vote_btn" title="Up Vote" type="submit">
            <i class="bi bi-caret-up upvote-question"></i>
            <i class="bi bi-caret-up-fill upvote-question"></i>
        </button>
        <p class="points m-0 question-score">{{$question->score}}</p>
        <button class="icon-hover vote_btn" title="Down Vote" type="submit">
            <i class="bi bi-caret-down downvote-question"></i>
            <i class="bi bi-caret-down-fill downvote-question"></i>
        </button>
    @endif
</div>
<div class="question-content md-content col align-self-start ps-4">
    {{ $question->content }}
</div>
