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
                    <h2>Prestataires</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Prestataires</li>
                            
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

                        

                        <!-- Date Range -->
                        <div id="booking-date-range">
                            <span></span>
                        </div>
                    </div>

                    

                    <h4>Prestataires</h4>
                    @foreach($users as $user)
                    <ul class="one" attr="<?php $createdat=  date('d/m/Y', strtotime($user->created_at )); echo $createdat; ?>">

                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img">
                                    <?php if( $user->logo!=''){?>
                                        <img id='img-logo' src="<?php echo  URL::asset('storage/images/'.$user->logo);?>"  />
                                    <?php } else {?>
                                    <img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120" alt="">
                                <?php }  ?>
                                </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3><a href="{{action('UsersController@profile', $user['id'])}}" >{{$user->name .' '.$user->lastname }}</a> </h3>
                                        <div class="inner-booking-list">
                                            <h5>Entreprise:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$user->titre}}</li>
                                            </ul>
                                        </div>  
                                        <div class="inner-booking-list">
                                            <h5>Siren/siret de l'entreprise:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$user->siren}}</li>
                                            </ul>
                                        </div>  
                                        <div class="inner-booking-list">
                                            <h5>Date d’inscription:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php $createdat=  date('d/m/Y H:i', strtotime($user->created_at )); echo $createdat; ?></li>
                                            </ul>
                                        </div>
                                                    
                                        <div class="inner-booking-list">
                                            <h5>Email:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$user->email}}</li>
                                            </ul>
                                        </div>      
                                                    
                                        <div class="inner-booking-list">
                                            <h5>Téléphone:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$user->phone}}</li>
                                            </ul>
                                        </div>      

                                        

                                        

                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <!--<a onclick="return confirm('Êtes-vous sûrs ?')"  href="{{--action('UsersController@destroy', $user['id'])--}}" class="button gray reject"><i class="sl sl-icon-close"></i> Supprimer</a>-->
                                <a href="{{action('UsersController@profile', $user['id'])}}" class="button gray approve"><i class="sl sl-icon-eye"></i> Profil</a>
                            </div>
                        </li>

                       

                        
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')