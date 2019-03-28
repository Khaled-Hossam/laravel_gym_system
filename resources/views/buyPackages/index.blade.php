@extends('layouts.app')

@section('extra_styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
@include('partials.datatables_style')
@endsection

@section('content')
@include('partials.modal')

    <div style="display:none" id="crudName" title="packages"></div>
    <div class="container">
        <div class="row">
            <div class=" col-12">
                    <div class="card-header">packages</div>
                    <div class="card-body">
                        
                        <br/>
                        <br/>
                        <div >
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Email</th><th>Sessions Remaining</th><th>Actions</th>
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
  var crudName = "membersForPayments";
    console.log(crudName);
  $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "membersForPayments/get-json-data",
        "type":"get",
        "dataSrc": "",
        "columns": [
                {"data":"id"},    
                {"data":"name"},
                {"data":"email"}, 
                {"data":"remaining_sessions"},      
                       
                {
                    mRender: function (data, type, row) {
                        return '<a class="datatable-link view" href="' + crudName + '/' + row.id + '" data-id="' + row[0] + '"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Package</button></a>'
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


@endsection
