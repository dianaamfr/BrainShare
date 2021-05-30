<h3 class="mb-4">My Questions</h3>
@if (@count($questions) > 0)
    @each('partials.common.question-card', $questions, 'question')
@else
    <p>No questions to show.</p>
@endif

<div class="profile-questions-paginate"> {{ $questions->links() }} </div>