<div class="table-responsive w-100">
    
    @if (!empty($reports))
    <div class="table-entries">
        Showing {{$reports->perpage() * ($reports->currentpage()-1) + 1}} 
        to {{$reports->perpage() * ($reports->currentpage()-1) + $reports->count()}} 
        of {{$reports->total()}} entries
    </div>
    @endif

    <table class="table table-hover align-middle w-100">
        <thead >
            <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">State</th>
                <th scope="col">Report Description</th>
                <th scope="col">Reported By</th>
                <th scope="col">Reported Content</th>
                <th scope="col">Content Owner</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <!-- Row number -->
                <th>{{$loop->index + 1 + $reports->perpage() * ($reports->currentpage()-1)}}</th>

                <!-- Report Type -->
                <td>
                    @if (isset($report->question_id) && $report->question_id)
                        Question
                    @elseif (isset($report->answer_id) && $report->answer_id) 
                        Answer
                    @elseif (isset($report->comment_id) && $report->comment_id) 
                        Comment
                    @else 
                        User
                    @endif
                </td>
                
                <!-- Report State -->
                <td>
                    {{$report->viewed == true ? 'Handled' : 'Pending'}}
                </td>


                <!-- Report Description -->
                <td>
                    {{$report->content}}
                </td>

                <!-- Reported By -->
                <td>
                    <a href="/user/{{$report->user_id}}/profile">
                        <i class="fas fa-external-link-alt"></i>
                        <span>{{$report->owner->username}}</span>
                    </a>
                </td>

                
                <!-- Reported Content -->
                <td>
                    <div class="d-flex align-items-center">
                        <!-- Question -->
                        @if (isset($report->question_id) && $report->question_id)
                            <a href="/question/{{$report->question_id}}">
                                <i class="fas fa-external-link-alt"></i> 
                                <span>See Question</span>
                            </a>
                        <!-- Answer -->
                        @elseif (isset($report->answer_id) && $report->answer_id) 
                            <a href="/question/{{$report->answer->question_id}}">
                                <i class="fas fa-external-link-alt"></i>
                                <span>See Answer</span>
                            </a>
                        <!-- Comment -->
                        @elseif (isset($report->comment_id) && $report->comment_id) 
                            <a href="/question/{{$report->comment->question_id}}">
                                <i class="fas fa-external-link-alt"></i>
                                <span>See Comment</span>
                            </a>
                        <!-- User -->
                        @else 
                            <a href="/user/{{$report->reported_id}}/profile">
                                <i class="fas fa-external-link-alt"></i>
                                <span>See Profile</span>
                            </a>
                        @endif
                    </div>
                </td>

                <!-- Reported Content Owner -->
                <td>
                    @if (isset($report->question_id) && $report->question_id)
                        <a href="/user/{{$report->question->question_owner_id}}/profile">
                            <i class="fas fa-external-link-alt"></i>
                            <span>{{$report->question->owner->username}}</span>
                        </a>
                    @elseif (isset($report->answer_id) && $report->answer_id) 
                        <a href="/user/{{$report->answer->answer_owner_id}}/profile">
                            <i class="fas fa-external-link-alt"></i>
                            <span>{{$report->answer->owner->username}}</span>
                        </a>
                    @elseif (isset($report->comment_id) && $report->comment_id) 
                        <a href="/user/{{$report->comment_owner_id}}/profile">
                            <i class="fas fa-external-link-alt"></i>
                            <span>{{$report->comment->owner->username}}</span>
                        </a>
                    @elseif (isset($report->reported_id) && $report->reported_id) 
                        <a href="/user/{{$report->reported_id}}/profile">
                            <i class="fas fa-external-link-alt"></i>
                            <span>{{$report->reported->username}}</span>
                        </a>
                    @else
                        <p>Deleted</p>
                    @endif
                </td>

                <!-- Actions -->
                <td>
                    @include('partials.management.reports.report-actions')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @empty ($reports)
    <span>No report found</span>
    @endempty
</div>

<!-- Get pagination -->
{{ $reports->links() }}