@extends('layouts.app')
@section('content')

<a href="{{route('payments.index')}}" class="btn btn-danger">Back</a>
 @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('payments.store')}}" method="POST">
        @csrf
        <input type="hidden"  name="member" value="{{$member}}">
        <div class="form-group">
            <label for="Gyms">Gyms</label>
            <select class="form-control" name="gym_id" id="gym">
                @foreach($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Package">Package</label>
            <select class="form-control" name="package_id" id="package">
                @foreach($packages as $package)
                    <option value="{{$package->id}}" price="{{$package->price}}">{{$package->name}} has {{$package->sessions_number}} with {{number_format($package->price/100,2)}} dollar</option>
                @endforeach
            </select>
        </div>
     
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_XVtieMhchWI4yhoxoJ9WXFAK00FAZQIlcm"
    data-name="Gym Site"
    data-description=" "
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto">
     //onsole.log(strUser);
  </script>
        

   
    </form>

@endsection
