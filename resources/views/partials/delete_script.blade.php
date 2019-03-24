<script>

$(document).on('click','#delete_toggle',function () {
    var delete_id = $(this).attr('row_id');
    $('#delete_item').attr('row_delete',delete_id);
});
$(document).on('click','#delete_item',function () {
    var id = $(this).attr('row_delete');
    var crudName = $('#crudName').attr('title')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/'+ crudName +'/'+ id,
        type: 'delete',
        success: function (data) {
            if(window.location.href !== window.location.origin+'/'+crudName){
                location.href = window.location.origin+'/'+crudName;
            }
            else{
                var table = $('#dataTable').DataTable();
                table.ajax.reload();
            }
        },
        error: function (response) {
            alert(' error');
            console.log(response);
        }
    });
});

</script>