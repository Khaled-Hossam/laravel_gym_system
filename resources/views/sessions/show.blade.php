@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

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

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Session {{ $session->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sessions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sessions/' . $session->id . '/edit') }}" title="Edit Session"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        {{-- <form method="POST" action="{{ url('sessions' . '/' . $session->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Session" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form> --}}
                    <a class="datatable-link delete" href="#"  row_id="{{$session->id}}" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button></a>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $session->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $session->name }} </td></tr><tr><th> Starts At </th><td> {{ $session->starts_at }} </td></tr><tr><th> Finishes At </th><td> {{ $session->finishes_at }} </td></tr>
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
<script>
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
