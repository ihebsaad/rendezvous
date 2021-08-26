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
            
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    
                    <!-- Booking Requests Filters  -->
                    <div class="booking-requests-filter">

                        <!-- Sort by -->
                        <!-- <div class="sort-by">
                            <div class="sort-by-select">
                                <select data-placeholder="Default order" class="chosen-select-no-single">
                                    <option>All Listings</option>   
                                    <option>Burger House</option>
                                    <option>Tom's Restaurant</option>
                                    <option>Hotel Govendor</option>
                                </select>
                            </div>
                        </div> -->

                        <!-- Date Range -->
                        <div id="booking-date-range">
                            <span></span>
                        </div>
                    </div>

                    <!-- Reply to review popup -->
                    

                    <h4><i class="im im-icon-Credit-Card"></i> Paiements</h4>
                    @foreach($payments as $payment)
                    <ul>

                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120" alt=""></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>Date: <?php echo   date('d/m/Y H:i', strtotime($payment->created_at ))  ;?></h3>

                                        <div class="inner-booking-list">
                                            <h5>Payeur:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php echo UsersController::ChampById('name',$payment->user).' '.UsersController::ChampById('lastname',$payment->user)  ;?></li>
                                            </ul>
                                        </div>
                                                    
                                        <div class="inner-booking-list">
                                            <h5>Bénéficiaire:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php echo $payment->beneficiaire ;?></li>
                                            </ul>
                                        </div>      
                                                    
                                        <div class="inner-booking-list">
                                            <h5>Détails:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php echo $payment->details;?></li>
                                            </ul>
                                        </div>      

                                        

                                        <!-- <a href="#small-dialog" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a> -->

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="buttons-to-right">
                                <a href="#" class="button gray reject"><i class="sl sl-icon-close"></i> Reject</a>
                                <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> Approve</a>
                            </div> -->
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