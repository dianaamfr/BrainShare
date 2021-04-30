<article class="question-preview card flex-row align-items-center">
    <div class="counts">
        <div>{{$question->number_answer}}</div>
        <div>answers</div>
    </div>
    <div class="counts">
        <div>{{$question->score}}</div>
        <div>votes</div>
    </div>
    <div class="card-body">
        <header class="card-header">
            <div class="question-header d-flex align-items-center">

                <!-- Mobile Question details -->
                <div class="d-none question-details d-flex mb-3">
                     <!-- Courses -->
                    @foreach ($question->courses as $course)
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            {{$course->name}}
                        </span>
                    @endforeach
                </div>

                <!-- Question Title -->
                <h4 class="card-title flex-grow-1"><a href="/question/{{ $question->id }}">{{ $question->title }}</a></h4>

                <!-- Desktop Question details -->
                <div class="question-details d-flex">
                    <!-- Courses -->
                    @foreach ($question->courses as $course)
                        <span class="category course badge rounded-pill bg-secondary">
                            <i class="fas fa-graduation-cap"></i>
                            {{$course->name}}
                        </span>
                    @endforeach
                </div>
            </div>
        </header>
        <div class="limited-text-3 card-body md-content md-remove"> 
            {{ Str::limit($question->content, 400) }}
        </div>

        <!-- Tags and User -->
        <footer class="card-footer d-flex align-items-center flex-wrap">
            <div class="flex-grow-1 mb-1">
                @foreach ($question->tags as $tag)
                <span class="category tag badge bg-secondary">
                    <i class="fas fa-hashtag"></i>
                    {{$tag->name}}
                </span>
                @endforeach
            </div>
            <div class="question-author d-inline-flex align-items-center">
                <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile image"> <!-- Small Profile Image -->
                <div class="d-flex flex-wrap">
                    <span>{{$question->owner->username}}</span> <!-- Username -->
                    <span> {{ date('d-m-Y H:i', strtotime($question->date)) }} </span> <!-- Date -->
                </div>
            </div>
        </footer>
    </div>
    <div class="counts-mobile">
        <div>{{$question->number_answer}} answers</div>
        <div>{{$question->score}} votes</div>
    </div>
</article>
