 @extends('layouts.frontlayout')
 
 @section('content')
 <div class="container">
 <div style="max-width:600px"> 
<form class="  " method="POST" id="payment-form"    action="{{ route('paypal') }}" >
  {{ csrf_field() }}
  <h2 class="w3-text-blue">Paiement</h2>
   <p>      
  <label class="w3-text-blue"><b>Montant</b></label>
  <input class="w3-input w3-border" name="amount" type="text"></p>      
  <button class="w3-btn w3-blue">Payer</button></p>
</form>

</div>

</div>
 @endsection
