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
                <th scope="col">Content</th>
                <th scope="col" id="reports-number">Reports</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <th>{{$loop->index + 1 + $reports->perpage() * ($reports->currentpage()-1)}}</th>
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
                <td>
                    <div class="d-flex align-items-center">
                        @if (isset($report->question_id) && $report->question_id)
                            <a href="/question/{{$report->question_id}}" class="px-4 d-block">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <div>
                                <p>{{$report->title}}</p>
                                <p class="text-secondary">{{Str::limit($report->question_content,150)}}</p>
                            </div>
                        @elseif (isset($report->answer_id) && $report->answer_id) 
                            <a href="/question/{{$report->answer_question_id}}" class="px-4 d-block">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <p>{{Str::limit($report->answer_content,150)}}</p>
                        @elseif (isset($report->comment_id) && $report->comment_id) 
                            <a href="/question/{{$report->comment_question_id}}" class="px-4 d-block">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <p>{{Str::limit($report->comment_content,150)}}</p>
                        @else 
                            <a href="/user/{{$report->reported_id}}/profile" class="px-4 d-block">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <p>{{$report->username}}</p>
                        @endif
                    </div>
                </td>
                <td>{{$report->number_reports}}</td>
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