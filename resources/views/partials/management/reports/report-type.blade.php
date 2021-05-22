<div>
    <label class="form-label" for="report-type">Report Type</label>
    <select class="me-4 mb-3 form-select" id="report-type" name="report-type">
        <option @if(app('request')->get('report-type') == "all") selected @endif value="all">All</option>
        <option @if(app('request')->get('report-type') == "users") selected @endif value="users">Users</option>
        <option @if(app('request')->get('report-type') == "questions") selected @endif value="questions">Questions</option>
        <option @if(app('request')->get('report-type') == "answers") selected @endif value="answers">Answers</option>
        <option @if(app('request')->get('report-type') == "comments") selected @endif value="comments">Comments</option>
    </select>
</div>