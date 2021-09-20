@extends('layouts.frontv2layout')

<link rel="stylesheet" type="text/css" href="{{ asset('public/fullcalendar/main.min.css') }}" />

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

 <?php  use \App\Http\Controllers\CalendrierController; ?>

<style type="text/css">
/* Show more */
a.button.border {
    color: #ffd700!important;
    border-color: #ffd700!important;
}
.booking-widget .panel-dropdown a:after {
    font-size: 20px;
    color: #ffd700!important;
    margin-left: 0;
    position: absolute;
    right: 20px;
}

.booking-widget .panel-dropdown a {
    border: none;
    font-size: 12.5px!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 6px 0px rgb(0 0 0 / 10%);
    font-weight: 800!important;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    display: block;
    width: 100%;
    transition: color 0.3s;
}
.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
    margin: 0;
    padding: 0;
    height: 49px;
    outline: 0;
    border: 0 !important;
    background: transparent !important;
    color: #888;
    line-height: normal;
    font-weight: 800!important;
    box-shadow: none;
    transition: none;
    font-size: 12.5px;
}
.chosen-container-single .chosen-default {
    font-size: 12.5px!important;
    color: #999;
    font-weight: 800!important;
}
.chosen-container-single .chosen-single div:after {
    content: "\f107";
    font-family: "FontAwesome";
    font-size: 18px;
    margin: 1px 0 0 0;
    right: 20px;
    position: relative;
    width: auto;
    height: auto;
    display: inline-block;
    color: #ffd700!important;
    float: right;
    font-weight: normal;
    transition: transform 0.3s;
    transform: translate3d(0,0,0) rotate(
0deg);
}
.booking-widget .panel-dropdown a {
    border: 1px solid #dbdbdb!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%)!important;
    font-size: 16px;
    font-weight: 600;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    display: block;
    width: 100%;
    transition: color 0.3s;
}input#date-picker2 {
    border: 1px solid #dbdbdb!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%)!important;
    font-size: 12.5px!important;
    font-weight: 800!important;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    transition: color 0.3s !important;
}
input#date-picker {
    border: 1px solid #dbdbdb!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%)!important;
    font-size: 12.5px!important;
    font-weight: 800!important;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    transition: color 0.3s !important;
}
.daterangepicker td.active.end-date.in-range.available, .qtyTotal, .mm-menu em.mm-counter, .option-set li a.selected, .category-small-box:hover, .pricing-list-container h4:after, #backtotop a, .chosen-container-multi .chosen-choices li.search-choice, .select-options li:hover, button.panel-apply, .layout-switcher a:hover, .listing-features.checkboxes li:before, .comment-by a.reply:hover, .add-review-photos:hover, .office-address h3:after, .post-img:before, button.button, input[type="button"], input[type="submit"], a.button, a.button.border:hover, table.basic-table th, .plan.featured .plan-price, mark.color, .style-4 .tabs-nav li.active a, .style-5 .tabs-nav li.active a, .dashboard-list-box .button.gray:hover, .change-photo-btn:hover, .dashboard-list-box a.rate-review:hover, input:checked + .slider, .add-pricing-submenu.button:hover, .add-pricing-list-item.button:hover, .custom-zoom-in:hover, .custom-zoom-out:hover, #geoLocation:hover, #streetView:hover, #scrollEnabling:hover, #scrollEnabling.enabled, #mapnav-buttons a:hover, #sign-in-dialog .mfp-close:hover, #small-dialog .mfp-close:hover {
    background-color: #ffd700;
    border: 1px solid #dbdbdb;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%);
}
.chosen-container-multi .chosen-choices li.search-choice .search-choice-close:before {
    content: "\f00d";
    font-family: "FontAwesome";
    font-size: 13px;
    top: 1px;
    position: relative;
    width: 11px;
    height: 5px;
    display: inline-block;
    color: #42403f!important;
    float: right;
    font-weight: normal;
}
.buttons-to-right {
    box-shadow: none;
}
.buttons-to-right, .button.to-right {
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translate3d(0,-49%,0);
    -moz-transform: translate3d(0,-50%,0);
    opacity: 0;
    transition: 0.4s;
    box-shadow: 0px 0px 10px 15px #fbfbfb;
}


.listing-details-sidebar li {
    display: block;
    padding-left: 26px;
    position: relative;
    margin-bottom: 5px;
    line-height: 24px;
    width: 155px;
}

@media (max-width: 768px) {.panel-dropdown .panel-dropdown-content, .fullwidth-filters .panel-dropdown.float-right .panel-dropdown-content {
    left: 0;
    right: auto;
    max-width: 74vw!important;
}}

.daterangepicker td.active.end-date.in-range.available, .qtyTotal, .mm-menu em.mm-counter, .option-set li a.selected, .category-small-box:hover, .pricing-list-container h4:after, #backtotop a, .chosen-container-multi .chosen-choices li.search-choice, .select-options li:hover, button.panel-apply, .layout-switcher a:hover, .listing-features.checkboxes li:before, .comment-by a.reply:hover, .add-review-photos:hover, .office-address h3:after, .post-img:before, button.button, input[type="button"], input[type="submit"], a.button, a.button.border:hover, table.basic-table th, .plan.featured .plan-price, mark.color, .style-4 .tabs-nav li.active a, .style-5 .tabs-nav li.active a, .dashboard-list-box .button.gray:hover, .change-photo-btn:hover, .dashboard-list-box a.rate-review:hover, input:checked + .slider, .add-pricing-submenu.button:hover, .add-pricing-list-item.button:hover, .custom-zoom-in:hover, .custom-zoom-out:hover, #geoLocation:hover, #streetView:hover, #scrollEnabling:hover, #scrollEnabling.enabled, #mapnav-buttons a:hover, #sign-in-dialog .mfp-close:hover, #small-dialog .mfp-close:hover {
    color: black! important;
    background-color: #ffd700;
}


.booking-widget .panel-dropdown: {
    width: 100%;
}
.booking-widget .panel-dropdown .panel-dropdown-content.padding-reset {
    width: -webkit-fill-available;
    padding: 0;
}
.fc-today-button{font-size:13px!important;}
.fc .fc-toolbar-title {
    font-size: 1.75em;
    margin: 0;
    font-size: 1.75em;
    margin: 0;
}
.fc-direction-ltr .fc-toolbar>*>:not(:first-child) {
    margin-left:0!important;
    color: black;
    border: yellow;
    border-radius: 50px;
    background-color: #f9d308;
}
.show-moreP {
	height: 450px;
	overflow: hidden;
	position: relative;
	transition: margin 0.4s;
}

.show-moreP:after {
	content:"";
	position: absolute;
	bottom: 0;
	left: 0;
	width: 100%;
	height: 180px;
	display: block;
	background: linear-gradient(rgba(255,255,255,0), #fff 88%);
	z-index: 9;
	opacity: 1;
	visibility: visible;
	transition: 0.8s;
}

.show-moreP.visible { margin-bottom: 20px; }
.show-moreP.visible:after { opacity: 0; visibility: hidden; }

.show-moreP-button {
	position: relative;
	font-weight: 600;
	font-size: 15px;
	left: 0;
	margin-left: 50%;
	transform: translateX(-50%);
	z-index: 10;
	text-align: center;
	display: inline-block;
	opacity: 1;
	visibility: visible;
	transition: all 0.3s;
	padding: 5px 20px;
	color: #666;
	background-color: #f2f2f2;
	border-radius: 50px;
	top: -10px;
	min-width: 140px;
}

.show-moreP-button:before { content: attr(data-more-title); }
.show-moreP-button.active:before { content: attr(data-less-title); }

.show-moreP-button i {
	margin-left: 6px;
	color: #66676b;
	font-weight: 500;
	transition: 0.2s;
}

.show-moreP-button.active i {
	transform: rotate(180deg);
}

/**show button */ 
a.button.border {
    border-color: #ffd700!important;
}
.fc .fc-button-group {
    position: relative;
    display: initial;
    font-size: small;
}
.fc .fc-scroller-harness-liquid {
    height: 100%;
}
.fc .fc-non-business {
background-color:<?php echo \App\Http\Controllers\CalendrierController::$fermeture_couleur ; ?>;
}
.fc-view-harness .fc-view-harness-active{
        /* flex-grow: 1; */
        position: relative;
    height: 409px !important;

}
.fc-view-harness-active>.fc-view {

    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: lightgray;
}
.modal-fullscreen {
    width: 100vw;
    max-width: none;
    height: 100%;
    margin: 0;
}


.fc .fc-scrollgrid-liquid {
    background: lightgray;
    
    
    height: 496px;}



#wrapper {
    background-color: #fff!important;
}
.listing-nav-container.cloned .listing-nav {
    padding-top: 20px;
}

video {
        width: 100%;
        height: auto;
        }
.video-responsive { 
overflow:hidden; 
padding-bottom:56.25%; 
position:relative; 
height:0;
}
.video-responsive iframe {
left:0; 
top:0; 
height:100%;
width:100%;
position:absolute;
}

.listing-details-sidebar li a.instagram-profile i, .listing-details-sidebar li a.instagram-profile {
    color: #e1306c;
}

.like-button .like-icon {
    color: #ff0000!important;
}

.listing-desc-headline {
    font-weight: 500;
}

table.basic-table th {
    background-color: #f2f2f2!important;
    color: #464646!important;    
}

 .utf_listing_section {
    display: inline-block;
    width: 100%;
}
 #utf_single_listing_map_block {
    height: 410px;
    position: relative;
    padding-top: 5px;
    display: block;
}
  #utf_single_listingmap {
    height: 400px;
    border-radius: 3px;
}
.gm-style {
    font: 400 11px Roboto, Arial, sans-serif;
    text-decoration: none;
}
.gm-style-pbc {
    transition: opacity ease-in-out;
    background-color: rgba(0,0,0,0.45);
    text-align: center;
}
#utf_street_view_btn, #geoLocation, #scrollEnabling {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 999;
    font-size: 13px;
    line-height: 21px;
}
#utf_street_view_btn, #geoLocation, #scrollEnabling, #mapnav-buttons a {
    color: #333;
    background-color: #fff;
    padding: 7px 18px;
    padding-top: 9px;
    font-weight: 500;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -transition: all 0.2s ease-in-out;
    box-sizing: border-box;
    display: inline-block;
    border-radius: 4px;
    box-shadow: 0px 1px 4px -1px rgb(0 0 0 / 20%);
}

#map {
  height: 100%;
}

/* time slot selector */
.tab-content {
    padding: 20px 0px!important;
}
.panel-dropdown.active .panel-dropdown-content {
    z-index: 1000!important;
}
.panel-dropdown .time-slots-dropdown:active {
    z-index: 1000!important;
    height:200px;
}
@media (max-width: 1024px) {
    .pricing-list-container span {
        right: -40px!important;
    }
}
</style>
 @section('content')
  <?php  //$User= auth()->user();

   if (auth()->guest()) {
    //return redirect('/connexion');
    $User=0;
   }
   else
   {
       $User= auth()->user();
       $User=$User->id;

   }
 

  $images = \App\Image::where('user',$user->id)->get();
  $nbimages =count($images );
  if( $nbimages>0){

 ?>
<div class="clearfix"></div>
@if ($live_message = Session::get('ErrorMessage'))
           <div class="notification error closeable">
                <p>{{ $live_message }}</p>
                <a class="close" href="#"></a>
            </div>
            <?php Session::forget('ErrorMessage');  ?>
        @endif
    
<!-- Slider
================================================== -->
<div class="listing-slider mfp-gallery-container margin-bottom-0">
    <?php $i=0; foreach($images as $image){ $i++;?>
            
 <a href="<?php echo  URL::asset('storage/images/'.$image->thumb);?>"  style="width:100%;"class="item mfp-gallery" title="{{$user->titre}}"><img src="<?php echo  URL::asset('storage/images/'.$image->thumb);?>"  style="    width: -webkit-fill-available;
    height: -webkit-fill-available;"/></a>
    <?php } ?>
</div>

<?php  } ?>  


<!-- Content
================================================== -->
<?php 
        $reviews= \App\Review::where('prestataire',$user->id)->get();
        $countrev= count($reviews);
          $moy=$moy_qualite=$moy_service=$moy_prix=$moy_emplacement=$moy_espace=0;
        $total=0; $total_qualite=$total_service=$total_prix=$total_emplacement=$total_espace=0;
        if($countrev>0){
        
        foreach( $reviews as $review)
        {
            $total=$total+($review->note);
            $total_qualite=$total_qualite+($review->note_qualite);
            $total_service=$total_service+($review->note_service);
            $total_prix=$total_prix+($review->note_prix);
            $total_espace=$total_espace+($review->note_espace);
            $total_emplacement=$total_emplacement+($review->note_emplacement);
             
        }
        
        $moy=$total/$countrev; 
        $moy_qualite=$total_qualite/$countrev; 
        $moy_service=$total_service/$countrev; 
        $moy_prix=$total_prix/$countrev; 
        $moy_espace=$total_espace/$countrev; 
        $moy_emplacement=$total_emplacement/$countrev; 
        }
?>
<div class="container">
    <div class="row sticky-wrapper">
        <div class="col-lg-8 col-md-8 padding-right-30">

            <!-- Titlebar -->
            <div id="titlebar" class="listing-titlebar">
                <div class="listing-titlebar-title">
                    <h2>{{$user->titre}} <!--<span class="listing-tag">Eat & Drink</span>--></h2>
                    <span>
                        <a href="#listing-location" class="listing-address">
                            <i class="fa fa-map-marker"></i>
                            {{$user->adresse}}<?php if (!empty($user->codep)) { ?>, {{$user->codep}}<?php } ?><?php if (!empty($user->ville)) { ?>, {{$user->ville}}<?php } ?>
                        </a>
                    </span>
                    <?php if(  $countrev  >0 ){?> 
                        <div class="star-rating" data-rating="<?php echo $moy; ?>">
                            <div class="rating-counter"><a href="#listing-reviews"><b><?php echo $moy; ?></b> (<?php echo $countrev; ?> Avis)</a></div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Listing Nav -->
            <div id="listing-nav" class="listing-nav-container">
                <ul class="listing-nav">
                    <li><a href="#listing-overview" class="active">Présentation</a></li>
                    <?php 

                        $services =\App\Service::where('user',$user->id)->where('recurrent','off')->get();
                        $servicesreccurent =\App\Service::where('user',$user->id)->where('recurrent','on')->get(); 
                        $nbserv =count($services );
                        $nbservrec =count($servicesreccurent );
                        if (( $nbserv>0) || ( $nbservrec>0)){

                    ?>
                    <li><a href="#listing-pricing-list">Services</a></li>
                <?php } ?>
                    <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  
                            $nbhh =count($happyhours );
                            if ($nbhh > 0)
                            {
                    ?>
                    <li><a href="#listing-promotion-list">Promotions flash</a></li>
                    <?php }} ?>
                    <li><a href="#listing-location">Emplacement</a></li>
                    <li><a href="#listing-reviews">Avis</a></li>
                    <li><a href="#add-review">Ajoutez votre avis</a></li>
                </ul>
            </div>
            
            <!-- Overview -->
            <div id="listing-overview" class="listing-section">

                <!-- Description -->

                <p>{{$user->description}}</p>
                
                
                <!-- Listing Contacts -->
                <div class="listing-links-container">

                    <ul class="listing-links contact-links">
                        <li><a href="tel:{{$user->tel}}" class="listing-links"><i class="fa fa-phone"></i> {{$user->tel}}</a></li>
                        <li><a href="mailto:{{$user->email}}" class="listing-links"><i class="fa fa-envelope-o"></i> {{$user->email}}</a>
                        </li>
                        <!--<li><a href="#" target="_blank"  class="listing-links"><i class="fa fa-link"></i> www.example.com</a></li>-->
                    </ul>
                    <div class="clearfix"></div>

                    <ul class="listing-links">
                        <?php if (!empty($user->fb)) { ?>
                        <li>
                            <a href="{{$user->fb}}" target="_blank" class="listing-links-fb"><i class="fa fa-facebook-square"></i> Facebook</a>
                        </li>
                        <?php } ?>
                        <?php if (!empty($user->instagram)) { ?>
                        <li>
                            <a href="{{$user->instagram}}" target="_blank" class="listing-links-ig"><i class="fa fa-instagram"></i> Instagram</a>
                        </li>
                        <?php } ?>
                        <?php if (!empty($user->twitter)) { ?>
                        <li>
                            <a href="{{$user->twitter}}" target="_blank" class="listing-links-tt"><i class="fa fa-twitter"></i> Twitter</a>
                        </li>
                        <?php } ?>
                        <!--<li><a href="#" target="_blank" class="listing-links-yt"><i class="fa fa-youtube-play"></i> YouTube</a></li>-->
                    </ul>
                    <div class="clearfix"></div>

                </div>
                <div class="clearfix"></div>
      <?php if($user->video != '' )
      {   ?> 
            <h3 class="listing-desc-headline">Vidéo</h3>
                <video width="450" height="320" controls>
                <source src="<?php echo  URL::asset('storage/images/'.$user->video);?>" type="video/mp4">
                Votre navigateur ne supporte pas l'affichage de cette video.
                </video>            
        
      <?php }  ?>
          <?php if($user->codevideo != '' )
      {   ?>   
      <section>
        <div id="utf_listing_video" class="utf_listing_section" style="max-width:700px">
          <h3 class="listing-desc-headline">Vidéo</h3>
          <div class="video-responsive">
          <?php echo $user->codevideo ;?>
          </div>
         </div>   
    </section>
      <?php } ?>  
                <?php   $categories_user = \DB::table('categories_user')->where('user',$user->id)->get(); 
                        $nbcats =count($categories_user );

                        if( $nbcats>0){
                ?>
                <!-- categories -->
                <h3 class="listing-desc-headline">Catégories</h3>
                <ul class="listing-features checkboxes margin-top-0">
                    <?php  foreach($categories_user as $cat){   $categorie =\App\Categorie::find( $cat->categorie);  
                    if(isset($categorie)){  echo '   <li>'.$categorie->nom .'</li>'; }
                        }
                    ?>
                </ul>
                <?php } ?>
            </div>


            <!-- services Menu -->
            <?php

                    if (( $nbserv>0) || ( $nbservrec>0)){
            ?>
            <div id="listing-pricing-list" class="listing-section">
                <h3 class="listing-desc-headline margin-top-70 margin-bottom-30">Services</h3>

                <div class="show-more">
                    <div class="pricing-list-container">
                        <?php if ( $nbserv>0) { ?>
                        <!-- simple List -->
                        <ul>
                            <?php foreach ($services as $service)
                            { ?>
                            <li>
                            <div class="row" >
                                    <div class="col-6 col-lg-6">
                                <?php if($service->thumb!=''){ echo '<a href="'. URL::asset('storage/images/'.$service->thumb).'" data-lightbox="photos"><img src="'. URL::asset('storage/images/'.$service->thumb).'"  style="width:140px;height:100px; margin-bottom:15px;"  /> </a>'; }?>
                                    </div>
                                    <center><div class="col-6 col-lg-6">
                                <span style="width: 71px;margin-top: 9px;">{{ $service->prix }} €</span>
                                    </div></center>
                                </div>
                                <div class="row" style="    margin-left: 0px;">
                                <h5>{{ $service->nom }}</h5>
                                <p style="text-align: justify;">{{ $service->description }}</p>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>

                        <?php if ( $nbservrec>0) { ?>
                        <!-- abonnement List -->
                        <h4>Services à abonnement</h4>
                        <ul>
                            <?php foreach ($servicesreccurent as $servicerec)
                            { ?>
                            <li> <div class="row" >
                                    <div class="col-6 col-lg-6">
                                    <?php if($servicerec->thumb!=''){ echo '<a href="'. URL::asset('storage/images/'.$servicerec->thumb).'" data-lightbox="photos"><img src="'. URL::asset('storage/images/'.$servicerec->thumb).'"  style="width:140px;height:100px; margin-bottom:15px;"  /> </a>'; }?>
                                    </div>
                                    <center><div class="col-6 col-lg-6">
                                <span style="width: 71px;margin-top: 9px;">{{ $servicerec->prix }} €</span>
                                    </div></center>
                                </div>
                                <div class="row" style="    margin-left: 0px;">
                                <h5>{{ $servicerec->nom }}</h5>
                                <p style="text-align: justify;">{{ $servicerec->description }}</p>
                                </div>

                               
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>

                    </div>
                </div>
                <a  class="show-more-button" data-more-title="Afficher plus" data-less-title="Afficher moins"><i class="fa fa-angle-down"></i></a>
            </div>
            <!-- services Menu / End -->
        <?php } ?>
        <!-- boutique Menu -->
        <?php if($user->section_product=='active'){ ?>
            <?php
            if(($user->type_abonn_essai &&  $user->type_abonn_essai=="type3" )|| ($user->type_abonn &&  $user->type_abonn=="type3" )) {
                    $nbprods = count($produit);
                    if ( $nbprods>0){
            ?>
            <div id="listing-pricing-list" class="pending-booking">
                <h3 class="listing-desc-headline margin-top-70 margin-bottom-30">Boutique</h3>

                <div class="show-moreP" id="one">
                    <div class="pricing-list-container">
                        <?php if ( $nbserv>0) { ?>
                        <!-- simple List -->
                        <ul>
                            <?php foreach ($produit as $prod)
                            { ?>
                            <li>
                            <div class="row" >
                                    <div class="col-6 col-lg-6">
                                    <?php if($prod->image!=''){ echo '<a href="'.URL::asset('storage/images/'.$prod->image).'" data-lightbox="photos"><img src="'. URL::asset('storage/images/'.$prod->image).'"  style="width:140px;height:100px; margin-bottom:15px;"  /> </a>'; }?>
                                    </div>
                               <center>  <div class="col-6 col-lg-6">
                                <span style="width: 71px;margin-top: 9px;">{{$prod->prix_unité}} €</span>
                                    </div></center>
                                    <div  class="col-md-5 col-sm-6 ">
                                <a href="" class="button border " style=" margin-top: 49px;
    color: #808080bd!important;
    border-color: #808080bd!important;   margin-top: 49px;">Réserver</a>
                           </div>
                                </div>
                                <div class="row" style="    margin-left: 0px;">
                                <h5>{{$prod->nom_produit}}</h5>
                                <p style="text-align: justify;">{{ $prod->description }}</p>
                            
                           
                                
                                
                            </div>

    
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>

                    </div>
                </div>
                <a class="show-moreP-button" data-more-title="Afficher plus" data-less-title="Afficher moins"><i class="fa fa-angle-down"></i></a>
            </div>
           
            <!-- boutique Menu / End -->
        <?php }} ?><?php } ?>
        <!-- heures creuses /happy hours Menu  -->
        <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  
                $nbhh =count($happyhours );
                if ($nbhh > 0)
                {
            ?>
            <div class="row"  id="listing-promotion-list">
        
            <div class="col-md-12">

                <h4 class="listing-desc-headline margin-top-70 margin-bottom-30">Promotions flash</h4>
                <table class="basic-table">

                    <tbody><tr>
                        <th>Date</th>
                        <th>Réduction</th>
                        <th>Places</th>
                    </tr>
                     <?php $x=0; foreach($happyhours as $happyhour){ $x=$x+1 ; 
                          $dateF = new DateTime($happyhour->dateFin);
                          $aujour= new DateTime();
                     ?>
                    <tr>
                        <td data-label="Date"><b>De</b> <?php $dateDebut = new DateTime($happyhour->dateDebut); echo $dateDebut->format('d-m-Y H:i') ; ?> <b>à</b> <?php $dateFin = new DateTime($happyhour->dateFin); echo $dateFin->format('d-m-Y H:i') ; ?></td>
                        <td data-label="Réduction">{{$happyhour->reduction}}%</td>
                        <td data-label="Places">{{$happyhour->places}}</td>
                    </tr>
                    <?php } ?>
                </tbody></table>
            </div>

        </div>

        <?php }} ?>
        

        <!-- heures creuses /happy hours Menu / End -->
            <!-- FAQ prestataire -->
            <?php 
                    $faqs =\App\Faq::where('user',$id)->get();
                    $countfaq = count($faqs);
                    if ($countfaq > 0 ) {
            ?>
            <section>
                <h3 class="listing-desc-headline">FAQ</h3>

                            <div class="style-2 ">
                                @foreach($faqs as $pfp)
                                <!-- Toggle 1 -->
                                <div class="toggle-wrap">
                                    <span class="trigger"><a href="#">{{$pfp->question}}<i class="sl sl-icon-plus"></i></a></span>
                                    <div class="toggle-container" style="display: none;">
                                        <p><?php echo $pfp->reponse; ?></p>
                                    </div>
                                </div>
                                @endforeach
                            </div>

            </section>
                    <?php } ?>
            <!-- Location -->
            <div id="listing-location" class="listing-section">
                <h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Emplacement</h3>

                    <div id="utf_listing_location" class="utf_listing_section">
                        <div id="utf_single_listing_map_block">
                        <div id="utf_single_listingmap" data-latitude="{{ $user->latitude }}" data-longitude="{{ $user->longitude }}" data-map-icon="im im-icon-Marker"></div>
                        <!--<a href="#" id="utf_street_view_btn">Vue de rue</a> -->
                        </div>
                    </div>
            </div>
                
            <!-- Reviews -->
            <div id="listing-reviews" class="listing-section">
                <h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Avis <span>(<?php echo $countrev;?>)</span></h3>

                <!-- Rating Overview -->
                <div class="rating-overview">
                    <div class="rating-overview-box">
                        <span class="rating-overview-box-total"><?php echo $moy;?></span>
                        <span class="rating-overview-box-percent">de 5.0</span>
                        <div class="star-rating" data-rating="<?php echo $moy;?>"></div>
                    </div>

                    <div class="rating-bars">
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Qualité <!--<i class="tip" data-tip-content="Quality of customer service and attitude to work with you"></i>--></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="<?php echo $moy_qualite ; ?>">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong><?php echo $moy_qualite ; ?></strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Service <!--<i class="tip" data-tip-content="Overall experience received for the amount spent"></i>--></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="<?php echo $moy_service ; ?>">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong><?php echo $moy_service ; ?></strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Prix <!--<i class="tip" data-tip-content="Visibility, commute or nearby parking spots"></i>--></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="<?php echo $moy_prix ; ?>">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong><?php echo $moy_prix ; ?></strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Emplacement <!--<i class="tip" data-tip-content="The physical condition of the business"></i>--></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="<?php echo $moy_emplacement ; ?>">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong><?php echo $moy_emplacement ; ?></strong>
                                </span>
                            </div>
                    </div>
                </div>
                <!-- Rating Overview / End -->


                <div class="clearfix"></div>
                <?php if ($countrev > 0) { ?>
                <!-- Reviews -->
                <section class="comments listing-reviews">
                    <ul>
                        <?php  foreach( $reviews as $review)
                        { $cl =$review->client; $client=\App\User::where('id',$cl)->first();
                            $name=$lastname='';
                        if(isset($client->name)){$name=$client->name;}if(isset($client->lastname)){$lastname=$client->lastname;}
                        ?>
                        <li>
                            <?php if (isset($client->logo) && $client->logo!=''){ ?>
                                  <div class="avatar"><img src="<?php echo  URL::asset('storage/images/'.$client->logo);?>"  alt="" /></div> 
                             <?php }else{ ?>
                              <div class="avatar"><img   src="<?php echo  URL::asset('public/images/client-avatar1.png');?>" alt="" /></div> 
                  
                             <?php } ?>
                            <div class="comment-content"><div class="arrow-comment"></div>
                                <div class="comment-by"><?php  echo $name.' '.$lastname ; ?> <i class="tip" data-tip-content="La personne qui a laissé cet avis était en fait un client"></i> <span class="date"><?php $datec= date('d/m/Y H:i', strtotime($review->created_at )); echo $datec ; ?></span>
                                    <div class="star-rating" data-rating="<?php echo intval($review->note);?>"></div>
                                </div>
                                <p><?php echo $review->commentaire; ?></p>
                            </div>
                        </li>
                        <?php } ?>
                       
                     </ul>
                </section>
                <?php } ?>
                <!-- Pagination 
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pagination-container margin-top-30">
                            <nav class="pagination">
                                <ul>
                                    <li><a href="#" class="current-page">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                Pagination / End -->
            </div>

            <?php if (isset($user)) { ?>
            <!-- Add Review Box -->
            <div id="add-review" class="add-review-box"   >
                
                <!-- Add Review -->
                <h3 class="listing-desc-headline margin-bottom-10">Ajouter votre Avis</h3>
                <p class="comment-notes">Votre adresse email ne sera pas publiée.</p>
                <!-- Subratings Container -->
                <div class="sub-ratings-container">
                    <!-- Subrating #hidden -->
                    <div class="add-sub-rating" style="display: none;">
                        <div class="sub-rating-title">hidden to fix style <i class="tip" data-tip-content="Quality of service"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                                <input type="radio" name="rating" id="rating-001" value="1"/>
                            </form>
                        </div>
                    </div>

                    <!-- Subrating #1 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Qualité <i class="tip" data-tip-content="Noter la qualité de votre experience"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <form class="leave-rating">
                                <input type="radio" name="rating" id="rating-1" value="1" onclick="document.getElementById('note_qualite').value='5';"/>
                                <label for="rating-1" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-2" value="2" onclick="document.getElementById('note_qualite').value='4';" />
                                <label for="rating-2" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-3" value="3" onclick="document.getElementById('note_qualite').value='3';" />
                                <label for="rating-3" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-4" value="4" onclick="document.getElementById('note_qualite').value='2';" />
                                <label for="rating-4" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-5" value="5" onclick="document.getElementById('note_qualite').value='1';" />
                                <label for="rating-5" class="fa fa-star"></label>
                            </form>
                        </div>
                    </div>

                    <!-- Subrating #2 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Service <i class="tip" data-tip-content="Noter la qualité du service"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <div class="clearfix"></div>
                            <form class="leave-rating">
                                <input type="radio" name="rating" id="rating-11" value="1" onclick="document.getElementById('note_service').value='5';" />
                                <label for="rating-11" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-12" value="2" onclick="document.getElementById('note_service').value='4';" />
                                <label for="rating-12" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-13" value="3" onclick="document.getElementById('note_service').value='3';" />
                                <label for="rating-13" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-14" value="4" onclick="document.getElementById('note_service').value='2';" />
                                <label for="rating-14" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-15" value="5" onclick="document.getElementById('note_service').value='1';" />
                                <label for="rating-15" class="fa fa-star"></label>
                            </form>
                        </div>
                    </div>

                    <!-- Subrating #3 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Prix <i class="tip" data-tip-content="Noter les prix du prestataire"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <div class="clearfix"></div>
                            <form class="leave-rating">
                                <input type="radio" name="rating" id="rating-21" value="1" onclick="document.getElementById('note_prix').value='5';" />
                                <label for="rating-21" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-22" value="2" onclick="document.getElementById('note_prix').value='4';" />
                                <label for="rating-22" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-23" value="3" onclick="document.getElementById('note_prix').value='3';" />
                                <label for="rating-23" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-24" value="4" onclick="document.getElementById('note_prix').value='2';" />
                                <label for="rating-24" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-25" value="5" onclick="document.getElementById('note_prix').value='1';" />
                                <label for="rating-25" class="fa fa-star"></label>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Subrating #4 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Emplacement <i class="tip" data-tip-content="Noter l'emplacement du prestataire"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <div class="clearfix"></div>
                            <form class="leave-rating">
                                <input type="radio" name="rating" id="rating-31" value="1" onclick="document.getElementById('note_emplacement').value='5';" />
                                <label for="rating-31" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-32" value="2" onclick="document.getElementById('note_emplacement').value='4';" />
                                <label for="rating-32" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-33" value="3" onclick="document.getElementById('note_emplacement').value='3';" />
                                <label for="rating-33" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-34" value="4" onclick="document.getElementById('note_emplacement').value='2';" />
                                <label for="rating-34" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-35" value="5" onclick="document.getElementById('note_emplacement').value='1';" />
                                <label for="rating-35" class="fa fa-star"></label>
                            </form>
                        </div>
                    </div>  


                </div>
                <!-- Subratings Container / End -->
                <form action="{{ route('reviews.add') }}" method="post"  >
                      {{ csrf_field() }} 
                      <input type="hidden" id="prestataire" name="prestataire" value="<?php echo $user->id;?>">
                      <input type="hidden" id="note_qualite" name="note_qualite">
                      <input type="hidden" id="note_service" name="note_service">
                      <input type="hidden" id="note_prix" name="note_prix">
                      <input type="hidden" id="note_emplacement" name="note_emplacement">
                <!-- Review Comment -->
                    <fieldset>
                        <?php if (isset($user)){?>  <input type="hidden" id="client" name="client" value="<?php echo $User; ?>" ><?php } ?>
                        <!--<div class="row">
                            <div class="col-md-6">
                                <label>Name:</label>
                                <input type="text" value=""/>
                            </div>
                                
                            <div class="col-md-6">
                                <label>Email:</label>
                                <input type="text" value=""/>
                            </div>
                        </div>-->

                        <div>
                            <label>Commentaire:</label>
                            <textarea cols="40" placeholder="Votre Commentaire..." rows="3" name="commentaire" id="commentaire"></textarea>
                        </div>

                    </fieldset>

                    <button class="button"  id="sendavis" type="submit" value="Envoyer" style="margin-top: 15px;">Envoyer</button>
                    <div class="clearfix"></div>
                </form>

            </div>
            <!-- Add Review Box / End -->
            <?php } ?>

        </div>


        <!-- Sidebar
        ================================================== -->
        <div class="col-lg-4 col-md-4 margin-top-75 sticky">

                
            <!-- Verified Badge -->
            <!--<div class="verified-badge with-tip" data-tip-content="Listing has been verified and belongs the business owner or manager.">
                <i class="fa  fa-calendar"></i> Calendrier du prestataire
            </div>-->
            <button id="kbs" type="button" class="btn " style="    background:black;color:white;font-size: 15px;       width: -webkit-fill-available;;height: 62px;" data-toggle="modal" data-target="#calendrier_prestataire">
                <i class="fa  fa-calendar"></i> Consulter notre calendrier </button>
                <script>  $("#kbs").click(function(){
    $("#calendrier_prestataire").show();
});

$( document ).ready(function() {
       
       var initialLocaleCode = 'fr';
       var localeSelectorEl = document.getElementById('locale-selector');
       var calendarEl = document.getElementById('calpres');
       var calendar = new FullCalendar.Calendar(calendarEl, {
         headerToolbar: {
           left: 'prev,next today',
           center: 'title',
   
           right: 'timeGridWeek,dayGridMonth,timeGridDay' //listMonth
   
         },
         
         locale: initialLocaleCode,
         initialView:'timeGridWeek',
         buttonIcons: false, // show the prev/next text
         weekNumbers: true,
         navLinks: true, // can click day/week names to navigate views
         editable: false,
         dayMaxEvents: true, // allow "more" link when too many events
         businessHours: <?php echo \App\Http\Controllers\CalendrierController::ouverture_fermeture_horaire($user->id); ?>,
         
         events:<?php echo \App\Http\Controllers\CalendrierController::indisponibilte_rendezvous_horaire($user->id); ?>
       });
       calendar.render();
       $('#calendrier_prestataire').on('shown.bs.modal', function () {
        calendar.fullCalendar('render');

});


});$('#kbs').click(function() {
        window.setTimeout(clickToday, 200);
    });

    function clickToday() {
      $('.fc-timeGridWeek-button').click();
    }
</script>

  <!-- The Modal -->
  <div class="modal  fade" id="calendrier_prestataire" style="display:none;" >
    <div class="modal-dialog modal-fullscreen" >
      <div class="modal-content" style="height:100%;    overflow-y: auto;">
      
        <!-- Modal Header -->
        <center> <button onclick="myFunction()"  class="button book-now fullwidth margin-top-5" style="    width: 212px! important;"><i class="fa fa-angle-down" aria-hidden="true"></i>
</button></center>

        <div class="modal-header"   >


<script>function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}</script>
        <div id="myDIV" style="display:none;">
 <style>.legend { list-style: none; margin-left:10px;}
    .legend li { float: left; margin-right: 15px;}
    .legend span { border: 1px solid #ccc; float: left; width: 10px; height: 12px; margin: 2px; }</style>
<script src="//bootstrap-notify.remabledesigns.com/js/bootstrap-notify.min.js"></script>
          <h4 class="modal-title" style="font-size: 17px;" >Calendrier du prestataire</h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <div id="legendcolor"  style="background-color:white; top:5px;"> 
            <ul class="legend">
            <style>  .legend .lightgrey { background-color: lightgrey;}
    .legend .brown { background-color: #9fec9f; }
    .legend .blue { background-color: #ecba99; }
    .legend .red{ background-color: #ec7878; }
    .legend .green{ background-color:#ead831; }
    .legend .pink{ background-color:#d3c07b; }</style>
              <li><span class="lightgrey" ></span>horaires de fermeture</li>
             <li><span class="green"></span>Happy hours</li>
              <li><span class="red"></span>Indisponibilité de prestataire</li>
             <li><span class="brown"></span>Rendez-vous d'un service confirmé (Possibilité de réservation de le même service à la même date)</li>
            
             <li><span class="blue"></span>Rendez-vous d'un service confirmé (Pas de réservation de le même service à la même date)</li>
             <li><span class="pink"></span>date courante</li>
           </ul>

           </div>
        </div>        <button type="button" class="close" style="color:red;width:40px;font-size: 50px;    padding-right: 61px;    margin-top: -64px;" data-dismiss="modal">&times;</button>
</div>
        
        <!-- Modal body -->
        <div class="modal-body" style="border:solid ; border-color:lightgrey;       height: 555px;
    overflow-y: hidden;
    overflow-x: hidden;
" >
        	<style scoped>

            @media (max-width: 768px) {
                .modal-content{    height: 100%;
    overflow-y: scroll;
    overflow-x: scroll;
    width: auto;}
                .calpresk { 
                  font-size: 10px;
                  height: inherit;
                  overflow-y: hidden;
               
                }
                modal-body{border: solid;
    width: 673px;
    border-color: lightgrey;
    height: 555px;
    overflow-y: auto;
    overflow-x: auto;}
            
               
            }
         
           </style>
           
         
         <div id="calpres" class="calpresk"> </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer"  style="background-color: lightgrey;">
          <button type="button"  style="font-size: 14px;
    width: 156px;"  class="button book-now fullwidth margin-top-5" data-dismiss="modal">Fermer</button>
        </div>
        
      </div>
    </div>
  </div>

            <!-- Book Now -->
            
            <div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-35" style="height: fit-content;;">
                <a><h3><i class="fa fa-calendar-check-o "></i> Réserver un service</h3></a>
                
                <div class="row with-forms  margin-top-0">

                    <!-- les scripts des offres de reduction -->
                    <input type="number" value="{{$reduction}}" name="" hidden id="catrefideliteVal" >
                      <?php if($reduction != 0){  ?> 
                      <p style="color: #c7a903;font-size: 14px; line-height: 16px;"><i class="sl sl-icon-present"></i> Félicitation! Vous bénéficierez pour la prochaine réservation d'<b>une réduction de {{$reduction}}%</b></p>
                      <?php } ?>
                      <?php if($myhappyhours != null) { echo '<input type="number" happyhourid="'.$myhappyhours->id.'" value="'.$myhappyhours->reduction.'" id="myhappyhoursId" name="" hidden>' ;  }
                             else {  echo '<input type="number" happyhourid="0" value="0" id="myhappyhoursId" name="" hidden>'; } ?>
                    <!-- FIN // les scripts des offres de reduction -->

                    <!----------------------------------- Nav tabs --------------------------------------------->
                    <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) == 0)  { echo ' 
</style><p style=" font-size: 14px; line-height: 16px;">Le prestataire ne dispose encore des services </p>

<div class="tabs-container" style="display:none;">
                <div id="home" class="tab-content" style="display:none;>'  ;                 
                   }?>

         <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {
                        # code...
            echo '<p style=" font-size: 14px; line-height: 16px;">Veuillez sélectionner "Abonnement", si vous désirez réserver un service récurrent</p>
                      
              <ul class="tabs-nav" >
                <li class="active">
                  <a href="#home">Service simple</a>
                </li>
                <li class="">
                  <a  href="#menu1">Abonnement</a>
                </li>
                
              </ul>
            <!-- Tab panes -->
              <div class="tabs-container">
                <div id="home" class="tab-content">';
                } ?>
                <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) != 0) {
                               # code...
                   echo '
                             
                     
                       
                   
                   <!-- Tab panes -->
                     <div class="tabs-container">
                       <div id="home" class="tab-content">';
                       } ?>
                          <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) == 0) {
                               # code...
                   echo '
                             
                     
                   <!-- Tab panes -->
                     <div class="tabs-container">
                       <div id="home" class="tab-content" style="display:none;">';
                       } ?>

                        <div class="col-lg-12">
                        <select class="chosen-select-no-single" id="service" name="service[]"  multiple style="font-weight: 17px !important; "data-placeholder="Sélectionner le(s) service(s) desiré(s)" >
                                <?php 
                                foreach($services as $service){
                                    echo '<option  style="font-weight: 17px;" value="'.$service->id.'"  prix="'.$service->prix.'">'.$service->nom.'</option>'; 
                        
                        $mab[$service->id]=$service->produits_id ;
                                }
                                
                                ?>
                                
                                <meta type="hidden" name="csrf-token" content="{{ csrf_token() }}" />

                            </select>
                        </div>
                    <!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
                    <div class="col-lg-12">
                    <input type="text" id="date-picker" placeholder="Date" readonly="readonly">

                    </div>

                    <!-- Panel Dropdown -->
                    <div class="col-lg-12" style="    height: fit-content;">
                        <div class="panel-dropdown time-slots-dropdown">
                            <a href="#">Heure</a>
                            <div class="panel-dropdown-content padding-reset">
                                <div class="panel-dropdown-scrollable">
                                    <div  style="height:200px!important;">
                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <input type="radio" name="time-slot" id="time-slot-1">
                                        <label for="time-slot-1">
                                            <strong>8:30 am - 9:00 am</strong>
                                            <span>1 slot available</span>
                                        </label>
                                    </div>

                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <input type="radio" name="time-slot" id="time-slot-2">
                                        <label for="time-slot-2">
                                            <strong>9:00 am - 9:30 am</strong>
                                            <span>2 slots available</span>
                                        </label>
                                    </div>

                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <input type="radio" name="time-slot" id="time-slot-3">
                                        <label for="time-slot-3">
                                            <strong>9:30 am - 10:00 am</strong>
                                            <span>1 slots available</span>
                                        </label>
                                    </div>

                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <input type="radio" name="time-slot" id="time-slot-4">
                                        <label for="time-slot-4">
                                            <strong>10:00 am - 10:30 am</strong>
                                            <span>3 slots available</span>
                                        </label>
                                    </div>

                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <input type="radio" name="time-slot" id="time-slot-5">
                                        <label for="time-slot-5">
                                            <strong>13:00 pm - 13:30 pm</strong>
                                            <span>2 slots available</span>
                                        </label>
                                    </div>

                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <input type="radio" name="time-slot" id="time-slot-6">
                                        <label for="time-slot-6">
                                            <strong>13:30 pm - 14:00 pm</strong>
                                            <span>1 slots available</span>
                                        </label>
                                    </div>

                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <input type="radio" name="time-slot" id="time-slot-7">
                                        <label for="time-slot-7">
                                            <strong>14:00 pm - 14:30 pm</strong>
                                            <span>1 slots available</span>
                                        </label>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Panel Dropdown / End -->
                    <div class="col-lg-12 ">
                        <!--  <div class="row" style="padding-left:40px">Rappel de mon rendez vous par SMS</div> -->
                      
                        <select class="chosen" id="rappel">

                        <option label="blank" >Rappel de rendez vous par SMS</option>
                        <option value="60">1h avant le RDV </option>
                         <option value="120">2h avant le RDV</option>
                      	 <option value="180">3h avant le RDV</option>
                          <option value="1440">1 jour avant le RDV</option>
                        <option value="2880">2 jours avant le RDV</option>
                         <option value="7200">5 jours avant le RDV</option>
                        </select>
                       
                    </div>
                    <div class="col-lg-12 col-md-12 "  id="listProduits" style="margin-top: 15px;" >
                    <div class="day-slots">
                    <div class="day-slot-headline" style="       color: black;width: 252px;"> Produits:</div>
                    <div id="sectionproduitsup" class="input-group input-group-lg" style="height: 153px;
    width: 253px;
    overflow-y: auto;
    overflow-x: hidden;
    vertical-align: middle;
    border: 1px solid #54524800;    box-shadow: 0 9px 2px 0px rgb(0 0 0 / 11%); "  >
                    <!-- Slot For Cloning / Do NOT Remove-->
                    <?php  foreach($produit as $prod){ ?>
                    <div class="single-slot">
                            <div class="single-slot-left">
                                <div class="single-slot-time"><img src="<?php echo  URL::asset('storage/images/'.$prod->image);?>"   style=" max-width:  44px  ;width: 44px;"/>{{$prod->nom_produit}} </div>
                                <div class="single-slot-time"> {{$prod->prix_unité}} €</div>
                            </div>

                            <div class="single-slot-right">
                            <button class="remove-slot" style="margin-left: 51px;"><i class="fa fa-close"></i></button>
<br>
                                <strong>Quantité:</strong>
                                <div class="plusminus horiz">
                                    <button></button>
                                    <input type="number" name="slot-qty" value="0" min="0" max="10">
                                    <button></button> 
                                </div>
                            </div>
                        </div>
                    <!-- Slot For Cloning / Do NOT Remove-->
        
                    <?php } ?>	</div>	
       


				
				</div>
         </div>	 

                        <!-- Book Now -->
                        <a href="pages-booking.html" class="button book-now fullwidth margin-top-5">Réserver</a>
                                
                <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div>
                        <div id="menu1" class="tab-content">';
                } ?> 
                   <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div>
                        <div id="menu1" class="tab-content" style="display:none;">';
                } ?> 
                 <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) == 0) {
                        # code...
                        echo '</div>
                        <div id="menu1" class="tab-content" >';
                } ?> 
            
            
               
               
                        <!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
                        <div class="col-lg-12">
                        <select class="chosen-select-no-single" id="servicerec" name="servicerec"  data-placeholder="Sélectionner l'abonnement desiré">
                        <option label="blank"></option>	

                             <?php 
                                foreach($servicesreccurent as $service){
                                    echo '<option  style="font-weight: 17px;" value="'.$service->id.'"  prix="'.$service->prix.'">'.$service->nom.'</option>'; 
                        
                        $mab[$service->id]=$service->produits_id ;
                                }
                                
                                ?>
                                
                                <meta type="hidden" name="csrf-token" content="{{ csrf_token() }}" />

                            </select>
                        </div>
                        <div class="col-lg-12">
						<input type="text"  id="date-picker2" placeholder="Date" readonly="readonly">
                        </div>

                        <!-- Panel Dropdown -->
                        <div class="col-lg-12">
                            <div class="panel-dropdown time-slots-dropdown">
                                <a href="#">Heure</a>
                                <div class="panel-dropdown-content padding-reset">
                                    <div class="panel-dropdown-scrollable">
                                        
                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-1">
                                            <label for="time-slot-1">
                                                <strong>8:30 am - 9:00 am</strong>
                                                <span>1 slot available</span>
                                            </label>
                                        </div>

                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-2">
                                            <label for="time-slot-2">
                                                <strong>9:00 am - 9:30 am</strong>
                                                <span>2 slots available</span>
                                            </label>
                                        </div>

                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-3">
                                            <label for="time-slot-3">
                                                <strong>9:30 am - 10:00 am</strong>
                                                <span>1 slots available</span>
                                            </label>
                                        </div>

                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-4">
                                            <label for="time-slot-4">
                                                <strong>10:00 am - 10:30 am</strong>
                                                <span>3 slots available</span>
                                            </label>
                                        </div>

                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-5">
                                            <label for="time-slot-5">
                                                <strong>13:00 pm - 13:30 pm</strong>
                                                <span>2 slots available</span>
                                            </label>
                                        </div>

                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-6">
                                            <label for="time-slot-6">
                                                <strong>13:30 pm - 14:00 pm</strong>
                                                <span>1 slots available</span>
                                            </label>
                                        </div>

                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-7">
                                            <label for="time-slot-7">
                                                <strong>14:00 pm - 14:30 pm</strong>
                                                <span>1 slots available</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 ">
                        <!--  <div class="row" style="padding-left:40px">Rappel de mon rendez vous par SMS</div> -->
                     
                        <select class="chosen" id="rappel" >
                        <option  label="blank">Rappel de rendez vous par SMS</option>
                        <option value="60">1h avant le RDV </option>
                <option value="120">2h avant le RDV</option>
                      	 <option value="180">3h avant le RDV</option>
                <option value="1440">1 jour avant le RDV</option>
              <option value="2880">2 jours avant le RDV</option>
                <option value="7200">5 jours avant le RDV</option>
                        </select>
                      
                    </div>

                        <!-- Book Now -->
                        <a href="pages-booking.html" class="button book-now fullwidth margin-top-5">Réserver</a>
                        <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) == 0) {
                        # code...
                        echo '</div></div></div>';
                } ?> 
                 <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div></div></div></div>';
                } ?> 
                 <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) == 0) {
                        # code...
                        echo '</div></div></div>';
                } ?>
                <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div></div></div></div>';
                } ?>    
                
                         
            <!-- Book Now / End -->

             <?php if (($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
            <!-- qr code Widget -->
            <div class="coupon-widget" style="">
                <a href="#" class="coupon-top">
                    <?php $url1=  URL::asset('storage\qrcodes'); 
                    $urlqrcode = $url1."/".$user->qr_code;  ?>
                    <center><img src="{{$urlqrcode}}" alt="" width="130" height="130"></center>
                    <!--<span class="coupon-link-icon"></span>
                    <h3>Order 1 burger and get 50% off on second!</h3>
                    <div class="coupon-valid-untill">Expires 25/10/2019</div>
                    <div class="coupon-how-to-use"><strong>How to use?</strong> Just show us this coupon on a screen of your smartphone!</div>-->
                </a>
                <div class="coupon-bottom">
                    <div class="coupon-scissors-icon"></div>
                    <div class="coupon-code">CODE QR</div>
                </div>
            </div>
        <?php } ?>
        
            <!-- Opening Hours -->
            <div class="boxed-widget opening-hours margin-top-35">
                
                <?php 
                            $fhoraire = $user->fhoraire;
                            date_default_timezone_set($fhoraire);

                            $currenttime = date('H:i');
                            $dayname = date("l");
                            // lundi
                            if ($dayname === "Monday")
                            {
                                if ((strtotime($currenttime) >= strtotime($user->lundi_o)) && (strtotime($currenttime) <= strtotime($user->lundi_f)))
                                    { echo '<div class="listing-badge now-open">Ouvert</div>';}
                            }
                            // mardi
                            if ($dayname === "Tuesday")
                            {
                                if ((strtotime($currenttime) >= strtotime($user->mardi_o)) && (strtotime($currenttime) <= strtotime($user->mardi_f)))
                                    { echo '<div class="listing-badge now-open">Ouvert</div>';}
                            }
                            // mercredi
                            if ($dayname === "Wednesday")
                            {
                                if ((strtotime($currenttime) >= strtotime($user->mercredi_o)) && (strtotime($currenttime) <= strtotime($user->mercredi_f)))
                                    { echo '<div class="listing-badge now-open">Ouvert</div>';}
                            }
                            // jeudi
                            if ($dayname === "Thursday")
                            {
                                if ((strtotime($currenttime) >= strtotime($user->jeudi_o)) && (strtotime($currenttime) <= strtotime($user->jeudi_f)))
                                    { echo '<div class="listing-badge now-open">Ouvert</div>';}
                            }
                            // vendredi
                            if ($dayname === "Friday")
                            {
                                if ((strtotime($currenttime) >= strtotime($user->vendredi_o)) && (strtotime($currenttime) <= strtotime($user->vendredi_f)))
                                    { echo '<div class="listing-badge now-open">Ouvert</div>';}
                            }
                            // samedi
                            if ($dayname === "Saturday")
                            {
                                if ((strtotime($currenttime) >= strtotime($user->samedi_o)) && (strtotime($currenttime) <= strtotime($user->samedi_f)))
                                    { echo '<div class="listing-badge now-open">Ouvert</div>';}
                            }
                            // dimanche
                            if ($dayname === "Sunday")
                            {
                                if ((strtotime($currenttime) >= strtotime($user->dimanche_o)) && (strtotime($currenttime) <= strtotime($user->dimanche_f)))
                                    { echo '<div class="listing-badge now-open">Ouvert</div>';}
                            }
                        ?>
                <h3><i class="sl sl-icon-clock"></i> Heures d'ouverture</h3>
                <ul>
                    <li>Lundi <span>
                    <?php if ($user->lundi_o !='' && $user->lundi_f  !='' ){
                        echo  $user->lundi_o.' - '.$user->lundi_f; }else{echo 'Fermé';} ?>
                        </span></li>
                    <li>Mardi <span>
                    <?php if ($user->mardi_o !='' && $user->mardi_f  !='' ){
                        echo  $user->mardi_o.' - '.$user->mardi_f ;}else{echo 'Fermé';} ?>
                        </span></li>
                    <li>Mercredi <span>
                    <?php if ($user->mercredi_o !='' && $user->mercredi_f  !='' ){
                        echo  $user->mercredi_o.' - '.$user->mercredi_f; }else{echo 'Fermé';} ?>
                        </span></li>
                    <li>Jeudi <span>
                    <?php if ($user->jeudi_o !='' && $user->jeudi_f  !='' ){
                        echo  $user->jeudi_o.' - '.$user->jeudi_f; }else{echo 'Fermé';} ?>
                        </span></li>
                    <li>Vendredi <span>
                    <?php if ($user->vendredi_o !='' && $user->vendredi_f  !='' ){
                        echo  $user->vendredi_o.' - '.$user->vendredi_f; }else{echo 'Fermé';} ?>
                        </span></li>
                    <li>Samedi <span>
                    <?php if ($user->samedi_o !='' && $user->samedi_f  !='' ){
                        echo  $user->samedi_o.' - '.$user->samedi_f; }else{echo 'Fermé';} ?>
                        </span></li>
                    <li>Dimanche <span>
                    <?php if ($user->dimanche_o !='' && $user->dimanche_f  !='' ){
                        echo  $user->dimanche_o.' - '.$user->dimanche_f; }else{echo 'Fermé';} ?>
                        </span></li>
                </ul>
            </div>
            <!-- Opening Hours / End -->


            <!-- Contact -->
            <div class="boxed-widget margin-top-35">
                <?php if (!empty($user->responsable)) { ?>
                <div class="hosted-by-title">
                    <h4><span>Responsable</span> <a href="pages-user-profile.html">{{$user->responsable}}</a></h4>
                </div>
                <?php } ?>
                <ul class="listing-details-sidebar">
                    <?php if (!empty($user->tel)) { ?>
                    <li><i class="sl sl-icon-phone"></i> {{$user->tel}}</li>
                    <?php } ?>
                    <?php if (!empty($user->email)) { ?>
                    <li style="width:100px!important;"><i class="fa fa-envelope-o"></i> <a href="#" style="width:100px!important;">{{$user->email}}</a></li>
                    <?php } ?>
                </ul>

                <ul class="listing-details-sidebar social-profiles">
                <?php if (!empty($user->fb)) { ?>
                    <li>
                        <a href="{{$user->fb}}" target="_blank" class="facebook-profile"><i class="fa fa-facebook-square"></i> Facebook</a>
                    </li>
                <?php } ?>
                <?php if (!empty($user->twitter)) { ?>
                    <li>
                        <a href="{{$user->twitter}}" target="_blank" class="twitter-profile"><i class="fa fa-twitter"></i> Twitter</a>
                    </li>
                <?php } ?>
                <?php if (!empty($user->instagram)) { ?>
                    <li>
                        <a href="{{$user->instagram}}" target="_blank" class="instagram-profile"><i class="fa fa-instagram"></i> Instagram</a>
                    </li>
                <?php } ?>
                    <!-- <li><a href="#" class="gplus-profile"><i class="fa fa-google-plus"></i> Google Plus</a></li> -->
                </ul>

                <!-- Reply to review popup 
                <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                    <div class="small-dialog-header">
                        <h3>Send Message</h3>
                    </div>
                    <div class="message-reply margin-top-0">
                        <textarea cols="40" rows="3" placeholder="Your message to Tom"></textarea>
                        <button class="button">Send Message</button>
                    </div>
                </div>

                <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>-->
            </div>
            <!-- Contact / End-->


            <!-- Share / Like 
            <div class="listing-share margin-top-40 margin-bottom-40 no-border">
                <button class="like-button"><span class="like-icon"></span> Bookmark this listing</button> 
                <span>159 people bookmarked this place</span>

                     
                    <ul class="share-buttons margin-top-40 margin-bottom-0">
                        <li><a class="fb-share" href="#"><i class="fa fa-facebook"></i> Share</a></li>
                        <li><a class="twitter-share" href="#"><i class="fa fa-twitter"></i> Tweet</a></li>
                        <li><a class="gplus-share" href="#"><i class="fa fa-google-plus"></i> Share</a></li>
                    </ul> 
                    <div class="clearfix"></div>
            </div>-->

        </div>
        <!-- Sidebar / End -->

    </div>
</div>



<script>
        /*----------------------------------------------------*/
        $('.show-moreP-button').on('click', function(e){
    	e.preventDefault();
    	$(this).toggleClass('active');

		$('.show-moreP').toggleClass('visible');
		if ( $('.show-moreP').is(".visible") ) {

			var el = $('.show-moreP'),
				curHeight = el.height(),
				autoHeight = el.css('height', 'auto').height();
				el.height(curHeight).animate({height: autoHeight}, 400);


		} else { $('.show-moreP').animate({height: '450px'}, 400); }

	});


	/*----------------------------------------------------*/
</script>

  @endsection
@include('layouts.pageprestataire-scripts')


