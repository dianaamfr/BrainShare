{{-- Form for eidting a comment --}}
<form class="submit-edit-comments" id="submit-edit-comments-{{$comment->id}}" style="display:none;">
    <input type="hidden" name="commentID" value="{{$comment->id}}">
    <div class="mb-3 p-3">
        <textarea class="form-control" rows="2" name="content">{{$comment->content}} </textarea>
        <div class="d-grid gap-2 d-flex justify-content-end">
            <button class="btn btn-primary mt-3" type="submit"> Apply Changes </button>
            <button class="btn btn-outline-primary mt-3" type="button" name="{{$comment->id}}"> Cancel </button>
        </div>
    </div>
</form>

<div class="comment" id="comment-{{$comment->id}}">

    <div class="comment-text d-inline-block" id="show-edit-comment-{{$comment->id}}">
        {{ $comment->content }}
    </div>
    
    <div class="d-flex">
        <div class="comment-author">
            <span> {{ $comment->owner->username }} </span> <!-- Username -->
            <span> {{ date('d-m-Y H:i', strtotime($comment->date)) }} </span> <!-- Date -->
        </div>
        <div>
            @can('edit',$comment)
            <form title="Edit-comment" class="comment-edit-form">
                <input type="hidden" name="dummyText" value="dummyText">
                <input type="hidden" name="commentID" value="{{$comment->id}}">
                <button class="icon-hover" title="Edit-comment" class="edit-comment-button" type="submit">
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
        @include('partials.report',['margin' => 'ms-auto', 'id'=>$comment->id, 'type'=>'comment'])
    </div>
</div>
