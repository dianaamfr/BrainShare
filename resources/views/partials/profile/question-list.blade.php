@if (@count($questions) > 0)
    @each('partials.common.question-card', $questions, 'question')
@else
    <p>You haven't submitted any questions yet.</p>
@endif

<div class="profile-questions-paginate"> {{ $questions->links() }} </div>