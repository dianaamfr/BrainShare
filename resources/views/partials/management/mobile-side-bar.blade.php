<!-- Mobile -  Management Navigation Top Bar-->
<nav class="bd-subnavbar align-items-center p-2" aria-label="Secondary navigation">
    <ul class="d-flex m-0 p-0">
       <!-- TODO: manage categories class -->
      <li class="nav-link nav-item {{ Request::is('admin/courses') ? 'subnav-selected' : ''}}"><a href="{{route('manage-courses')}}">Courses</a></li>
      <li class="nav-link nav-item {{ Request::is('admin/tags') ? 'subnav-selected' : ''}}"><a href="{{route('manage-tags')}}">Tags</a></li>
      <li class="nav-link nav-item {{ Request::is('admin/reports') ? 'subnav-selected' : ''}}"><a href="{{route('manage-reports')}}">Reports</a></li>
      <li class="nav-link nav-item {{ Request::is('admin/user') ? 'subnav-selected' : ''}}"><a href="{{route('manage-users')}}">Users</a></li>
    </ul>
</nav>
