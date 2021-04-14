<div class="modal" id="reportContent" tabindex="-1" role="dialog">
    <form method="post" action="/report">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <input type="hidden" name="content_id" value="{{ $user_id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report this content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Explain why you this content is inappropriate:</p>
                    <p><textarea class="form-control" name="reason" style="overflow-y: scroll; min-height: 80pt;"></textarea></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>