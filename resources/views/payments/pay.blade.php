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
                            <h3><i class="im im-icon-Credit-Card"></i>Paiement de la reservation </h3>
                        </div>
                    
                    

        <div class="row">
         
          
          <div class="col-md-12">
      
        <div class="row">
            <div class="col-md-12">
                <form action="#" class="my-4">
                    <div id="card-element">
                    <!-- Elements will create input elements here -->
                    </div>

                    <!-- We'll put the error messages in this element -->
                    <div id="card-errors" role="alert"></div>
                    <br>
                    <button class="button border with-icon" id="submit">Procéder au paiement</button>
                </form>
            </div>
        </div>
    </div>
        </div></div></div>

      </div>
 </div></div></div>
          <script src="https://js.stripe.com/v3/"></script>
           <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  //alert("{{ $Res }}");
    var stripe = Stripe('pk_live_51Hbt14Go3M3y9uW5wKqzuQN968NPlPtwzB5UZFzLqTtNAZxoU43qINNnPR7cAO8j1XKoZZ1QZyGkYLHvQjOc5U3c00K0ZoDEMa', {
  stripeAccount: "{{ $idaccount }}"
});

     /*var stripe = Stripe('pk_test_51IyZEOLYsTAPmLSFNL9DwqmtcBONlT5sTZFcGE3NXBLvYOxVG0L8XicQaTq4KxFYmOJX42jAqCw7QJ1qOFFWjfwp00xPjV3V4L');*/
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
    var card = elements.create("card", { style: style });
    card.mount("#card-element");
    card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.classList.add('alert', 'alert-warning', 'mt-3');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('alert', 'alert-warning', 'mt-3');
            displayError.textContent = '';
        }
    });
    var submitButton = document.getElementById('submit');

    submitButton.addEventListener('click', function(ev) {
      $('#submit').html('<i class="fa fa-spinner fa-spin"></i> Loading...').attr('disabled', true);
    ev.preventDefault();
    stripe.confirmCardPayment("{{ $clientSecret }}", {
        payment_method: {
            card: card
        }
        }).then(function(result) {
            if (result.error) {
            // Show error to your customer (e.g., insufficient funds)
            $('#submit').html('Procéder au paiement').attr('disabled', false);
             
            console.log(result.error.message);
            Swal.fire(
                ''+result.error.message+'',
                '',
                'error'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/reservations");
                })
            } else {
              
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                  //alert("ok");
                  var paymentIntent = result.paymentIntent.id;
                 //alert(paymentIntent);
                   var _token = $('input[name="_token"]').val();
                  $.ajax({

                   url:"{{url('/')}}/success/pay/{{ $Res }}", 
                   type : 'get',
                   data:{paymentIntent:paymentIntent, _token:_token},
                   
                   success: function(data){ 
                    //alert(data);
                    $('#submit').html('Procéder au paiement').attr('disabled', false);
                    location.href= "{{ route('reservations') }}";

                          
                }
      
               });
                    // Show a success message to your customer
                    // There's a risk of the customer closing the window before callback
                    // execution. Set up a webhook or plugin to listen for the
                    // payment_intent.succeeded event that handles any business critical
                    // post-payment actions.
                    //console.log(result.paymentIntent);
                }
            }
        });
    });
</script>
	<script type="text/javascript">

function functionEnvoyer() {
   var date = document.getElementById("mydate").value ;
  // var date2 = moment(date).format('YYYY-MM-DD HH:mm');
   //alert(date2);
var _token = $('input[name="_token"]').val();
 
 var idres = $('input[name="idres"]').val();

//alert(dateStr);
 $.ajax({
            url: "{{ route('reservations.changeDate') }}",
            method: "get",
            data: {idres:idres, date:date , _token: _token},
            success: function (data) {
              Swal.fire(
                'Proposition envoyée',
                '',
                'success'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/reservations");
                })
             
               }
             });



    
};
  
  </script>
@endsection('content')