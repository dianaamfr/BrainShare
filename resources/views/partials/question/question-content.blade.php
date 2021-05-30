<div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
    <p id="question-vote-id" hidden>{{ $question->id }}</p>

    
    @if (Auth::check() && (Auth::user()->id != $question->question_owner_id))
        @php
            $value = 0;
            foreach ($question->votes as $element) { 
                if ($element['user_id'] == Auth::user()->id) {
                    $value = $element['value_vote'];
                }
            }
        @endphp

        <button id="score" class="icon-hover vote_btn" title="Up Vote" type="submit" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="bi bi-caret-up{{$value == 1 ? '-fill' : ''}} upvote-question-{{ $question->id }}"></i>
            <i class="bi bi-caret-up-fill upvote-question-{{ $question->id }} text-dark"></i>
        </button>
        <p class="points m-0 question-score">{{$question->score}}</p>
        <button class="icon-hover vote_btn" title="Down Vote" type="submit" data-bs-toggle="tooltip" data-bs-placement="top">
            <i class="bi bi-caret-down{{$value == -1 ? '-fill' : ''}} downvote-question-{{ $question->id }}"></i>
            <i class="bi bi-caret-down-fill downvote-question-{{ $question->id }} text-dark"></i>
        </button>
    @else
        <div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
            <input class="question-id" hidden/>
            <button class="icon-hover vote_btn" title="Up Vote" type="submit" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="bi bi-caret-up text-secondary" ></i>
                <i class="bi bi-caret-up-fill text-secondary"></i>
            </button>
            <p class="answer-score-{{ $question->id }} points m-0">{{$question->score}}</p>
            <button class="icon-hover vote_btn" title="Down Vote" type="submit" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="bi bi-caret-down text-secondary"></i>
                <i class="bi bi-caret-down-fill text-secondary"></i>
            </button>
        </div>
    @endif
</div>
<div class="question-content md-content col align-self-start ps-4">
    {{ $question->content }}
</div>
