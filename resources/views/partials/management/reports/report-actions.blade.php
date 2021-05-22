<form class="report-actions">
    <div class="input-group flex-nowrap">
        <input type="hidden" name="report-id" value="{{$report->id}}">

        <select class="form-select report-action">      
            <!-- Available Actions -->
            <option selected disabled value="none">Actions</option>
                
            @if($report->viewed == true)
                <!-- Handled User Reports -->
                @if($report->reported_id)
                    @if ($report->reported->ban == true)
                        <option value="revert">Unban User</option>
                    @else
                        <option value="delete">Ban User</option>
                    @endif
                <!-- Handled Question, Answer, Comment Reports -->
                @elseif(($report->question_id && $report->question->deleted == true) || 
                        ($report->answer_id && $report->answer->deleted == true) || 
                        ($report->comment_id && $report->comment->deleted == true))
                        <option value="revert">Revert Delete</option>
                @else
                    <option value="delete">Delete Content</option>
                @endif
            @else
                @if($report->reported_id)
                    @if ($report->reported->ban != true)
                        <option value="delete">Ban User</option>
                    @endif
                @elseif(($report->question_id && $report->question->deleted == false) || 
                    ($report->answer_id && $report->answer->deleted == false) || 
                    ($report->comment_id && $report->comment->deleted == false))
                    <option value="delete">Delete Content</option>
                @endif
                <option value="discard">Discard</option>
            @endif
        </select>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check"></i>
        </button>
    </div>
</form>