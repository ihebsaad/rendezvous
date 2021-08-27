@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

  ?>
 <style>
 table{background-color:white;border:none!important;;width:100%!important;}
  input[type=checkbox] {
  width: 20px;
  margin: 5px;
  height: 20px;
}
 </style>
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
                    <h2>Mes cartes de fidélité </h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mes cartes de fidélité </li>
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
            
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4><i class="sl sl-icon-present"></i> Carte de fidélité </h4>
                     @foreach ($carteF as $carteF)
                    <ul>

                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img"><a href="#"><img  style="" src="<?php echo  URL::asset('storage/images/'.$carteF->couverture);?>"></a></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{$carteF->titre}}</h3>
                                        <span><b>Réduction :</b> {{$carteF->reduction}}%</span>
                                        <div class="">
                                            <input type="checkbox" <?php if ($carteF->nbr_reservation>=1) { echo 'checked'; } ?>  disabled  >
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=2) { echo 'checked'; } ?>  disabled>
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=3) { echo 'checked'; } ?>  disabled>
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=4) { echo 'checked'; } ?>  disabled>
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=5) { echo 'checked'; } ?>  disabled>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" <?php if ($carteF->nbr_reservation>=6) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=7) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=8) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=9) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=10) { echo 'checked'; } ?> disabled>
                                        </div>
                                        <span><b>Bénéficier par la carte fidélité  :</b> {{$carteF->nbr_fois}} fois</span>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                            </div>
                        </li>

                        

                    </ul>
                    @endforeach
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
@endsection('content')