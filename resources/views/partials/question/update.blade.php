@can('delete', $question)
<div class="edit-question {{$margin}}">
    <a class="icon-hover" title="Edit"  href="{{route('edit-question', $question->id)}}" data-bs-toggle="tooltip" data-bs-placement="top">
        <i class="far fa-edit"></i>
        <i class="fas fa-edit"></i>
    </a>
    <form method="post" action="{{ route('delete-question', $question->id) }}" class="delete-question-form" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
        @method('delete')
        @csrf
        <button class="icon-hover ps-3" type="submit">
            <i class="far fa-trash-alt"></i>
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</div>
@endcan

