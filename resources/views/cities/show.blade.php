@extends('layouts.app')

@section('content')
@include('partials.modal')

    <div style="display:none" id="crudName" title="cities"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">City {{ $city->id }}</div>
                    <div class="card-body">

                        <a href="{{route('cities.index')}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/cities/' . $city->id . '/edit') }}" title="Edit City"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <a class="datatable-link delete" href="#"  row_id="{{$city->id}}" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button></a>
                          
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $city->id }}</td>
                                    </tr>
                                    <tr> 
                                         <th> Name </th><td> {{ $city->name }} </td>
                                    </tr>
                                    <tr>
                                        <th>Country</th><td>{{ $city->country->name }}</td>
                                    </tr>
                                    <tr> 
                                         <th> Country full name </th><td> {{ $city->country->full_name }} </td>
                                    </tr>
                                    <tr> 
                                         <th> Country currency_code </th><td> {{ $city->country->currency_code}} </td>
                                    </tr>
                                    <tr> 
                                         <th> Country currency </th><td> {{ $city->country->currency}} </td>
                                    </tr>
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