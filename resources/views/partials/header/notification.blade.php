<div class="modal"  id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <i class="fas fa-bell"></i>
          <h5 class="modal-title ms-3">  Notifications</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
              @if (@count($notifications) > 0) 
                <div class="goal-notification mb-2">
                    @include('partials.header.notification-list')
                </div>
                <button type="button" class="btn btn-primary show-more-notifications mb-3">Show More</button>
              @else
                No notifications
              @endif
            </ul>
        </div>
      </div>
    </div>
  </div>

  