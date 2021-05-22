<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="reportModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="report-content" class="mb-3">What is the cause of the report?</label>
                <textarea class="form-control w-100" id="report-content" maxlength="500" minlength="100" name="content" placeholder="Tell us more..."></textarea>
                <div class="error">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="report-cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="report-submit" class="btn btn-primary">Report</button>
            </div>

        </div>
    </div>
</div>
