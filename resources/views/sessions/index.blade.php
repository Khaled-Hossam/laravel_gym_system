@extends('layouts.app')

@section('extra_styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
<style>
    .datatable-link{
        padding: 10px;
    }
    .view{
        color: #228;
    }
    .edit{
        color: green;
    }
    .delete{
        color:brown;
    }
    #dataTable_filter input {
        border-radius: 1rem
    }
    </style>
@endsection


@section('content')

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    {{--@method('DELETE')--}}
                    <button type="button" row_delete="" id="delete_item"  class="btn btn-primary" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                </div>

            </div>
        </div>
    </div>
</div>


    <div class="container">
        <div class="row">

            <div class=" col-md-12">
                    <div class="card-header">Sessions</div>
                    <div class="card-body">
                        <a href="{{ route('sessions.create') }}" class="btn btn-success btn-sm" title="Add New Session">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div >
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Starts At</th><th>Finishes At</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
<script>
$(document).ready( function () {
    
  $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/sessions/get-json-data",
        "type":"get",
        "dataSrc": "",
        "columns": [
                {"data":"id"},    
                {"data":"name"},    
                {"data":"starts_at"},    
                {"data":"finishes_at"},    
                       
                {
                    mRender: function (data, type, row) {
                        return '<a class="datatable-link view" href="sessions/'+row.id+'" data-id="' + row[0] + '"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>'
                            + '<a class="datatable-link edit" href="sessions/'+row.id+'/edit'+'" data-id="' + row[0] + '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'
                            + '<a class="datatable-link delete" href="#"  row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>'
                    }    
                },
            
        ],
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        
    } );
    
} );
$(document).on('click','#delete_toggle',function () {
    var delete_id = $(this).attr('row_id');
    $('#delete_item').attr('row_delete',delete_id);
});
$(document).on('click','#delete_item',function () {
    var sessions_id = $(this).attr('row_delete');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/sessions/'+ sessions_id,
        type: 'delete',
        success: function (data) {
            if(window.location.href !== window.location.origin+'/sessions'){
                location.href = window.location.origin+'/sessions';
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
@endsection
