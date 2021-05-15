<form class="report-actions">
    <div class="input-group flex-nowrap">
        <select class="form-select report-action" 
            @if($report->question_id)
                data-reported-content="{{$report->question_id}}" data-report-type="question">
            @elseif ($report->answer_id) 
                data-reported-content="{{$report->answer_id}}" data-report-type="answer">
            @elseif ($report->comment_content) 
                data-reported-content="{{$report->comment_id}}" data-report-type="comment">
            @else 
                data-reported-content="{{$report->reported_id}}" data-report-type="user">
            @endif
            <option selected disabled value="none">Actions</option>
            @if($report->question_id)
                <option value="ban">Ban</option>
            @endif
            <option value="delete">Delete Content</option>
            <option value="discard">Discard Report</option>
        </select>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check"></i>
        </button>
    </div>
</form>