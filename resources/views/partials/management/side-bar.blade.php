<!-- Management Navigation SideBar -->
<aside class="mt-5 col-md-3 col-lg-3 mt-5 d-md-block management-nav">
    <ul>
        <!-- TODO: manage categories class -->
        <li><a href="{{route('manage-tags')}}">Manage Categories</a></li>
        <li><a href="{{route('manage-reports')}}" class="{{ Request::is('admin/reports') ? 'blue' : ''}}">Manage Reports</a></li>
        <li><a href="{{route('manage-users')}}" class="{{ Request::is('admin/user') ? 'blue' : ''}}">Manage Users</a></li>
    </ul>
</aside>
