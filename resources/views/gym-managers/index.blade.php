@extends('layouts.app')

@section('extra_styles')

    @include('partials.datatables_style')

@endsection

@section('content')
    @include('partials.modal')

    @if ($message = Session::get('flash_message'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif

    <div style="display:none" id="crudName" title="gym-managers"></div>
    <div class="container">
        <div class="row">
            <div class=" col-12">
                    <div class="card-header">Gym Managers</div>
                    <div class="card-body">
                        <a href="{{ route('gym-managers.create') }}" class="btn btn-success btn-sm" title="Add New User">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div >
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Email</th><th>National Id</th><th>Gym Id</th><th>Actions</th>
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
@include('partials.datatables_scripts')
<script>
$(document).ready( function () {
  var crudName = $('#crudName').attr('title')
    
  $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/"+crudName+"/get-json-data",
        "type":"get",
        "dataSrc": "",
        "columns": [
                {"data":"id"},    
                {"data":"name"},    
                {"data":"email"},    
                {"data":"national_id"},    
                {"data":"gym_id"},      
                {
                    mRender: function (data, type, row) {
                        var status = 'ban';
                        if(row.banned_at)
                            status = 'unban';

                        return '<a class="datatable-link view" href="/' + crudName + '/' + row.id + '" data-id="' + row[0] + '"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>'
                            + '<a class="datatable-link edit" href="/' + crudName + '/' + row.id + '/edit' + '" data-id="' + row[0] + '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'
                            + '<a class="datatable-link delete" href="#"  row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>'
                            + '<a class="datatable-link delete" href="/' + crudName + '/' + row.id + '/ban' + '" data-id="' + row[0] + '"><i class="fa fa-ban" aria-hidden="true"></i>'+status +'</a>'

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
</script>
@include('partials.delete_script')

@endsection
