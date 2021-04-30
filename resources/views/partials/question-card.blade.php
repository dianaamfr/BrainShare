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
                    @include('partials.question.courses')
                </div>

                <!-- Question Title -->
                <h4 class="card-title flex-grow-1"><a href="/question/{{ $question->id }}">{{$question->title}}</a></h4>

                <!-- Desktop Question details -->
                <div class="question-details d-flex">
                    <!-- Courses -->
                    @include('partials.question.courses')
                </div>
            </div>
        </header>

        <div class="limited-text-3 card-body md-remove">
            {{ Str::limit($question->content, 400) }}
        </div>

        <!-- Tags and User -->
        <footer class="card-footer d-flex align-items-center flex-wrap">
            <div class="flex-grow-1 mb-1">
                @include('partials.question.tags')
            </div>

            @include('partials.question.author')

        </footer>
    </div>
    <div class="counts-mobile">
        <div>{{$question->number_answer}} answers</div>
        <div>{{$question->score}} votes</div>
    </div>
</article>
