@extends('layouts.app')
@section('content')
<form action="{{route('payments.store')}}" method="POST" style ="width:1000px">
{{ csrf_field() }}
   
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_XVtieMhchWI4yhoxoJ9WXFAK00FAZQIlcm"
    data-amount="999"
    data-name="Gym Site"
    data-description=" "
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto">
  </script>
</form>
@endsection