<div class="question-author d-inline-flex align-items-center">
    @if(!isset($isProfile))
        <img
            src="{{ $element->owner ? ($element->owner->image ? asset('storage/' . $element->owner->image) : asset('images/profile.png')) : asset('images/profile.png')}}"
            alt="profile picture" class="rounded-circle">
    @endif
    <div class="d-flex flex-wrap">
        @if(!isset($isProfile))
            @if ($element->owner)
                <a href="{{route('show-profile', ['id' =>$element->owner->id])}}">
                    <span>{{$element->owner->username}}</span>
                </a> <!-- Username -->
            @else
                <span>Anonymous</span>
            @endif
        @endif
        <span> {{ date('d-m-Y H:i', strtotime($element->date)) }} </span> <!-- Date -->
    </div>
</div>
