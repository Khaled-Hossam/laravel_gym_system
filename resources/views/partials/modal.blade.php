<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div style="display:none" id="crudName" title="users"></div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you to delete this item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <div>
                    <div id="csrf_value"  hidden >@csrf</div>
                    <button type="button" row_delete="" id="delete_item"  class="btn btn-primary" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>
</div>