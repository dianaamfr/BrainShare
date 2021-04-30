<div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
    <p class="points m-0">{{$question->score}}</p>
    <button class="icon-hover vote_btn" title="Up Vote">
        <i class="bi bi-caret-up"></i>
        <i class="bi bi-caret-up-fill"></i>
    </button>
    <button class="icon-hover vote_btn" title="Down Vote">
       <i class="bi bi-caret-down"></i>
       <i class="bi bi-caret-down-fill"></i>
    </button>
</div>
<div class="question-content md-content col align-self-start ps-4">
    {{$question->content}}
</div>
