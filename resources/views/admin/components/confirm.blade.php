<div id="confirm" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">{{__('common.Confirm Message')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>{{__('common.Are you sure to delete this record')}}</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('common.Close')}}</button>
                <button type="button" class="btn btn-danger btn-delete-item">{{__('common.Delete')}}</button>
            </div>
        </div>
    </div>
</div>
