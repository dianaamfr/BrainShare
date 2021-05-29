<li id="notification-{{ $notification->id }}" class="list-group-item list-group-item-action container notification-element">
    <div id="notifcation-info-{{ $notification->id }}" class="d-flex align-items-center">
        @if ($notification->answer_id !== null)
            <a href="/question/{{ $notification->type->question_id }}#answer-{{ $notification->answer_id }}">
        @else
            <a href="/question/{{ $notification->type->answer->question_id }}#comment-{{ $notification->comment_id }}">
        @endif
        <img src="{{ $notification->type->owner->image ? asset('storage/' . $notification->type->owner->image) : asset('images/profile.png')}}" alt="profile picture" class="rounded-circle">
        <span class="fw-bold">{{ $notification->type->owner->username }}</span>
        @if ($notification->answer_id !== null)
            <span>has answered your question.</span>
        @else
            <span>has commented your question.</span>
        @endif
        </a>

        @if (!$notification->viewed)
            <i id="viewed-{{ $notification->id }}" class="text-blue fas fa-circle ms-auto"></i>
        @endif
    </div>
    <div class="d-flex align-items-center">
        <div class="flex-grow-1 fw-light">
            {{ date('d-m-Y H:i', strtotime($notification->date)) }}
        </div>

        <p class="notification-id" hidden>{{ $notification->id }}</p>

        <button class="icon-hover mark-read-{{ $notification->id }} btn-link">
            <i class="far fa-check-circle"></i>
            <i class="fas fa-check-circle"></i>
        </button>

        <button class="icon-hover delete-{{ $notification->id }} btn-link">
            <i class="far fa-trash-alt"></i>
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>
</li>