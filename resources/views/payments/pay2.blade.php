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
                <form id="#">
    <div id="card-element">
      <!-- Elements will create input elements here -->
    </div>

    <!-- We'll put the error messages in this element -->
    <div id="card-element-errors" role="alert"></div>
    <button id="submit2">Subscribe</button>
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
    var style = {
        base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
        },
        invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
        }
    };
    var card = elements.create('card', { style: style });
    card.mount('#card-element');
    card.on('change', function (event) {
      displayError(event);
    });
    function displayError(event) {
      var displayError = document.getElementById('card-element-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    }
    

      var submitButton = document.getElementById('submit2');

    submitButton.addEventListener('click', function(ev) {
      
    ev.preventDefault();

      const nameInput = document.getElementById('name');
//alert("ok");
      // Create payment method and confirm payment intent.
      stripe.confirmCardPayment("{{ $clientSecret }}", {
        payment_method: {
          card: card,
          
        }
      }).then((result) => {
        if(result.error) {
          alert(result.error.message);
        } else {
          // Successful subscription payment
          var res = result.paymentIntent.payment_method ;
          var subscriptionId = "{{$subscriptionId}}";
      var customerid = "{{$customerid}}";
      var resId = "{{$resId}}";
       var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('save.customer') }}",
                        method:"get",
            data:{resId:resId , customerid:customerid , res:res ,subscriptionId:subscriptionId , _token:_token},
                        success:function(data){
                          window.location.replace("https://prenezunrendezvous.com/reservations");
                        }
                    });
        }
      });
    });






    
</script>

 @endsection

 

@section('footer_scripts')

 
@stop