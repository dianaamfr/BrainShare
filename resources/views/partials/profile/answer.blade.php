@if (@count($answers) > 0)
    @each('partials.profile.answer-card', $answers, 'answer')
@else
    <p>You haven't submitted any answers yet</p>
@endif

<div class="profile-answers-paginate">{{ $answers->links() }}</div>