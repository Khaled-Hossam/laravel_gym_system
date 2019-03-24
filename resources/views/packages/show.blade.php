@extends('layouts.app')

@section('content')
@include('partials.modal')

    <div style="display:none" id="crudName" title="packages"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Package {{ $package->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/packages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/packages/' . $package->id . '/edit') }}" title="Edit Package"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <a class="datatable-link delete" href="#"  row_id="{{$package->id}}" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button></a>
                          
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $package->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $package->name }} </td></tr><tr><th> Sessions Number </th><td> {{ $package->sessions_number }} </td></tr><tr><th> Price </th><td> {{ $package->price }} </td></tr>
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