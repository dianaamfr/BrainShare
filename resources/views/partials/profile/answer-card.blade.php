<!-- Todo: should the structure be like this? -->
<article class="question-preview card flex-row align-items-center">
        <div class="counts">
            <div>{{ @count($answer->comments) }}</div>
            <div>comments</div>
        </div>
        <div class="counts">
            <div>{{$answer->score}}</div>
            <div>votes</div>
        </div>
        <div class="card-body">
            <header class="card-header">
                <div class="question-header d-flex align-items-center">

                    <!-- Question Title -->
                    <h4 class="card-title flex-grow-1"><a href="/question/{{ $answer->question->id }}">{{$answer->question->title}}</a></h4>

                    <div class="d-flex flex-column justify-content-center col-auto mx-2">
                        <i class="fas fa-check text-center"></i>
                    </div>
                    @include('partials.question.courses', ['question' => $answer->question])
                </div>
            </header>

            <!-- Question Text -->
            <div class="answer-content col-lg">
                <h4>Answer</h4>
                <div class="limited-text-3 md-content md-remove">
                    {{ Str::limit($answer->content, 400) }}
                </div>
            </div>

            <!-- User -->
            <footer class=" d-flex align-items-center flex-wrap">
                <div class="flex-grow-1 mb-1">
                    @foreach ($answer->question->tags as $tag)
                        <span class="category tag badge bg-secondary">
                            <i class="fas fa-hashtag"></i>
                            {{$tag->name}}
                        </span>
                    @endforeach
                </div>
                <div class="question-author d-inline-flex align-items-center">
                    <div class="d-flex flex-wrap">
                        <span> {{ date('d-m-Y H:i', strtotime($answer->date)) }} </span> <!-- Date -->
                    </div>
                </div>
            </footer>

            <div class="counts-mobile">
                <div>{{ @count($answer->comments) }} comments</div>
            </div>
        </div>
    </article>
