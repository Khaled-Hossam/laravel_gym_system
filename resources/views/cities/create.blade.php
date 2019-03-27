@extends('layouts.app')

@section('content')
<a href="{{route('cities.index')}}" class="btn btn-danger">Back</a>
 @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('cities.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">City Name</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">country</label>
            <select class="form-control" name="country_id">
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>

        

    <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
