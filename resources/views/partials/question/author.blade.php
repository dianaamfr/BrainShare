<div class="question-author d-inline-flex align-items-center">
    <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="Profile Image"> <!-- Small Profile Image -->
    <div class="d-flex flex-wrap">
        @if ($element->owner)
            <a href="{{route('show-profile', ['id' =>$element->owner->id])}}" >
                <span>{{$element->owner->username}}</span>
            </a> <!-- Username -->
        @else
            <span>Anonymous</span>
        @endif
        <span> {{ date('d-m-Y H:i', strtotime($element->date)) }} </span> <!-- Date -->
    </div>
</div>
