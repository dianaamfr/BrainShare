@can('delete', $question)
<div class="edit-question {{$margin}}">
    <a class="icon-hover" title="Edit"  href="{{route('edit-question', $question->id)}}">
        <i class="far fa-edit"></i>
        <i class="fas fa-edit"></i>
    </a>
    <form method="post" action="{{ route('delete-question', $question->id) }}" title="Delete">
        @method('DELETE')
        @csrf
        <button class="icon-hover" type="submit">
            <i class="far fa-trash-alt"></i>
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</div>
@endcan

