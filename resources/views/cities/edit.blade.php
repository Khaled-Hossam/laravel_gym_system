@extends('layouts.app')

@section('content')
<a href="{{route('cities.index')}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

 @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('cities.update',[$city->id])}}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="exampleInputEmail1">City Name</label>
            <input name="name" type="text" value="{{$city->name}}"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">country</label>
            <select class="form-control" name="country_id">
                @foreach($countries as $country)
                    @if($country->full_name==$city->Country->full_name)
                     <option value="{{$country->id}}" selected>{{$country->full_name}}</option>
                    @else
                     <option value="{{$country->id}}" >{{$country->full_name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endsection

@section('extra_scripts')

@include('partials.delete_script')

@endsectionn
