@extends('layouts.app')

@section('extra_styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
    
    @include('partials.datatables_style')
@endsection

@section('content')
@include('partials.modal')
@include('partials.flash_message')

<div style="display:none" id="crudName" title="sessions"></div>
    <div class="container">
        <div class="row">

            <div class=" col-12">
                    <div style="display:none" id="crudName" title="gyms"></div>
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
                                        <th>#</th><th>Name</th><th>Starts At</th><th>Finishes At</th><th>Gym Id</th><th>Actions</th>
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
                {"data":"starts_at"},    
                {"data":"finishes_at"},    
                {"data":"gym.name"},    
                       
                {
                    mRender: function (data, type, row) {
                        return '<a class="datatable-link view" href="/' + crudName + '/' + row.id + '" data-id="' + row[0] + '"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>'
                            + '<a class="datatable-link edit" href="/' + crudName + '/' + row.id + '/edit' + '" data-id="' + row[0] + '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'
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
</script>
@include('partials.delete_script')

@endsection
