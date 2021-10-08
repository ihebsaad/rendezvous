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
                    <h2>Avis</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                          
                            <li>Avis</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    
                    
                    

                    <h4><i class="sl sl-icon-bubbles"></i> Avis </h4>
                     @foreach($reviews as $review)
                   <ul>

                        <li>
                            <div class="comments listing-reviews">
                                <ul>
                                    <li>
                                        <div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
                                        <div class="comment-content"><div class="arrow-comment"></div>
                                            <div class="comment-by"><?php echo UsersController::ChampById('name',$review->client).' '.UsersController::ChampById('lastname',$review->client) ;?>  <span class="date"><?php echo   date('d/m/Y H:i', strtotime($review->created_at ))  ;?></span>
                                                <div class="star-rating" data-rating="{{$review->note}}"></div>
                                            </div>
                                            <p>{{$review->commentaire}}</p>
                                            <p><b>Notes: </b>Qualité : {{$review->note_qualite}} | Service : {{$review->note_service  }} | Prix : {{$review->note_prix  }} | Emplacement : {{$review->note_emplacement  }}  </p>
                                            <a onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('reviews.remove', $review->id)}}"class="button gray reject"><i class="sl sl-icon-close"></i> Supprimer</a>
                                            
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

         
                    </ul>
                     @endforeach
                </div>
            </div>


         
        </div>

    </div>
    <!-- Content / End -->
</div>
</div>



@endsection('content')