<footer class="pt-5 pb-3">
    <nav class="row container m-auto">
        <div class="col-6 col-md">
            <h5>Who we are</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary" href="{{ route('home') }}">Home</a></li>
                <li><a class="link-secondary" href="{{route('about')}}">About us</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Authentication</h5>
            <ul class="list-unstyled text-small">
                @if(!Auth::check())
                    <li><a class="link-secondary" href="{{ route('login') }}">Login</a></li>
                    <li><a class="link-secondary" href="{{ route('register') }}">Register</a></li>
                @else 
                    <li><a class="link-secondary" href="/user/{{ Auth::id() }}/profile">Profile</a></li>
                @endif
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary" href="{{ route('search') }}">Search Questions</a></li>
                <li><a class="link-secondary" href="{{ route('question') }}">Add Question</a></li>
            </ul>
        </div>

        @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isModerator())) 
        <div class="col-6 col-md">
            <h5>Management</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary" href="{{route('manage-tags')}}">Manage Tags</a></li>
                <li><a class="link-secondary" href="{{route('manage-courses')}}">Manage Courses</a></li>
                <li><a class="link-secondary" href="{{route('manage-reports')}}">Manage Reports</a></li>
                <li><a class="link-secondary" href="{{route('manage-users')}}">Manage Users</a></li>
            </ul>
        </div>
        @endif
    </nav>
</footer>
