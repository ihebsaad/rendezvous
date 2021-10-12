@extends('layouts.frontv2layout')
 
<script src="https://js.stripe.com/v3/"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
{{--@include('layouts.back.menu')--}}
 
@section('content')
<style>
.success{}
 
.button-success{
background-color:#a0d468; 
}
.statut{
  color:black!important;font-weight:blod;padding:10px 20px 10px 20px!important;margin-top:8px;
}

.dashboard-list-box h4 {
    font-size: 26px;
    background-color: #ffd700;}

.dashboard-list-box.with-icons ul li {
       padding-left: 30px;
       padding-top: 50px;
}

.dashboard-list-box .button {
    padding: 20px;
    line-height: 20px;
    font-size: 15px;
    font-weight: 600;
    margin: 0;
    margin-top: 30px;
}
</style>
  <?php 
  
  use \App\Http\Controllers\ReservationsController;
  use \App\Http\Controllers\UsersController;
  use \App\Http\Controllers\ServicesController;

          $User = auth()->user();

  ?>
  <section class="fullwidth_block margin-top-0 padding-top-100 padding-bottom-100" data-background-color="#fff"> 
    <div class="container">
        <div class="row">        
            <div class="col-md-8 col-md-offset-2">
           
              <div class="dashboard-list-box with-icons margin-top-20">
                  <h4>Paiement de votre abonnement (montant à payer : {{$montant}} €)</h4>      
                <ul>
                               <li> <form action="#" class="my-4">
                                    <div id="card-element">
                                    <!-- Elements will create input elements here -->
                                    </div>

                                    <!-- We'll put the error messages in this element -->
                                    <div id="card-errors" role="alert"></div>
                                    <br>
                                    <button class="button border with-icon" id="submit2">Procéder au paiement</button>
                                </form></li></ul>
                </div>
            </div>
        </div>
    </div>
</section>

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script>

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
          alert(result.error.message);
          Swal.fire(
                ''+result.error.message+'',
                '',
                'error'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/reservations");
                })
        } else {
          // Successful subscription payment
          
          var res = result.paymentIntent.payment_method ;
          var subscriptionId = "{{$subscriptionId}}";
      var customerid = "{{$customerid}}";
      var paymentIntent = result.paymentIntent.id;
                 //alert(paymentIntent);
                   var abn = "{{ $abn }}" ;
                   var nature_abonn="{{ $nature_abonn }}";
                   var mensuel_annuel="{{ $mensuel_annuel }}";
                   var username="{{ $username }}";
                   var name ="{{ $name }}";
                   var lastname ="{{ $lastname }}";
                   var phone ="{{ $phone }}";
                   var email ="{{ $email }}";
                   var titre ="{{ $titre }}";
                   var siren ="{{ $siren }}"; 
                   var adresse ="{{ $adresse }}";
                   var ville ="{{ $ville }}";
                   var codep ="{{ $codep }}";
                   var fhoraire ="{{ $fhoraire }}";
                   var date_inscription ="{{ $date_inscription }}";
                   var urlqrcode ="{{ $urlqrcode }}";
                   var user_type ="{{ $user_type }}";
                   var password ="{{ $password }}";
                   var montant ="{{$montant}}";
                   var pays="{{$pays}}";
                   var ind_tel="{{$ind_tel}}";
       var _token = $('input[name="_token"]').val();
       $.ajax({

                   url:"{{url('/')}}/success/payAbn/{{ $usr }}", 
                   type : 'get',
                   data:{subscriptionId:subscriptionId ,paymentIntent:paymentIntent,nature_abonn:nature_abonn,mensuel_annuel:mensuel_annuel, abn:abn , _token:_token,username:username, name:name,lastname:lastname,phone:phone,email:email,titre:titre,siren:siren,adresse:adresse,ville:ville,codep:codep,fhoraire:fhoraire,date_inscription:date_inscription,urlqrcode:urlqrcode,user_type:user_type,password:password,montant:montant,pays:pays,ind_tel:ind_tel},
                   
                   success: function(data){ 
                    //alert(data);
                    $.ajax({
                        url:"{{ route('save.customerAbn') }}",
                        method:"get",
            data:{ customerid:customerid , res:res ,subscriptionId:subscriptionId , _token:_token},
                        success:function(data){
                          $('#submit2').html('Procéder au paiement').attr('disabled', false);
                          location.href= "{{ route('remerciments') }}";
                        }
                    });
                    


                          //window.location.replace("https://prenezunrendezvous.com/reservations");
                        }
                    });




                    
        }
      });
    });






    
</script>


 @endsection

 

@section('footer_scripts')

 
@stop