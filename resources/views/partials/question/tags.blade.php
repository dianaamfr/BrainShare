<div class="question-tags">
    @foreach ($question->tags as $tag)
    <span class="category tag badge bg-secondary">
        <i class="fas fa-hashtag"></i>
        {{$tag->name}}
    </span>
    @endforeach
</div>


