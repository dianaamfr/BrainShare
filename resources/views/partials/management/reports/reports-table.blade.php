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
                <th scope="col" class="text-center">State</th>
                <th scope="col" class="text-center">Content</th>
                <th scope="col">Owner</th>
                <th scope="col">Description</th>
                <th scope="col">Reported By</th>
                <th scope="col">Date</th>
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
                    @if ($report->question_id)
                        Question
                    @elseif ($report->answer_id) 
                        Answer
                    @elseif ($report->comment_id) 
                        Comment
                    @else 
                        User
                    @endif
                </td>
                
                <!-- Report State -->
                <td>
                    @if ($report->viewed == true)
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-exclamation"></i>
                    @endif
                </td>

                <!-- Reported Content -->
                <td class="text-center">      
                    <!-- Question -->
                    @if ($report->question_id)
                        <a href="/question/{{$report->question_id}}">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @if($report->question->deleted == true)
                            <p class="deleted-report"> (Deleted) </p>
                        @endif
                    <!-- Answer -->
                    @elseif ($report->answer_id) 
                        <a href="/question/{{$report->answer->question_id}}/answer-{{$report->answer_id}}">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @if($report->answer->deleted == true)
                            <p class="deleted-report"> (Deleted) </p>
                        @endif
                    <!-- Comment -->
                    @elseif ($report->comment_id) 
                        <a href="/question/{{$report->comment->question_id}}/comment-{{$report->comment_id}}">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @if($report->comment->deleted == true)
                            <p class="deleted-report"> (Deleted) </p>
                        @endif
                    <!-- User -->
                    @else 
                        <a href="/user/{{$report->reported_id}}/profile">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @if($report->reported->ban == true)
                            <p class="deleted-report"> (Banned) </p>
                        @endif
                    @endif
                </td>

                <!-- Reported Content Owner -->
                <td>
                    @if ($report->question_id)
                        @if($report->question->question_owner_id)
                            <a href="/user/{{$report->question->question_owner_id}}/profile">
                                <span>{{$report->question->owner->username}}</span>
                            </a>
                        @else
                            <span class="deleted-report">Deleted</span>
                        @endif
                    @elseif ($report->answer_id) 
                        @if($report->answer->answer_owner_id)
                            <a href="/user/{{$report->answer->answer_owner_id}}/profile">
                                <span>{{$report->answer->owner->username}}</span>
                            </a>
                        @else
                            <span class="deleted-report">Deleted</span>
                        @endif
                    @elseif ($report->comment_id) 
                        @if($report->comment->comment_owner_id)
                        <a href="/user/{{$report->comment->comment_owner_id}}/profile">
                            <span>{{$report->comment->owner->username}}</span>
                        </a>
                        @else
                            <span class="deleted-report">Deleted</span>
                        @endif
                    @elseif ($report->reported_id) 
                        <a href="/user/{{$report->reported_id}}/profile">
                            <span>{{$report->reported->username}}</span>
                        </a>
                    @else
                        <p class="deleted-report">Deleted</p>
                    @endif
                </td>

                <!-- Report Description -->
                <td>
                    {{$report->content}}
                </td>

                <!-- Reported By -->
                <td>
                    @if($report->user_id)
                        <a href="/user/{{$report->user_id}}/profile">
                            <span>{{$report->owner->username}}</span>
                        </a>
                    @else
                        <span>Deleted User</span>
                    @endif
                </td>

                <!-- Date -->
                <td>
                    {{ date('d-m-Y', strtotime($report->date)) }}
                </td>

                <!-- Actions -->
                <td>
                    @include('partials.management.reports.report-actions')
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>

    @if($reports->isEmpty())
        <span>No report found</span>
    @endif
</div>

<!-- Get pagination -->
{{ $reports->links() }}