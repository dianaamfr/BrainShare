<div class="question-author d-inline-flex align-items-center">
    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="Profile Image"> <!-- Small Profile Image -->
    <div class="d-flex flex-wrap">
        @if ($question->owner)
            <a href="{{route('show-profile', ['id' =>$question->owner->id])}}" class="text-reset">
                <span>{{$question->owner->username}}</span>
            </a> <!-- Username -->
        @else
            <span>Anonymous</span>
        @endif
        <span> {{ date('d-m-Y H:i', strtotime($question->date)) }} </span> <!-- Date -->
    </div>
</div>
