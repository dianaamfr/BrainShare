<div class="card-body card answer-question-card">
    <div id="display-answercard-{{$answer->id}}">
        <header class="question-author pagination align-items-center justify-content-end card-header">
            <div>
                @can('edit',$answer)
                <form title="Edit-answer" class="answer-edit-form">
                    <button class="icon-hover" title="Edit-answer" class="edit-answer-button" type="submit">
                        <input type="hidden" name="answerID" value="{{$answer->id}}">
                        <i class="far fa-edit"></i>
                        <i class="fas fa-edit"></i>
                    </button>
                </form>
                @endcan
                @can('delete',$answer)
                <form title="Delete-answer" class="answer-delete-form">
                    <input type="hidden" name="answerID" value="{{$answer->id}}">
                    <button class="icon-hover" type="submit">
                        <i class="far fa-trash-alt"></i>
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                @endcan
            </div>

            <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="Profile Image">
            <!-- Small Profile Image -->
            <div class="d-flex flex-wrap">
                <span> {{$answer->owner->username}}</span> <!-- Username -->
                <span> {{ date('d-m-Y H:i', strtotime($answer->date)) }} </span> <!-- Date -->
            </div>
        </header>



        <div class="row align-items-center px-3">
            @php
                $value = 0;
                if(Auth::check()) {
                    foreach ($answer->votes as $element) {
                        if ($element['user_id'] == Auth::user()->id) {
                            $value = $element['value_vote'];
                        }
                    }
                }
            @endphp

            <div class="py-2 col-auto d-flex flex-column justify-content-center align-items-center">
                @if ($value == 1)
                    <input class="answer-id" value="{{ $answer->id }}" hidden/>
                    <button class="icon-hover vote_btn" title="Up Vote" type="submit">
                        <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up-fill"></i>
                        <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up-fill text-dark"></i>
                    </button>
                    <p class="answer-score-{{ $answer->id }} points m-0">{{$answer->score}}</p>
                    <button class="icon-hover vote_btn" title="Down Vote" type="submit">
                        <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down"></i>
                        <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down-fill text-dark"></i>
                    </button>
                @elseif ($value == -1)
                    <input class="answer-id" value="{{ $answer->id }}" hidden/>
                    <button class="icon-hover vote_btn" title="Up Vote" type="submit">
                        <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up"></i>
                        <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up-fill text-dark"></i>
                    </button>
                    <p class="answer-score-{{ $answer->id }} points m-0">{{$answer->score}}</p>
                    <button class="icon-hover vote_btn" title="Down Vote" type="submit">
                        <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down-fill"></i>
                        <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down-fill text-dark"></i>
                    </button>
                @else
                    <input class="answer-id" value="{{ $answer->id }}" hidden/>
                    <button class="icon-hover vote_btn" title="Up Vote" type="submit">
                        <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up"></i>
                        <i class="upvote-answer-{{ $answer->id }} bi bi-caret-up-fill text-dark"></i>
                    </button>
                    <p class="answer-score-{{ $answer->id }} points m-0">{{$answer->score}}</p>
                    <button class="icon-hover vote_btn" title="Down Vote" type="submit">
                        <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down"></i>
                        <i class="downvote-answer-{{ $answer->id }} bi bi-caret-down-fill text-dark"></i>
                    </button>
                @endif
            </div>



            <div class="col align-self-start ps-4" id="answer-content-{{$answer->id}}">
                {{ $answer->content }}
            </div>


            <div class="col align-self-start ps-4 d-none">
                <form id="edit-answer-{{$answer->id}}" class="edit-answer-forms" >
                    <div class="border form-control testing-editor" >
                        <textarea class="form-control" placeholder="Type your answer here" name="content"> {{$answer->content}} </textarea>
                        <div class="editor-toolbar"></div>
                    </div>
                    <input type="hidden" name="answerID" value="{{$answer->id}}">
                    <button class="btn btn-primary mt-3" type="submit">Apply Changes </button>
                    <button class="btn btn-outline-primary mt-3" type="button" name="{{$answer->id}}"> Cancel </button>
                </form>
            </div>



            <div class="d-flex flex-column justify-content-center col-auto valid-icon-{{$answer->id}}">
                @if ($answer->valid)
                    <i class="fas fa-check text-center"></i>
                @endif
            </div>

        </div>

    </div>

    <footer class="d-flex align-items-center">
        <span id="answer-{{$answer->id}}-number-comments" class="comments flex-grow-1"> {{ @count($answer->comments) }} Comments</span>

        <!-- if question owner -->
        @if (($answer->valid) && (Auth::id() === $answer->question->question_owner_id))
            <button class="btn btn-link mark-valid-{{ $answer->id }} mark-valid" title="Down Vote" type="submit">Unmark as valid
            </button>
        @elseif (Auth::id() === $answer->question->question_owner_id)
            <button class="btn btn-link mark-valid-{{ $answer->id }}" title="Down Vote" type="submit">Mark as valid
            </button>
        @endif

        @include('partials.common.report', ['margin' => '', 'type'=>'answer', 'id'=>$answer->id])

        <a class="btn btn-link" data-bs-toggle="collapse" href="#collapseCommentForm-{{$answer->id}}" role="button"
           aria-expanded="false" aria-controls="collapseCommentForm-{{$answer->id}}">Add Comment</a>
    </footer>

    <div class="comments">
        <div class="collapse" id="collapseCommentForm-{{$answer->id}}">
            <form class="submit-comments">
                <input type="hidden" name="answerID" value="{{$answer->id}}">
                <div class="mb-3 p-3">
                    <textarea class="form-control" rows="2" name="content" placeholder="Type your comment here"></textarea>
                    <div class="d-grid gap-2 d-flex justify-content-end">
                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
                        <button class="btn btn-outline-primary mt-3" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseCommentForm-{{$answer->id}}" aria-expanded="false"
                                aria-controls="collapseCommentForm-{{$answer->id}}">Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- <div id="question-comments"> -->
        <div id="comments-answer-{{$answer->id}}">
            @include('partials.common.comment-list',['comment'=>$answer->comments])
        </div>
    </div>
</div>

