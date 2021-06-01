{{-- Form for editing a comment --}}
<form class="submit-edit-comments" id="submit-edit-comments-{{$comment->id}}" style="display:none;">
    <input type="hidden" name="commentID" value="{{$comment->id}}">
    <div class="mb-3 p-3">
        <textarea class="form-control" rows="2" name="content">{{$comment->content}} </textarea>
        <div class="d-grid gap-2 d-flex justify-content-end">
            <button class="btn btn-primary mt-3" type="submit"> Apply Changes</button>
            <button class="btn btn-outline-primary mt-3" type="button" name="{{$comment->id}}"> Cancel</button>
        </div>
    </div>
</form>

<div class="comment" id="comment-{{$comment->id}}">

    @if($comment->deleted === true)
        <div class="alert alert-danger small-deleted-alert container-lg" role="alert">
            This Comment has been deleted. Only Administrators and Moderators can see it.
        </div>
    @endif

    <div class="comment-text d-inline-block w-100" id="show-edit-comment-{{$comment->id}}">
        {{ $comment->content }}

    </div>

    <div class="d-flex">
        <div class="comment-author me-auto">
            @if ($comment->owner)
                <a href="{{route('show-profile', ['id' =>$comment->owner->id])}}">
                    <span>{{$comment->owner->username}}</span>
                </a> <!-- Username -->
            @else
                <span>Anonymous</span>
            @endif
            <span> {{ date('d-m-Y H:i', strtotime($comment->date)) }} </span> <!-- Date -->
        </div>
        @can('edit',$comment)
            <form title="Edit-comment" class="comment-edit-form">
                <input type="hidden" name="dummyText" value="dummyText">
                <input type="hidden" name="commentID" value="{{$comment->id}}">
                <button class="icon-hover edit-comment ps-0 pe-1" title="Edit" type="submit" data-bs-toggle="tooltip"
                        data-bs-placement="top">
                    <i class="far fa-edit"></i>
                    <i class="fas fa-edit"></i>
                </button>
            </form>
        @endcan

        @can('delete',$comment)
            <form title="Delete-comment" class="comment-delete-form">
                <input type="hidden" name="commentID" value="{{$comment->id}}">
                <button class="icon-hover edit-comment ps-0" type="submit" title="Delete" data-bs-toggle="tooltip"
                        data-bs-placement="top">
                    <i class="far fa-trash-alt"></i>
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        @endcan

        @if($comment->owner && $comment->owner->id != Auth::user()->id)
            <div>
                @include('partials.common.report',['margin' => 'ms-auto', 'id'=>$comment->id, 'type'=>'comment'])
            </div>
        @endif
    </div>
</div>
