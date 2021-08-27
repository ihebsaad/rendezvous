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
                    <h2>Mes Favoris </h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            
                            <li>Mes Favoris </li>
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
                    <h4><i class="fa  fa-heart"></i> Mes Favoris</h4>
                    @foreach($users as $user)
                    <ul>

                        <li>
                            <div class="list-box-listing">
                                <div class="list-box-listing-img"><a href="#">
                                    <?php if( $user->logo!=''){?>
                <img id='img-logo' src="<?php echo  URL::asset('storage/images/'.$user->logo);?>" />
                <?php } else {?>
                <img id='img-logo' style="max-height: 10px" src="<?php echo  URL::asset('storage/images/client-avatar1.png');?>"  />
                
                <?php }  ?></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{$user->titre }}</h3>
                                        <span><b>Adresse:</b> {{$user->adresse }}</span>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('UsersController@remove', $user['id'])}}" class="button gray"><i class="sl sl-icon-close"></i> Supprimer</a>
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