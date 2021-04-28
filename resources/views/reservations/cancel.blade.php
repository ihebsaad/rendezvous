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
 
<center> <h2> Paiement annulé ou non effectué</h2> </center>

Vérifiez votre compte PayPal et contacter l'administration du site.
<br>
<?php

if( isset ($reservation )){
 	echo 'ID Réservation : '.$reservation;
	
}
 ?>
 <a href="https://prenezunrendezvous.com/reservations"> Liste des réservations</a><br>

  <!-- 
 <script src="{{  URL::asset('public/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script> 
-->
 
	
 @endsection

 

@section('footer_scripts')

 
@stop