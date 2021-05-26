<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <i class="fas fa-bell"></i>
          <h5 class="modal-title ms-3">  Notifications</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
              @if (@count(Auth::user()->notifications) > 0)
                @each('partials.header.notification-card', Auth::user()->notifications, 'notification')
              @else
                No notifications
              @endif
            </ul>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>