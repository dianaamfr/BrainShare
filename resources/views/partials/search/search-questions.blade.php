@empty ($questions)
    <p class="">We couldn't find anything.</p>
@endif
@each('partials.question-card', $questions, 'question')
{{ $questions->links() }}