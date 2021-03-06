<header class="fixed-top m-auto">
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
      <div class="container-fluid">

        <!-- Logo - link to Home Page -->
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'BrainShare') }}</a>

        <!-- Tablet Search Bar -->
        <form class="header-search d-flex me-auto tablet-header-search" action="{{ route('search') }}" >
          @include('partials.header.search-bar')
        </form>

        <!-- Mobile Menu Icon -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Search Bar -->
        <form class="header-search d-flex me-auto main-search" action="{{ route('search') }}" >
          @include('partials.header.search-bar')
        </form>

        <!-- Main Pages -->
        <ul class="navbar-nav mb-2 mb-xl-0">

            <!-- Registered Users options -->
            @if (Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('add-question') }}">Add Question</a>
              </li>
            @endif

            <!-- Administrator/Moderator -->
            @if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerator()))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('manage-tags') }}">Management</a>
              </li>
            @endif

        </ul>

          <!-- Registration/Account -->
          <div class="ms-4 registration-menu btn-toolbar mb-2 mb-xl-0 align-items-center flex-nowrap">

            <!-- Registered Users options -->
            @if (Auth::check()) 
              <a class="nav-link profile-button registration-button" href="/user/{{ Auth::id() }}/profile">
                  <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/profile.png')}}" alt="profile picture" class="rounded-circle">
                  {{ Auth::user()->username }}
              </a>
              <button class="registration-button icon-hover notification-open" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                <i class="far fa-bell"></i>
                <i class="fas fa-bell"></i>
              </button>
              
              <form method="post" action="{{ route('logout')}}">
                {{ csrf_field() }}
                <button class="registration-button btn btn-outline-primary">Logout</button>
              </form>
            @else
              <a class="registration-button btn btn-primary" href="{{ route('login') }}">Login</a>
              <a class="registration-button btn btn-primary" href="{{ route('register') }}">Register</a>
            @endif
          </div>

        </div>
      </div>
    </nav>
</header>

<!-- Registered Users options -->
@if (Auth::check()) 
  @include('partials.header.notification')
@endif

<!-- Toast when try to access user banned pages -->
@if(session("message-ban-page") != null)
    <script>let toastMessageError = "{{session("message-ban-page")}}"</script>
    @include('partials.common.toast')
    {{session()->forget("message-ban-page")}}
@endif