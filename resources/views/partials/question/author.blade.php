<div class="question-author d-inline-flex align-items-center">
    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="Profile Image"> <!-- Small Profile Image -->
    <div class="d-flex flex-wrap">
        <span>{{$question->owner->username}}</span> <!-- Username -->
        <span> {{ date('d-m-Y H:i', strtotime($question->date)) }} </span> <!-- Date -->
    </div>
</div>
