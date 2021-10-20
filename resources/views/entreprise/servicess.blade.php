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
                            <li>Services</li>
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
        @if ($live_msg = Session::get('tterror'))
           <div class="notification error closeable">
                <p>{{ $live_msg }}</p>
                <a class="close" href="#"></a>
            </div>
            <?php Session::forget('tterror');  ?>
        @endif
        <div class="row">
           <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div>
                                <form method="post" action="{{ route('AjouterService') }}" name="AjouterService">
                                    @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input  style="float: right;margin: 10px; font-size: 40px" type="submit" class="button preview" value='+' />
                                </form>
                            
                    <h4>Service</h4>
                    
                    </div>
                    <ul>
                        <?php
 
                      foreach($services as $service){
                      ?>
                        <li>
                            <div class="list-box-listing">
  
                                <div class="list-box-listing-img"><img src="<?php if($service->thumb!=''){echo  URL::asset('storage/images/'.$service->thumb);}else{echo URL::asset('storage/images/serviceimg.jpg'); }?>"    /></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3><a href="#"><?php echo $service->nom;?></a></h3>
                                        <span><?php echo $service->description;?></span>
                                        <div >
                                            <b><?php echo $service->prix;?> €</b>
                                            <div class="rating-counter">
                                                <?php if($service->recurrent=='off'){ echo "(Simlpe)"; } 
                                                 elseif($service->recurrent=='on'){ echo "(Reccurent)"; } ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="{{url('services/modifier/'.$service->id)}}" class="button gray"><i class="sl sl-icon-note"></i> Edit</a>
                                <a onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ServicesController@remove', [ 'id'=>$service->id,'user'=> $user->id  ])}}" class="button gray"><i class="sl sl-icon-close"></i> Delete</a>

                            </div>
                        </li>
                        <?php }?>
                  

                   

                    </ul>
                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')