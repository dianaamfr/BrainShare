<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="page-question {{ Request::is('admin/categories/tags') ? 'active' : ''}} nav-item">
        <button class="nav-link" onclick="window.location='{{ URL::route('manage-tags') }}'">Tags</button>
    </li>
    <li class="page-answer {{ Request::is('admin/categories/courses') ? 'active' : ''}} nav-item">
        <button class="nav-link" onclick="window.location='{{ URL::route('manage-courses') }}'">Courses
        </button>
    </li>
</ul>
