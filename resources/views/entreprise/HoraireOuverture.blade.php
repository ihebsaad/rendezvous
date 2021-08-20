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
            <div class="col-lg-12">

                <div id="add-listing">

                           <!-- Section -->
                  <div class="add-listing-section">
                    <form method="post" action="{{ route('changeHeuresOuverture') }}" name="changeHeuresOuverture">
                      @csrf
                      <input type="hidden" name="id" value="{{ $user->id }}">
                    <!-- Headline -->
                    <div class="add-listing-headline">
                      <h3><i class="sl sl-icon-clock"></i> Heures d'ouverture</h3>
                      <!-- Switcher -->
                      <label class="switch"><input type="checkbox" checked><span class="slider round"></span></label>
                    </div>
                    
                    <!-- Switcher ON-OFF Content -->
                    <div class="switcher-content">

                      <!-- Day -->
                      <div class="row opening-day">
                        <div class="col-md-2"><h5>Lundi</h5></div>
                        <div class="col-md-5">
                          <select name="lundi_o" class="chosen-select" data-placeholder="Horaire d'ouverture">
                            <option label="Horaire d'ouverture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->lundi_o=="01:00") {echo "selected";}  ?> >01:00</option>
                            <option value="02:00"  <?php if ($user->lundi_o=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->lundi_o=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->lundi_o=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->lundi_o=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->lundi_o=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->lundi_o=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->lundi_o=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->lundi_o=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->lundi_o=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->lundi_o=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->lundi_o=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->lundi_o=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->lundi_o=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->lundi_o=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->lundi_o=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->lundi_o=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->lundi_o=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->lundi_o=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->lundi_o=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->lundi_o=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->lundi_o=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->lundi_o=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->lundi_o=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <select name="lundi_f" class="chosen-select" data-placeholder="Heure de fermeture">
                            <option label="Heure de fermeture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->lundi_f=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->lundi_f=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->lundi_f=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->lundi_f=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->lundi_f=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->lundi_f=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->lundi_f=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->lundi_f=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->lundi_f=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->lundi_f=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->lundi_f=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->lundi_f=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->lundi_f=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->lundi_f=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->lundi_f=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->lundi_f=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->lundi_f=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->lundi_f=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->lundi_f=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->lundi_f=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->lundi_f=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->lundi_f=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->lundi_f=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->lundi_f=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                      </div>
                      <!-- Day / End -->

                      <!-- Day -->
                      <div class="row opening-day js-demo-hours">
                        <div class="col-md-2"><h5>Mardi</h5></div>
                        <div class="col-md-5">
                          <select name="mardi_o" class="chosen-select" data-placeholder="Horaire d'ouverture">
                            <option label="Horaire d'ouverture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->mardi_o=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->mardi_o=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->mardi_o=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->mardi_o=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->mardi_o=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->mardi_o=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->mardi_o=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->mardi_o=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->mardi_o=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->mardi_o=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->mardi_o=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->mardi_o=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->mardi_o=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->mardi_o=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->mardi_o=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->mardi_o=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->mardi_o=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->mardi_o=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->mardi_o=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->mardi_o=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->mardi_o=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->mardi_o=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->mardi_o=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->mardi_o=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <select name="mardi_f" class="chosen-select" data-placeholder="Heure de fermeture">
                            <option label="Heure de fermeture"></option>
                            <option value="" >Fermé</option>
                            <option value="01:00" <?php if ($user->mardi_f=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->mardi_f=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->mardi_f=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->mardi_f=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->mardi_f=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->mardi_f=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->mardi_f=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->mardi_f=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->mardi_f=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->mardi_f=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->mardi_f=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->mardi_f=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->mardi_f=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->mardi_f=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->mardi_f=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->mardi_f=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->mardi_f=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->mardi_f=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->mardi_f=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->mardi_f=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->mardi_f=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->mardi_f=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->mardi_f=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->mardi_f=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                      </div>
                      <!-- Day / End -->

                      <!-- Day -->
                      <div class="row opening-day js-demo-hours">
                        <div class="col-md-2"><h5>Mercredi</h5></div>
                        <div class="col-md-5">
                          <select name="mercredi_o" class="chosen-select" data-placeholder="Horaire d'ouverture">
                            <option label="Horaire d'ouverture"></option>
                            <option value="" <?php if ($user->lundi_o=="01:00") {echo "selected";}  ?>>Fermé</option>
                            <option value="01:00" <?php if ($user->mercredi_o=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->mercredi_o=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->mercredi_o=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->mercredi_o=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->mercredi_o=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->mercredi_o=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->mercredi_o=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->mercredi_o=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->mercredi_o=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->mercredi_o=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->mercredi_o=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->mercredi_o=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->mercredi_o=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->mercredi_o=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->mercredi_o=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->mercredi_o=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->mercredi_o=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->mercredi_o=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->mercredi_o=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->mercredi_o=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->mercredi_o=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->mercredi_o=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->mercredi_o=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->mercredi_o=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <select name="mercredi_f" class="chosen-select" data-placeholder="Heure de fermeture">
                            <option label="Heure de fermeture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->mercredi_f=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->mercredi_f=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->mercredi_f=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->mercredi_f=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->mercredi_f=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->mercredi_f=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->mercredi_f=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->mercredi_f=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->mercredi_f=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->mercredi_f=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->mercredi_f=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->mercredi_f=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->mercredi_f=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->mercredi_f=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->mercredi_f=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->mercredi_f=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->mercredi_f=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->mercredi_f=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->mercredi_f=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->mercredi_f=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->mercredi_f=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->mercredi_f=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->mercredi_f=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->mercredi_f=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                      </div>
                      <!-- Day / End -->

                      <!-- Day -->
                      <div class="row opening-day js-demo-hours">
                        <div class="col-md-2"><h5>Jeudi</h5></div>
                        <div class="col-md-5">
                          <select name="jeudi_o" class="chosen-select" data-placeholder="Horaire d'ouverture">
                            <option label="Horaire d'ouverture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->jeudi_o=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->jeudi_o=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->jeudi_o=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->jeudi_o=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->jeudi_o=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->jeudi_o=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->jeudi_o=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->jeudi_o=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->jeudi_o=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->jeudi_o=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->jeudi_o=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->jeudi_o=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->jeudi_o=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->jeudi_o=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->jeudi_o=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->jeudi_o=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->jeudi_o=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->jeudi_o=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->jeudi_o=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->jeudi_o=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->jeudi_o=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->jeudi_o=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->jeudi_o=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->jeudi_o=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <select name="jeudi_f" class="chosen-select" data-placeholder="Heure de fermeture">
                            <option label="Heure de fermeture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->jeudi_f=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->jeudi_f=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->jeudi_f=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->jeudi_f=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->jeudi_f=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->jeudi_f=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->jeudi_f=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->jeudi_f=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->jeudi_f=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->jeudi_f=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->jeudi_f=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->jeudi_f=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->jeudi_f=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->jeudi_f=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->jeudi_f=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->jeudi_f=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->jeudi_f=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->jeudi_f=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->jeudi_f=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->jeudi_f=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->jeudi_f=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->jeudi_f=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->jeudi_f=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->jeudi_f=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                      </div>
                      <!-- Day / End -->

                      <!-- Day -->
                      <div class="row opening-day js-demo-hours">
                        <div class="col-md-2"><h5>Vendredi</h5></div>
                        <div class="col-md-5">
                          <select name="vendredi_o" class="chosen-select" data-placeholder="Horaire d'ouverture">
                            <option label="Horaire d'ouverture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->vendredi_o=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->vendredi_o=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->vendredi_o=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->vendredi_o=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->vendredi_o=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->vendredi_o=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->vendredi_o=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->vendredi_o=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->vendredi_o=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->vendredi_o=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->vendredi_o=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->vendredi_o=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->vendredi_o=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->vendredi_o=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->vendredi_o=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->vendredi_o=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->vendredi_o=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->vendredi_o=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->vendredi_o=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->vendredi_o=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->vendredi_o=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->vendredi_o=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->vendredi_o=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->vendredi_o=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <select name="vendredi_f" class="chosen-select" data-placeholder="Heure de fermeture">
                            <option label="Heure de fermeture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->vendredi_f=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->vendredi_f=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->vendredi_f=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->vendredi_f=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->vendredi_f=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->vendredi_f=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->vendredi_f=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->vendredi_f=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->vendredi_f=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->vendredi_f=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->vendredi_f=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->vendredi_f=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->vendredi_f=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->vendredi_f=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->vendredi_f=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->vendredi_f=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->vendredi_f=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->vendredi_f=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->vendredi_f=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->vendredi_f=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->vendredi_f=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->vendredi_f=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->vendredi_f=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->vendredi_f=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                      </div>
                      <!-- Day / End -->

                      <!-- Day -->
                      <div class="row opening-day js-demo-hours">
                        <div class="col-md-2"><h5>Samedi</h5></div>
                        <div class="col-md-5">
                          <select name="samedi_o" class="chosen-select" data-placeholder="Horaire d'ouverture">
                            <option label="Horaire d'ouverture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->samedi_o=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->samedi_o=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->samedi_o=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->samedi_o=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->samedi_o=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->samedi_o=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->samedi_o=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->samedi_o=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->samedi_o=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->samedi_o=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->samedi_o=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->samedi_o=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->samedi_o=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->samedi_o=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->samedi_o=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->samedi_o=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->samedi_o=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->samedi_o=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->samedi_o=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->samedi_o=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->samedi_o=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->samedi_o=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->samedi_o=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->samedi_o=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <select name="samedi_f" class="chosen-select" data-placeholder="Heure de fermeture">
                            <option label="Heure de fermeture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->samedi_f=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->samedi_f=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->samedi_f=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->samedi_f=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->samedi_f=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->samedi_f=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->samedi_f=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->samedi_f=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->samedi_f=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->samedi_f=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->samedi_f=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->samedi_f=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->samedi_f=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->samedi_f=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->samedi_f=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->samedi_f=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->samedi_f=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->samedi_f=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->samedi_f=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->samedi_f=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->samedi_f=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->samedi_f=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->samedi_f=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->samedi_f=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                      </div>
                      <!-- Day / End -->

                      <!-- Day -->
                      <div class="row opening-day js-demo-hours">
                        <div class="col-md-2"><h5>Dimanche</h5></div>
                        <div class="col-md-5">
                          <select name="dimanche_o" class="chosen-select" data-placeholder="Horaire d'ouverture">
                            <option label="Horaire d'ouverture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->dimanche_o=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->dimanche_o=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->dimanche_o=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->dimanche_o=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->dimanche_o=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->dimanche_o=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->dimanche_o=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->dimanche_o=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->dimanche_o=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->dimanche_o=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->dimanche_o=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->dimanche_o=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->dimanche_o=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->dimanche_o=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->dimanche_o=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->dimanche_o=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->dimanche_o=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->dimanche_o=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->dimanche_o=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->dimanche_o=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->dimanche_o=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->dimanche_o=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->dimanche_o=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->dimanche_o=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <select name="dimanche_f" class="chosen-select" data-placeholder="Heure de fermeture">
                            <option label="Heure de fermeture"></option>
                            <option value="">Fermé</option>
                            <option value="01:00" <?php if ($user->dimanche_f=="01:00") {echo "selected";}  ?>>01:00</option>
                            <option value="02:00" <?php if ($user->dimanche_f=="02:00") {echo "selected";}  ?>>02:00</option>
                            <option value="03:00" <?php if ($user->dimanche_f=="03:00") {echo "selected";}  ?>>03:00</option>
                            <option value="04:00" <?php if ($user->dimanche_f=="04:00") {echo "selected";}  ?>>04:00</option>
                            <option value="05:00" <?php if ($user->dimanche_f=="05:00") {echo "selected";}  ?>>05:00</option>
                            <option value="06:00" <?php if ($user->dimanche_f=="06:00") {echo "selected";}  ?>>06:00</option>
                            <option value="07:00" <?php if ($user->dimanche_f=="07:00") {echo "selected";}  ?>>07:00</option>
                            <option value="08:00" <?php if ($user->dimanche_f=="08:00") {echo "selected";}  ?>>08:00</option>
                            <option value="09:00" <?php if ($user->dimanche_f=="09:00") {echo "selected";}  ?>>09:00</option>
                            <option value="10:00" <?php if ($user->dimanche_f=="10:00") {echo "selected";}  ?>>10:00</option>
                            <option value="11:00" <?php if ($user->dimanche_f=="11:00") {echo "selected";}  ?>>11:00</option>
                            <option value="12:00" <?php if ($user->dimanche_f=="12:00") {echo "selected";}  ?>>12:00</option>  
                            <option value="13:00" <?php if ($user->dimanche_f=="13:00") {echo "selected";}  ?>>13:00</option>
                            <option value="14:00" <?php if ($user->dimanche_f=="14:00") {echo "selected";}  ?>>14:00</option>
                            <option value="15:00" <?php if ($user->dimanche_f=="15:00") {echo "selected";}  ?>>15:00</option>
                            <option value="16:00" <?php if ($user->dimanche_f=="16:00") {echo "selected";}  ?>>16:00</option>
                            <option value="17:00" <?php if ($user->dimanche_f=="17:00") {echo "selected";}  ?>>17:00</option>
                            <option value="18:00" <?php if ($user->dimanche_f=="18:00") {echo "selected";}  ?>>18:00</option>
                            <option value="19:00" <?php if ($user->dimanche_f=="19:00") {echo "selected";}  ?>>19:00</option>
                            <option value="20:00" <?php if ($user->dimanche_f=="20:00") {echo "selected";}  ?>>20:00</option>
                            <option value="21:00" <?php if ($user->dimanche_f=="21:00") {echo "selected";}  ?>>21:00</option>
                            <option value="22:00" <?php if ($user->dimanche_f=="22:00") {echo "selected";}  ?>>22:00</option>
                            <option value="23:00" <?php if ($user->dimanche_f=="23:00") {echo "selected";}  ?>>23:00</option>
                            <option value="00:00" <?php if ($user->dimanche_f=="00:00") {echo "selected";}  ?>>00:00</option>
                          </select>
                        </div>
                      </div>
                      <!-- Day / End -->

                    </div>
                    <!-- Switcher ON-OFF Content / End -->

                 
                  <!-- Section / End -->
                  <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <input type="submit" class="button preview" value='Enregistrer' />
                            </div>

                        </div>
                       </div>  <!-- Row / End -->
                </form>
                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')