<!-- Management Navigation SideBar -->
<aside class="mt-5 col-md-3 col-lg-2 mt-5 d-md-block management-nav">
    <ul>
        <!-- TODO: manage categories class -->
        <li><a href="{{route('manage-courses')}}" class="{{Request::is('admin/courses') ? 'blue' : ''}}">Manage Courses</a></li>
        <li><a href="{{route('manage-tags')}}" class="{{Request::is('admin/tags') ? 'blue' : ''}}">Manage Tags</a></li>
        <li><a href="{{route('manage-reports')}}" class="{{ Request::is('admin/reports') ? 'blue' : ''}}">Manage Reports</a></li>
        <li><a href="{{route('manage-users')}}" class="{{ Request::is('admin/user') ? 'blue' : ''}}">Manage Users</a></li>
    </ul>
</aside>
