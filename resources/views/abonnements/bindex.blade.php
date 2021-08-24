@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;
use \App\User;

   $cuser = auth()->user();
         
        $User =\App\User::find($cuser->id);
        $user_type=$User->user_type;
  ?>

  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')
<!-- Content
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <div class="dashboard-content">

        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Bookings</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Bookings</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    
                    <!-- Booking Requests Filters  -->
                    <div class="booking-requests-filter">

                        <!-- Sort by -->
                        <div class="sort-by">
                            <a href="{{route('pricing')}}" class="pull-right button ">S'abonner / Prolonger</a>
                        </div>

                        <!-- Date Range -->
                        <div id="booking-date-range">
                            <span></span>
                        </div>
                    </div>

                    <!-- Reply to review popup -->
                    <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                        <div class="small-dialog-header">
                            <h3>Send Message</h3>
                        </div>
                        <div class="message-reply margin-top-0">
                            <textarea cols="40" rows="3" placeholder="Your Message to Kathy"></textarea>
                            <button class="button">Send</button>
                        </div>
                    </div>

                    <h4><i class="im im-icon-Coins"></i> Abonnements </h4>
                    <?php foreach($abonnements as $abonnement){ ?>
                    <ul>

                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img">
                                <img src="<?php echo  URL::asset('public/imm.png');?>" alt="" style="">
                            </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                    <?php if($user_type=='admin' ){  ?>
                                     <h3><?php echo UsersController::ChampById('name',$abonnement->user).' '.UsersController::ChampById('lastname',$abonnement->user) ;?> </h3>
                                     <?php } ?>
                                        <div class="inner-booking-list">
                                            <h5>Date début: </h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php echo   date('d/m/Y H:i', strtotime($abonnement->created_at ))  ;?>  </li>
                                            </ul>
                                        </div>
                                                   
                                        <div class="inner-booking-list">
                                            <h5>Date expiration: </h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php echo date('d/m/Y H:i', strtotime($abonnement->expire ))  ;?></li>
                                            </ul>
                                        </div>      
                                                    
                                             
                                        

                                        <div class="inner-booking-list">
                                            <h5>Détails: </h5>
                                            <ul class="booking-list">
                                               
                                                <li><?php echo $abonnement->details;?></li>
                                            </ul>
                                        </div>

                                        <!-- <a  class="button gray" style="margin:10px 10px 10px 10px"  ><i class="fa fa-close"></i>  Proposer des dates</a> -->

                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                               
       <a  class="button gray reject"   onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('AbonnementsController@remove', $abonnement->id)}}"><i class="sl sl-icon-close"></i>   Annuler</a>
        
                                       
               
       
   
                            </div>
                        </li>
                        
                    </ul>
                    <?php } ?>
                </div>
            </div>


         
        </div>

    </div>
    <!-- Content / End -->
</div>
</div>



@endsection('content')