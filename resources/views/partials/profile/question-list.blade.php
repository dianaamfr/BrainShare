@if (@count($questions) > 0)
    @foreach($questions as $question)
        @include('partials.common.question-card', ['question' => $question, 'isProfile'=>true])
    @endforeach
@else
    <p>No questions to show.</p>
@endif

<div class="profile-questions-paginate"> {{ $questions->links() }} </div>
