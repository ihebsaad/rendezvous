@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;
use \App\User;
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
                            <div class="sort-by-select">
                                <select data-placeholder="Default order" class="chosen-select-no-single">
                                    <option>All Listings</option>   
                                    <option>Burger House</option>
                                    <option>Tom's Restaurant</option>
                                    <option>Hotel Govendor</option>
                                </select>
                            </div>
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

                    <h4>Booking Requests</h4>
                    <?php foreach($reservations as $res){ ?>
                    <ul>

                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120" alt=""></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{$res->nom_serv_res}} 
                                            <?php  if($res->statut==0){ ?><span class="booking-status pending">En attente</span>
                                             <?php } elseif($res->statut==1){ ?>   
                                             <span class="booking-status " style="background-color: #38b653" >Validée</span>
                                                <?php } elseif($res->statut==2) { ?> 
                                              <span class="booking-status unpaid"  >Annulée</span>
                                          <?php } ?>

                                          <?php  if($res->paiement==1){ ?><span class="booking-status pending">Acompte Payé</span>
                                             <?php } elseif($res->paiement==2){ ?>   
                                             <span class="booking-status " style="background-color: #38b653" >Total Payée</span>
                                                <?php } elseif($res->paiement==3) { $retraits=\App\Retrait::where('reservation',$res->id)->where('statut',1)->count(); ?> 
                                              <span class="booking-status unpaid" style="background-color: #ffd700"  >Paiement par tranches : acompte + ({{$retraits}}/4) tranches payées</span>
                                          <?php } ?>


                                        </h3>
                                         <?php if($res->nom_prod_res) { ?>
                                        <div class="inner-booking-list">
                                            <h5>Produits:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$res->nom_prod_res}}  </li>
                                            </ul>
                                        </div>
                                             <?php } ?>       
                                        <div class="inner-booking-list">
                                            <h5>Réduction:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$res->reduction  }}</li>
                                            </ul>
                                        </div>      
                                                    
                                        <div class="inner-booking-list">
                                            <h5>Date:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php  
                    $dateres = new DateTime($res->date_reservation); echo $dateres->format('d/m/Y H:i') ; ?></li>
                                            </ul>
                                        </div>      
                                        <div class="inner-booking-list">
                                            <h5>Total:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$res->Net  }} €</li>
                                            </ul>
                                        </div> 

                                        <div class="inner-booking-list">
                                            <h5>Client:</h5>
                                            <ul class="booking-list">
                                                <li><?php $clt=User::where('id',$res->client)->first();if($clt) {if($clt->name && $clt->lastname){ echo $clt->name.' '.$clt->lastname ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->client)->first();if($clt) {if($clt->email){ echo $clt->email ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->client)->first();if($clt) {if($clt->phone){ echo $clt->phone ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                            </ul>
                                        </div>
                                        <div class="inner-booking-list">
                                            <h5>Prestataire:</h5>
                                            <ul class="booking-list">
                                                <li><?php $clt=User::where('id',$res->prestataire)->first();if($clt) {if($clt->name && $clt->lastname){ echo $clt->name.' '.$clt->lastname ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->prestataire)->first();if($clt) {if($clt->email){ echo $clt->email ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->prestataire)->first();if($clt) {if($clt->phone){ echo $clt->phone ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                            </ul>
                                        </div>

                                      <!--   <a  class="button gray" style="margin:10px 10px 10px 10px"  href="{{action('ReservationsController@newDate', $res->id)}}"><i class="fa fa-close"></i>  Proposer des dates</a> -->

                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                               <!--  <?php if ($res->statut!=2) { ?>

                                <?php if ($res->paiement==0) { ?>
       <a  class="button gray reject"   onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@annuler', $res->id)}}"><i class="sl sl-icon-close"></i>   Annuler</a>
        <?php } else { ?>
          <a  class="button gray reject"   onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@AnnulerReservation', $res->id)}}"><i class="sl sl-icon-close"></i> Annuler</a>
          <?php }} ?> 
                                <?php if($res->statut==1){  ?>           
               
       
      <a  class="button gray approve"  onclick="return confirm('Êtes-vous sûrs de vouloir VALIDER cette réservation ?')"  href="{{action('ReservationsController@valider', $res->id)}}"><i class="sl sl-icon-check"></i>  Valider</a>
      <?php } ?>  -->
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