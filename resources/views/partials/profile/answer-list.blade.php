<h3 class="mb-4">My Answers</h3>
@if (@count($answers) > 0)
    @each('partials.profile.answer-card', $answers, 'answer')
@else
    <p>No answers to show</p>
@endif

<div class="profile-answers-paginate">{{ $answers->links() }}</div>