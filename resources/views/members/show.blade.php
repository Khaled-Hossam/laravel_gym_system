@extends('layouts.app')

@section('content')
@include('partials.modal')

    <div style="display:none" id="crudName" title="members"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">member {{ $member->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('members.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ route('members.edit', $member->id) }}" title="Edit member"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <a class="datatable-link delete" href="#"  row_id="{{$member->id}}" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button></a>
                          
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $member->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $member->name }} </td></tr><tr><th> Email </th><td> {{ $member->email }} </td></tr><tr><th> National Id </th><td> {{ $member->national_id }} </td></tr><tr><th> Avatar </th><td> {{ $member->avatar }} </td></tr><tr><th> Gym Id </th><td> {{ $member->gym_id }} </td></tr>
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