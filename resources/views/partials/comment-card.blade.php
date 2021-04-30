<div class="comment">
    <div class="comment-text d-inline-block">
        {{ htmlentities($comment->content) }}
    </div>
    <div class="d-flex">
        <div class="comment-author">
            <span> {{ $comment->owner->name }} </span> <!-- Username -->
            <span> {{ date('d-m-Y H:i', strtotime($comment->date)) }} </span> <!-- Date -->
        </div>
        <div class="ms-auto report-icon" title="Report">
            <button class="icon-hover">
                <i class="far fa-flag"></i>
                <i class="fas fa-flag"></i>
            </button>
        </div>
    </div>
</div>