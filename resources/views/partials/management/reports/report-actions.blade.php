<form class="report-actions">
    <div class="input-group flex-nowrap">
        <input type="hidden" name="report-id" value="{{$report->id}}">

        <select class="form-select report-action">      
            <!-- Available Actions -->
            <option selected disabled value="none">Actions</option>
                
            <!-- TODO: fix this -->
            @if($report->viewed == true)
                @if(isset($report->reported_id) && $report->reported_id)
                    <option value="revert">Uban User</option>
                @else
                    <option value="delete">Revert Delete</option>
                @endif
            @else
                @if(isset($report->reported_id) && $report->reported_id)
                    <option value="delete">Ban User</option>
                @else
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