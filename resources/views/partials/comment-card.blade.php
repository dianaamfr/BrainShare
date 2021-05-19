<div class="comment">
    <div class="comment-text d-inline-block">
        {{ $comment->content }}
    </div>
    <div class="d-flex">
        <div class="comment-author">
            <span> {{ $comment->owner->name }} </span> <!-- Username -->
            <span> {{ date('d-m-Y H:i', strtotime($comment->date)) }} </span> <!-- Date -->
        </div>
        @include('partials.question.report',['margin' => 'ms-auto', 'id'=>$comment->id, 'type'=>'comment'])
    </div>
</div>
