<div class="comment">
    <div class="comment-text d-inline-block">
        {{ $comment->content }}
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

        <div>
            @can('edit',$comment)
            <form title="Edit-comment" class="comment-edit-form">
                <button class="icon-hover" title="Edit-comment" class="edit-comment-button" type="submit">
                    <input type="hidden" name="dummyText" value="dummyText">
                    <input type="hidden" name="commentID" value="{{$comment->id}}">
                    <i class="far fa-edit"></i>
                    <i class="fas fa-edit"></i>
                </button>
            </form>
            @endcan

            @can('delete',$comment)
            <form title="Delete-comment" class="comment-delete-form">
                <input type="hidden" name="commentID" value="{{$comment->id}}">
                <button class="icon-hover" type="submit">
                    <i class="far fa-trash-alt"></i>
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            @endcan
            
        </div>
    </div>
</div>