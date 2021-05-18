<div class="table-responsive w-100">
    
    @if ($reports->isNotEmpty())
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
                <th scope="col">Reported Content</th>
                <th scope="col">Content Owner</th>
                <th scope="col" id="reports-number">Reports</th>
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
                
                <!-- Reported Content -->
                <td>
                    <div class="d-flex align-items-center">
                        <!-- Question -->
                        @if (isset($report->question_id) && $report->question_id)
                            <a href="/question/{{$report->question_id}}">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <div class="reported-content">
                                <p>{{$report->title}}</p>
                                <p class="text-secondary">{{Str::limit($report->question_content,150)}}</p>
                            </div>

                        <!-- Answer -->
                        @elseif (isset($report->answer_id) && $report->answer_id) 
                            <a href="/question/{{$report->answer_question_id}}">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <p class="reported-content">{{Str::limit($report->answer_content,150)}}</p>

                        <!-- Comment -->
                        @elseif (isset($report->comment_id) && $report->comment_id) 
                            <a href="/question/{{$report->comment_question_id}}">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <p class="reported-content">{{Str::limit($report->comment_content,150)}}</p>

                        <!-- User -->
                        @else 
                            <a href="/user/{{$report->reported_id}}/profile">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <p class="reported-content">{{$report->username}}</p>
                        @endif
                    </div>
                </td>

                <!-- Reported Content Owner -->
                <td>
                    @if (isset($report->question_owner_id) && $report->question_owner_id)
                        <a href="/user/{{$report->question_owner_id}}/profile">
                            <p>{{$report->question_owner_username}}</p>
                        </a>
                    @elseif (isset($report->answer_owner_id) && $report->answer_owner_id) 
                        <a href="/user/{{$report->answer_owner_id}}/profile">
                            <p>{{$report->answer_owner_username}}</p>
                        </a>
                    @elseif (isset($report->comment_owner_id) && $report->comment_owner_id) 
                        <a href="/user/{{$report->comment_owner_id}}/profile">
                            <p>{{$report->comment_owner_username}}</p>
                        </a>
                    @elseif (isset($report->reported_id) && $report->reported_id) 
                        <a href="/user/{{$report->reported_id}}/profile">
                            <p>{{$report->username}}</p>
                        </a>
                    @else
                        <p>Deleted</p>
                    @endif
                </td>
                
                <!-- Number of Reports -->
                <td>{{$report->number_reports}}</td>

                <!-- Actions -->
                <td>
                    @include('partials.management.reports.report-actions')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($reports->isEmpty())
    <span>No report found</span>
    @endif
</div>

<!-- Get pagination -->
{{ $reports->links() }}