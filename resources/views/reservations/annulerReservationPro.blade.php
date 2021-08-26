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

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-refresh"></i>Annuler la reservation</h3>
                        </div>
                        <div class="row">
        <form class="  " method="get"  action="{{ route('reservations.annule',$idres) }}" >

          <div class="col-md-12" >
            <h2> Merci de remettre l`acompte à votre client. </h2>
            <br>
            <input name="id_user" value="" hidden>
          <input type="" name="idres" value="" hidden>
          </div>
          <div class="col-md-12">
          <input type="submit" style="text-align:center;color:white;margin-top: 30px" value="Remettre l`acompte" ></input>
          <input type="" name="idres" value="{{$idres}}" hidden>
        </div> </form>
            

          </div>
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')