@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

  ?>

  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')
<!-- Content
    ================================================== -->
<div class="dashboard-content">
<!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Réservation</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Réservation</li>
                            <li>Paiement</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @if ($live_message = Session::get('ttmessage'))
           <div class="notification success closeable">
                <p>{{ $live_message }}</p>
                <a class="close" href="#"></a>
            </div>
            <?php Session::forget('ttmessage');  ?>
        @endif
        <div class="row">
            <div class="col-lg-8 col-sm-offset-2">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="im im-icon-Credit-Card"></i>Paiement du reste sur 4 mois </h3>
                        </div>     
        <div class="row">
          
          
         <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <form id="#">
    <div id="card-element">
      <!-- Elements will create input elements here -->
    </div>

    <!-- We'll put the error messages in this element -->
    <div id="card-element-errors" role="alert"></div><br>
    <button class="button border with-icon" id="submit2">Procéder au paiement</button>
  </form>
            </div>
        </div>
    </div>
        

      </div>
    
 
</div> </div></div></div></div></div>
          <script src="https://js.stripe.com/v3/"></script>

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script>

    //var stripe = Stripe('pk_live_51Hbt14Go3M3y9uW5wKqzuQN968NPlPtwzB5UZFzLqTtNAZxoU43qINNnPR7cAO8j1XKoZZ1QZyGkYLHvQjOc5U3c00K0ZoDEMa');
    //var stripe = Stripe('pk_live_51Hbt14Go3M3y9uW5wKqzuQN968NPlPtwzB5UZFzLqTtNAZxoU43qINNnPR7cAO8j1XKoZZ1QZyGkYLHvQjOc5U3c00K0ZoDEMa');
    var stripe = Stripe('pk_live_51Hbt14Go3M3y9uW5wKqzuQN968NPlPtwzB5UZFzLqTtNAZxoU43qINNnPR7cAO8j1XKoZZ1QZyGkYLHvQjOc5U3c00K0ZoDEMa');
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
      $('#submit2').html('<i class="fa fa-spinner fa-spin"></i> Loading...').attr('disabled', true);
    ev.preventDefault();

      //const nameInput = document.getElementById('name');
//alert("ok");
      // Create payment method and confirm payment intent.
      stripe.confirmCardPayment("{{ $clientSecret }}", {
        payment_method: {
          card: card,
          
        }
        
      }).then((result) => {
        //alert("ok");
        if(result.error) {
          $('#submit2').html('Procéder au paiement').attr('disabled', false);
          //alert(result.error.message);
          Swal.fire(
                ''+result.error.message+'',
                '',
                'error'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/reservations");
                })
        } else {
          // Successful subscription payment
          $('#submit2').html('Procéder au paiement').attr('disabled', false);
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