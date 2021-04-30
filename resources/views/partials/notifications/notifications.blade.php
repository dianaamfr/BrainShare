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
              <li class="list-group-item list-group-item-action container">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <img src="{{asset('images/profile.png')}}" alt="profile picture" class="rounded-circle">
                    <span class="fw-bold">pedrov111</span>
                    <span>has answered your question.</span>
                  </a>
                  <i class="fas fa-circle ms-auto"></i>
                </div>
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 fw-light">
                     yesterday
                  </div>
                  <div class="dropdown ms-auto">
                      <button class="btn dropdown-toggle rounded-circle notifications-more" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ...
                      </button>
                      <ul class="dropdown-menu notification-list">
                        <li class= dropdown-item>Mark as read</li>
                        <li class= dropdown-item>Remove Notification</li>
                      </ul>
                  </div>
                </div>
                
              </li>
              
              <li class="list-group-item list-group-item-action container">
                <a href="#">
                <img src="{{asset('images/profile.png')}}" alt="profile picture" class="rounded-circle">
                    <span class="fw-bold">carlos123</span>
                    <span>has commented your answer.</span>
                </a>
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 fw-light">
                      3 days ago
                  </div>
                  <div class="dropdown ms-auto">
                      <button class="btn dropdown-toggle rounded-circle notifications-more" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ...
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Mark as read</a></li>
                        <li><a class="dropdown-item" href="#">Remove Notification</a></li>
                      </ul>
                  </div>
                </div>
                
              </li>
              <li class="list-group-item list-group-item-action container">
              <div class="d-flex align-items-center">
                  <a href="#">
                    <img src="{{asset('images/profile.png')}}" alt="profile picture" class="rounded-circle">
                    <span class="fw-bold">diaaaana2003</span>
                    <span>has answered your question.</span>
                  </a>
                  <i class="fas fa-circle ms-auto"></i>
                </div>
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 fw-light">
                     2 weeks ago
                  </div>
                  <div class="dropdown ms-auto">
                      <button class="btn dropdown-toggle rounded-circle notifications-more" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ...
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Mark as read</a></li>
                        <li><a class="dropdown-item" href="#">Remove Notification</a></li>
                      </ul>
                  </div>
                </div>
                
              </li>
          </ul>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>