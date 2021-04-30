@foreach ($question->courses as $course)
<span class="category course badge rounded-pill bg-secondary m-2">
    <i class="fas fa-graduation-cap"></i>
    {{$course->name}}
</span>
@endforeach
