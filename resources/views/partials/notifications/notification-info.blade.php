<li id="notification-{{ $notification->id }}" class="list-group-item list-group-item-action container notification-element">
    <div id="notifcation-info-{{ $notification->id }}" class="d-flex align-items-center">
        @if ($notification->answer_id !== null)
            <a href="/question/{{ $notification->type->question_id }}">
        @else
            <a href="/question/{{ $notification->type->answer->question_id }}">
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
            <i id="viewed-{{ $notification->id }}" class="fas fa-circle ms-auto"></i>
        @endif
    </div>
    <div class="d-flex align-items-center">
        <div class="flex-grow-1 fw-light">
            {{ $notification->date }}
        </div>

        <p class="notification-id" hidden>{{ $notification->id }}</p>

        <div class="dropdown ms-auto">
            <button class="btn dropdown-toggle rounded-circle notifications-more" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            ...
            </button>
            <ul class="dropdown-menu notification-list">
                <li class="dropdown-item mark-read-{{ $notification->id }}">Mark as read</li>
                <li class="dropdown-item delete-{{ $notification->id }}">Remove Notification</li>
            </ul>
        </div>
    </div>
</li>