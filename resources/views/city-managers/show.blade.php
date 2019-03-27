@extends('layouts.app')

@section('content')
@include('partials.modal')

    <div style="display:none" id="crudName" title="city-managers"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">User {{ $user->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('city-managers.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ route('city-managers.edit', $user->id) }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <a class="datatable-link delete" href="#"  row_id="{{$user->id}}" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button></a>
                          
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $user->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $user->name }} </td></tr><tr><th> Email </th><td> {{ $user->email }} </td></tr><tr><th> National Id </th><td> {{ $user->national_id }} </td></tr><tr><th> Avatar </th><td> {{ $user->avatar }} </td></tr><tr><th> Gym Id </th><td> {{ $user->gym_id }} </td></tr>
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