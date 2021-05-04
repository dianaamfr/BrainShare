@if (@count($questions) > 0)
    @each('partials.question-card', $questions, 'question')
@else
    <p>Empty</p>
@endif

{{ $questions->links() }}