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
                    <h2>Mon entreprise</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mon entreprise</li>
                            <li>Titre & Description</li>
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
      <input type="" name="idReservation" value="{{$reservation->id}}" hidden >  
                <input type="" name="nbrReport" value="{{$nbrReport}}" hidden > 
      <!-- Listings -->
      <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
          
                

          <h4><i class="sl sl-icon-refresh"></i> Reporter/Annuler rendez-vous</h4>
          <?php if ($posible==true): ?>
          <ul>

            <li class="pending-booking">
              <div class="list-box-listing bookings">
                <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120" alt=""></div>
                <div class="list-box-listing-content">
                  <div class="inner">
                    <h3>{{$reservation->nom_serv_res}} - ({{$reservation->Net}} €) </h3>

                    <div class="inner-booking-list">
                      <h5>Date:</h5>
                      <ul class="booking-list">
                        <li class="highlighted">le {{$date}} à {{$heure}}</li>
                      </ul>
                    </div>
                          
                    <div class="inner-booking-list">
                      <h5>Prestataire:</h5>
                      <ul class="booking-list">
                        <li class="highlighted">{{$name}}</li>
                      </ul>
                    </div>    
                          
                    
<!-- 
                    <a href="#small-dialog" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a> -->

                  </div>
                </div>
              </div>
              <div class="buttons-to-right">
               
                <a href="javascript:void(0);"  onclick="return FunctionAnnuler();"  title="Annuler un rdv" class="button gray reject"><i class="sl sl-icon-close"></i> Annuler</a>
                <a href="javascript:void(0);" title="Reporter un rdv" onclick="return FunctionReporter();" class="button gray approve"><i class="sl sl-icon-check"></i> Reporter</a>
              </div>
            </li>

            
            
          </ul>
          <?php else: ?>
            <ul>

            <li class="pending-booking">
            <h2><b> Impossible!</b> Vous n'avez pas le droit d'annuler ou de reporter le rendez-vous car il vous reste moins de 5 jours pour le rendez-vous. </h2>
          </li></ul>
        <?php endif ?>

        </div>
      </div>


      <!-- Copyrights -->
      <div class="col-md-12">
        <div class="copyrights">© 2019 Listeo. All Rights Reserved.</div>
      </div>
    </div>
<!-- Content end
    ================================================== -->
</div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script type="text/javascript">
   function FunctionReporter(){
    var nbrReport = $('input[name="nbrReport"]').val();
    //alert(parseInt(nbrReport));
    if (parseInt(nbrReport)<=5) {
    if(confirm('Êtes-vous sûrs d`envoyer une demande de reportation?'))
    {
      //alert("ok");
      var idReservation = $('input[name="idReservation"]').val();
      var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('reservations.reporter') }}",
            method: "get",
            data: {idReservation: idReservation, _token: _token},
            success: function (data) {
              Swal.fire(
                'Demande envoyée',
                '',
                'success'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/ReservezUnRdv/{{(auth()->user())->id}}");
                })

               }
             });
    }
  }else {
      Swal.fire(
                'Impossible! ',
                'Vous avez atteint le maximum de nombre des reports.',
                'error'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/ReservezUnRdv/{{(auth()->user())->id}}");
    })
            }

  }
  function FunctionAnnuler(){
    if(confirm('Êtes-vous sûrs d`annuler le rendez-vous ?'))
    {
      //alert("ok");
      var idReservation = $('input[name="idReservation"]').val();
      var _token = $('input[name="_token"]').val();
       //alert(idReservation);
        $.ajax({
            url: "{{ route('reservations.AnnulerRes') }}",
            method: "get",
            data: {idReservation: idReservation, _token: _token},
            success: function (data) {
             // alert(data);
              Swal.fire(
                'rendez-vous annulé',
                '',
                'success'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/ReservezUnRdv/{{(auth()->user())->id}}");
                })
              
               }
             });
    }

  }
  </script>
@endsection('content')