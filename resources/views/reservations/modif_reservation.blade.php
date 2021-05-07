@extends('layouts.backlayout')
 

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
<!-- Session errors -->
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
              <div class="notification success closeable margin-bottom-30">
            <p>{{ Session::get('success') }}</p>
            <a class="close" href="#"></a> 
		  </div>
 @endif
 
	<!--<div class="row">	<a href="#small-dialog" class="pull-right button popup-with-zoom-anim">Ajouter</a> </div>-->
 
     

            <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-refresh"></i>Reporter/Annuler rendez-vous  </h3>
                </div>  
                <input type="" name="idReservation" value="{{$reservation->id}}" hidden >  
                <input type="" name="nbrReport" value="{{$nbrReport}}" hidden >  

        <div class="row">
          <?php if ($posible==true): ?>
            
          
          <div class="col-md-12" >
            <h2><b> Service:</b> {{$reservation->nom_serv_res}} - ({{$reservation->Net}} €)</h2>
            <h2><b> Date:</b> le {{$date}} à {{$heure}}</h2>
            <h2><b> Prestataire:</b> {{$name}} .</h2>
            <br>
          </div>
          <div class="col-md-2">
            <div >
              <a href="javascript:void(0);" class="button" onclick="return FunctionReporter();"  title="Reporter un rdv">Reporter</a>
              <a href="javascript:void(0);" class="button" onclick="return FunctionAnnuler();" title="Ajouter un champs">Annuler</a>
         </div>
        </div>
        <?php else: ?>
          <h2><b> Impossible!</b> Vous n'avez pas le droit d'annuler ou de reporter le rendez-vous car il vous reste moins de 5 jours pour le rendez-vous. </h2>
        <?php endif ?>
        </div>                          
            </div>  </div></div>
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
                  window.location.replace("https://prenezunrendezvous.com/reservations");
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
                  window.location.replace("https://prenezunrendezvous.com/reservations");
    })
            }

  }
  function FunctionAnnuler(){
    if(confirm('Êtes-vous sûrs d`annuler le rendez-vous ?'))
    {
      //alert("ok");
      var idReservation = $('input[name="idReservation"]').val();
      var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('reservations.AnnulerRes') }}",
            method: "get",
            data: {idReservation: idReservation, _token: _token},
            success: function (data) {
              //alert(data);
              Swal.fire(
                'rendez-vous annulé',
                '',
                'success'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/reservations");
                })
              
               }
             });
    }

  }
  </script>
 @endsection

 

@section('footer_scripts')

 
@stop