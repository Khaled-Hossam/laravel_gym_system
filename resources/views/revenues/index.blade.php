@extends('layouts.app')

@section('extra_styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
@include('partials.datatables_style')
@endsection

@section('content')
@include('partials.modal')
@include('partials.flash_message')

    <div style="display:none" id="crudName" title="revenues"></div>
    <div class="container">
        <div class="row">
            <div class=" col-12">
                    <div class="card-header">Revenues is {{$revenues}}</div>
                    <div class="card-body">
                        

                        <br/>
                        <br/>
                        <div >
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                    <th># </th>   <th>Member Name </th><th>Member Email</th><th>Package Name</th><th>Paid Price</th><th>Gym Name</th><th>City Name</th>
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
                {"data":"member.email"},
                {"data":"package.name"},
                {"data":"bought_price"},
                {"data":"gym.name"},
                {"data":"gym.city.name"},                       
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

