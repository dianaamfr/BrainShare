<div class="report-actions d-flex flex-nowrap" data-report-id="{{$report->id}}">
    <!-- Available Actions -->

    @if($report->viewed == true)
        <!-- Handled User Reports -->
        @if($report->reported_id)
            @if ($report->reported->ban == true)
                @include('partials.management.reports.report-button', ['icon' => 'fa-user-check', 'action' => 'revert', 'title' => 'Unban'])
            @else
                @include('partials.management.reports.report-button', ['icon' => 'fa-user-times', 'action' => 'delete', 'title' => 'Ban'])
            @endif
        <!-- Handled Question, Answer, Comment Reports -->
        @elseif(($report->question_id && $report->question->deleted == true) || 
                ($report->answer_id && $report->answer->deleted == true) || 
                ($report->comment_id && $report->comment->deleted == true))
                
                @include('partials.management.reports.report-button', ['icon' => 'fa-trash-restore-alt', 'action' => 'revert', 'title' => 'Restore Content'])
        @else
            @include('partials.management.reports.report-button', ['icon' => 'fa-trash-alt', 'action' => 'delete', 'title' => 'Delete Content'])
        @endif

        @include('partials.management.reports.report-button', ['icon' => 'fa-undo', 'action' => 'undiscard', 'title' => 'Mark as Pending'])
        
    @else
        @if($report->reported_id)
            @if ($report->reported->ban != true)
                @include('partials.management.reports.report-button', ['icon' => 'fa-user-times', 'action' => 'delete', 'title' => 'Ban'])
            @endif
        @elseif(($report->question_id && $report->question->deleted == false) || 
            ($report->answer_id && $report->answer->deleted == false) || 
            ($report->comment_id && $report->comment->deleted == false))
            @include('partials.management.reports.report-button', ['icon' => 'fa-trash-alt', 'action' => 'delete', 'title' => 'Delete Content'])
        @endif

        @include('partials.management.reports.report-button', ['icon' => 'fa-file-excel', 'action' => 'discard', 'title' => 'Discard Report'])
    @endif

</div>