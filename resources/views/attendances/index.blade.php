@extends('layouts.app')

@section('extra_styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
@include('partials.datatables_style')
@endsection

@section('content')
@include('partials.modal')
@include('partials.flash_message')

    <div style="display:none" id="crudName" title="attendances"></div>
    <div class="container">
        <div class="row">
            <div class=" col-12">
                    <div class="card-header">Attendance</div>
                    <div class="card-body">
                        <div >
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Member</th><th>Name</th><th>Gym</th><th>From</th><th>To</th><th>Attended at</th>
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
                {"data":"member.name"}, 
                {"data":"session.name"},
                {"data":"session.gym.name"},
                {"data":"session.starts_at"},
                {"data":"session.finishes_at"},   
                {"data":"attended_at"}
                   
                       
                
            
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
