@if (@count($answers) > 0)
    @each('partials.profile.answer-card', $answers, 'answer')
@else
    <p>Empty</p>
@endif

<div class="profile-answers-paginate">{{ $answers->links() }}</div>