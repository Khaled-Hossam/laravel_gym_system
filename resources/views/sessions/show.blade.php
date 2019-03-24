@extends('layouts.app')

@section('content')
@include('partials.modal')

    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Session {{ $session->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sessions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sessions/' . $session->id . '/edit') }}" title="Edit Session"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <a class="datatable-link delete" href="#"  row_id="{{$session->id}}" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button></a>
                          
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $session->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $session->name }} </td></tr><tr><th> Starts At </th><td> {{ $session->starts_at }} </td></tr><tr><th> Finishes At </th><td> {{ $session->finishes_at }} </td></tr><tr><th> Gym Id </th><td> {{ $session->gym_id }} </td></tr>
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

@include('partials.delete_script')

@endsection
