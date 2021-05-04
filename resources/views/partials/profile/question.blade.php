@if (@count($questions) > 0)
    @each('partials.question-card', $questions, 'question')
@else
    <p>Empty</p>
@endif

<div class="profile-questions-paginate">{{ $questions->links() }} </div>