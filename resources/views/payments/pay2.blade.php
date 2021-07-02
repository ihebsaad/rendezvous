@extends('layouts.backlayout')
 
<script src="https://js.stripe.com/v3/"></script>

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
{{--@include('layouts.back.menu')--}}
 
@section('content')
<style>
.success{
 
.button-success{
background-color:#a0d468;	
}
.statut{
	color:black!important;font-weight:blod;padding:10px 20px 10px 20px!important;margin-top:8px;
}
</style>
  <?php 
  
  use \App\Http\Controllers\ReservationsController;
  use \App\Http\Controllers\UsersController;
  use \App\Http\Controllers\ServicesController;

          $User = auth()->user();

  ?>
 <div id="dashboard"> 
@include('layouts.back.menu')
 
 	<div class="utf_dashboard_content"> 

 
	<!--<div class="row">	<a href="#small-dialog" class="pull-right button popup-with-zoom-anim">Ajouter</a> </div>-->
 
     

           
      <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-refresh"></i>Paiement de la reservation </h3>
                </div>       
        <div class="row">
          <div class="col-md-12" >
            <br>
          </div>
          
         <div class="col-md-12">
        <h1>Page de paiement</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="#" class="my-4">
<!-- placeholder for Elements -->
<div id="card-element"></div>
<div id="card-result"></div>
<br>
<button id="card-button">Payer</button>
                </form>
            </div>
        </div>
    </div>
        

      </div>
    
<div class="col-md-12">
         
<br>
        </div>   
</div> </div></div>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script>

    var stripe = Stripe('pk_test_51IyZEOLYsTAPmLSFNL9DwqmtcBONlT5sTZFcGE3NXBLvYOxVG0L8XicQaTq4KxFYmOJX42jAqCw7QJ1qOFFWjfwp00xPjV3V4L');
    var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');
    var cardholderName = document.getElementById('cardholder-name');
var cardButton = document.getElementById('card-button');
var resultContainer = document.getElementById('card-result');

cardButton.addEventListener('click', function(ev){
    //alert('1');
ev.preventDefault();
  stripe.createPaymentMethod({
      type: 'card',
      card: cardElement,
      
    }).then(function(result) {
    if (result.error) {
      // Display error.message in your UI
      resultContainer.textContent = result.error.message;
    } else {
      // You have successfully created a new PaymentMethod
      var valpaymentMethod = result.paymentMethod.id;
      var customerid = "{{$customerid}}";
      var resId = "{{$resId}}";
       var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('save.customer') }}",
                        method:"get",
            data:{valpaymentMethod:valpaymentMethod, resId:resId , customerid:customerid , _token:_token},
                        success:function(data){
                          window.location.replace("https://prenezunrendezvous.com/reservations");
                        }
                    });
      
      /*resultContainer.textContent = "Created payment method: " + result.paymentMethod.id;*/

    }


  });
}
);

    
</script>

 @endsection

 

@section('footer_scripts')

 
@stop