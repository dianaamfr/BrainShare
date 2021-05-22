<div>
    <label class="form-label" for="report-state">Report State</label>
    <select class="me-4 mb-3 form-select" id="report-state" name="report-type">
        <option @if(app('request')->get('report-state') == "pending") selected @endif value="pending">Pending</option>
        <option @if(app('request')->get('report-state') == "handled") selected @endif value="handled">Handled</option>
        <option @if(app('request')->get('report-state') == "all") selected @endif value="all">All</option>
    </select>
</div>