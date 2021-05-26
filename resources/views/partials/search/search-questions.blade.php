@if($questions->isEmpty())
    <p class="">We couldn't find anything.</p>
@endif
@each('partials.common.question-card', $questions, 'question')
{{ $questions->links() }}