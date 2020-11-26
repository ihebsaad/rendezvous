 @extends('layouts.frontlayout')
 
 <!--  https://medium.com/justlaravel/how-to-integrate-paypal-payment-gateway-in-laravel-695063599449   -->
 
 @section('content')
 <div class="container">
 <div style="max-width:600px"> 
        @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div><br />
         @endif

    @if (!empty( Session::get('success') ))
        <div class="alert alert-success">

        {{ Session::get('success') }}
        </div>

    @endif
	
<form class="  " method="POST" id="payment-form"    action="{{ route('paypal') }}" >
  {{ csrf_field() }}
  <h2 class="w3-text-blue">Paiement</h2>
   <p>      
  <label class=" "><b>Montant</b></label>
  <input class="form-control " name="amount" type="text"></p>      
  <button class="button ">Payer</button></p>
</form>

</div>

</div>
 @endsection
