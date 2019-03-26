@extends('layouts.app')

@section('content')
@include('partials.modal')

    <div style="display:none" id="crudName" title="gyms"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Gym {{ $gym->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('gyms.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ route('gyms.edit', $gym->id) }}" title="Edit Gym"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <a class="datatable-link delete" href="#"  row_id="{{$gym->id}}" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button></a>
                          
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $gym->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $gym->name }} </td></tr><tr><th> Cover Image </th><td> {{ $gym->cover_image }} </td></tr><tr><th> City Id </th><td> {{ $gym->city_id }} </td></tr><tr><th> Creator Id </th><td> {{ $gym->creator_id }} </td></tr>
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