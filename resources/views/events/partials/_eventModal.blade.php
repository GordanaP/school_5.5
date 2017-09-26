<div class="modal fade" tabindex="-1" role="dialog" id="eventModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa"></i>
                    <span class="ls-1"></span>
                </h4>
            </div>
            <div class="modal-body">
                @include('events.partials._eventForm')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left close__button" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-default cancel__button" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary event__button" data-dismiss="modal" id="" data-user="{{ $user->name }}"></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->