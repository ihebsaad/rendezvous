@extends('layouts.frontlayout')
 
 @section('content')
 <?php  $User= auth()->user();

 ?>
<link rel="stylesheet" type="text/css" href="../public/css/slider_carre/carousel.css" />


    
  <?php 
  $images = \App\Image::where('user',$user->id)->get();
  $nbimages =count($images );
  if( $nbimages>0){
?>	  
	  <!-- <div class="clearfix"></div>
  <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0">  -->
	<!-- <?php //foreach($images as $image){?>
		<a href="<?php //echo  URL::asset('storage/images/'.$image->thumb);?>"  class="item utf_gallery">
			<img  height="400" width="950" src="<?php //echo  URL::asset('storage/images/'.$image->thumb);?>"
     alt=""></a> 
    <?php //} ?> -->
	<!-- </div>
  </div> -->

  <div class="row mx-auto my-auto">
            <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    
                   <?php $i=0; foreach($images as $image){ $i++;?>
                    <div class="carousel-item <?php if($i==1){ echo 'active' ; }?>">
                        <div class="col-lg-4 col-md-6 ">
                        	
                      <img  style="max-width: 100%;max-height:100%;" src="<?php echo  URL::asset('storage/images/'.$image->thumb);?>">
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next bg-dark w-auto" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


     
<?php	  
  }else{
	  
	if($user->couverture!='') 
	{
?>	  
 <div class="clearfix"></div>
  <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0"> 
		<a href="<?php echo  URL::asset('storage/images/'.$user->couverture);?>" data-background-image="<?php echo  URL::asset('storage/images/'.$user->couverture);?>"class="item utf_gallery"></a> 
     </div>
  </div> 
<?php		
	}		
  }
  ?>
      
	  
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
    <div class="row utf_sticky_main_wrapper">
      <div class="col-lg-8 col-md-8">
	          <div id="titlebar" class="utf_listing_titlebar">
          <div class="utf_listing_titlebar_title">
           <h2>{{$user->titre}} 
			  <input type="hidden" id="user" value="{{$user->id}}" >

		   </h2>
             <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> {{$user->adresse}}</a> </span>			
			<span class="call_now"><i class="sl sl-icon-phone"></i> {{$user->tel}}</span>
         <?php if(  $countrev  >0 ){?> 
		 <div class="utf_star_rating_section" data-rating="<?php echo $moy; ?>">
              <div class="utf_counter_star_rating">(<?php echo $moy; ?>) / (<?php echo $countrev; ?> Avis)</div>
            </div>
			<?php } ?>
		 <h2>	<?php	$categories_user = \DB::table('categories_user')->where('user',$user->id)->get();
					$services =\App\Service::where('user',$user->id)->get();
					foreach($categories_user as $cat){   $categorie =\App\Categorie::find( $cat->categorie);  
			if(isset($categorie)){	if($categorie->parent==null){ 	echo ' <span class="listing-tag">'.$categorie->nom.'</span>';}  }

					}
		   $countadded= DB::table('favoris')->where('prestataire',$user->id)->count(); 
		  ?> </h2>
		    <ul class="listing_item_social"> <?php if($countadded>0) { ?><li><a class="link" href="#addfavoris"><i class="fa fa-heart"></i> Ajouts aux favoris <big style="color:red;font-weuigt:bold">(<?php echo $countadded ;?>)</big> </a></li> <?php } ?>
			<!--<li><a class="link"  href="#reviews"><i class="fa fa-star"></i> Ajouter un avis</a></li>              -->
          </ul>
            <ul class="listing_item_social">
			 <?php if ($user->approved ==1) {;?> <li> <span class="utp_approve_item"  style="margin-left:15px;"><i class="utf_approve_listing" style="color:#54ba1d"></i></span> Apprové</li><?php } ?>
			 <?php if ($user->featured ==1) {;?> <li  style="margin-left:10px;" > <i style="color:#2cafe3" class="fa fa-flag"></i> Featured</li><?php } ?>
            <!--   <li><a href="#"><i class="fa fa-share"></i> Share</a></li>
			  <li><a href="#" class="now_open">Open Now</a></li>-->
            </ul>
		<!--	<div class="utf_room_detail">
			<ul>
				<li>3 Rooms</li>
				<li>3 Bed Room</li>
				<li>4 Bed</li>
				<li>3 Bath Room</li>
			</ul>
		  </div>-->
          </div>
        </div>
        <div id="utf_listing_overview" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30"> Description</h3>
          <p>{{$user->description}}
		  </p>
		  <div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">          
		    <a href="#"><i class="sl sl-icon-phone" aria-hidden="true"></i> {{$user->tel}}</a>			
			<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$user->email}}</a>	
		<!--	<a href="#"><i class="sl sl-icon-globe" aria-hidden="true"></i> www.example.com</a>			-->
          </div>
		<!--  <div class="social-contact">
			<a href="{{$user->fb}}" class="facebook-link"><i class="fa fa-facebook"></i> Facebook</a>
			<a href="{{$user->twitter}}" class="twitter-link"><i class="fa fa-twitter"></i> Twitter</a>
			<a href="{{$user->instagram}}" class="instagram-link"><i class="fa fa-instagram"></i> Instagram</a>
			<a href="{{$user->linkedin}}" class="linkedin-link"><i class="fa fa-linkedin"></i> Linkedin</a>
			<a href="{{$user->youtube}}" class="youtube-link"><i class="fa fa-youtube-play"></i> Youtube</a>
		  </div>-->		  
        </div>
	  </div>
	  <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
	  
	  <?php if( isset($User) && $user->id== $User->id) {   $format = "Y-m-d H:i:s";
        $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
        $date_15j=\DateTime::createFromFormat($format, $date_15j);
        $date_inscription= $user->date_inscription;
        $date_inscription=\DateTime::createFromFormat($format, $date_inscription);
        /*$date_inscription=$date_inscription->format('Y-m-d');
        $date_15j=$date_15j->format('Y-m-d');*/
        $date_exp='';
        if($user->expire)
        {
        	$date_exp=\DateTime::createFromFormat($format,$user->expire);
        }
        $nbjours = $date_inscription->diff($date_15j);
        $nbjours =intval($nbjours->format('%R%a')); if ( $nbjours<=15 || ($nbjours> 15 && $user->expire && $date_exp >= $date_15j))
				{ ?>   <a href="{{route('listing',['id'=> $user->id] )}}" target="_blank" class="button   "><i class="sl sl-icon-settings"> </i>Modifier</a> <?php }}?>

      <?php if($user->statut==1){?>  <div class="verified-badge with-tip margin-bottom-30" data-tip-content="Prestataire disponible pour des réservations"> <i class="sl sl-icon-check"></i> Disponible</div><?php  } else{ ?>
     <div class="unavailable-badge with-tip margin-bottom-30" data-tip-content="Prestataire disponible pour des réservations"> <i class="sl sl-icon-close"></i> Non Disponible</div>
      <?php } ?>
	  <div class="utf_box_widget booking_widget_box">
          <h3><i class="fa fa-calendar"></i> Réserver un service
			<!--<div class="price">
				<span>220$<small>person</small></span>				
			</div>-->
		  </h3>
		  <div class="row with-forms margin-top-0">
			<div class="col-lg-12 col-md-12">
				<select class="utf_chosen_select_single" id="service" placeholder="Sélectionner"  >
				<option>Veuillez sélectionner un service </option>
					<?php 
					foreach($services as $service){
						echo '<option value="'.$service->id.'">'.$service->nom.'</option>';
					}
					?>
				</select>
			</div>
		  </div>		  
          <div class="row with-forms margin-top-0">
            <div class="col-lg-12 col-md-12 select_date_box">
              <input type="text" id="date-picker" placeholder="Date"  >
			  <i class="fa fa-calendar"></i>
            </div> 
		   <div class="row with-forms margin-top-0">
			<div class="col-lg-3  " style="padding-left:20px;padding-top:10px">
			<label>Heure:</label>
			</div>
			 <div class="col-lg-6  ">
				<input style="margin-left:15px;min-width:180px" type="time"  required  id="heure"	>
		     </div>
		   </div>
          </div>
		  <div class="row with-forms">
			<div class="col-lg-12">
				<div class="panel-dropdown">
					<a href="javascript:void(0)">Personnes <span class="qtyTotal" name="qtyTotal">1</span></a>
					<div class="panel-dropdown-content">
						<div class="qtyButtons">
							<div class="qtyTitle">Adultes</div>
							<input type="text" name="qtyInput" id="adultes" value="1">
						</div>
						<div class="qtyButtons">
							<div class="qtyTitle">Enfants</div>
							<input type="text" name="qtyInput" id="enfants" value="0">
						</div>
					</div>
				</div>
			</div>
			
		  <div class="row with-forms">
		  	 <div class="col-lg-11" style="padding-left:20px">
		  <textarea name="remarques" cols="40" rows="2" id="remarques" placeholder="si vous avez des remarques" ></textarea>

			 </div>
		  </div>
		  <div class="row with-forms">
		  	 <div class="row" style="padding-left:40px">Rappel de mon rendez vous par SMS</div>
			 <div  class="row" style="padding-left:40px;padding-top:5px" >
			 <select class=" " id="rappel" style="max-width:400px!important" >
			  <option value="60">1h avant le RDV </option>
              <option value="120">2h avant le RDV</option>
			 <option value="180">3h avant le RDV</option>
			 <option value="1440">1 jour avant le RDV</option>
			 <option value="2880">2 jours avant le RDV</option>
			 <option value="7200">5 jours avant le RDV</option>
			 </select>
			 </div>
		  </div>		  
		  </div>	
       <?php if (isset($User)){?> 
	   <a class="utf_progress_button button fullwidth_block margin-top-5" style="color:white" id="reserver">Réserver</a>
		
			<?php if($User->user_type=='client'){  ?>  
			<?php $countf= DB::table('favoris')->where('prestataire',$user->id)->where('client',$User->id)->count(); if($countf==0) {?>	
			<button id="addfavoris" class="like-button add_to_wishlist"><span class="like-icon"></span><div id="mesfavoris">Ajouter aux favoris</div></button>
			<?php }else{?>
			<button id="addfavoris" class="like-button add_to_wishlist liked"><span class="like-icon liked"></span><div id="mesfavoris">Retirer de favoris</div></button>
			<?php } ?>
			 <?php } ?>
		 <?php }else{  ?>
		 
		 <a href="#dialog_signin_part" class="button border sign-in popup-with-zoom-anim"  >Connectez vous pour réserver</a>
	 
			 
	<?php	 } ?>
			
          <div class="clearfix"></div>
        </div>

	  
	  </div>
      <div class="col-lg-8 col-md-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

        
        <div id="utf_listing_amenities" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Services</h3>
          <!--<ul class="utf_listing_features checkboxes margin-top-0">-->
          <ul class="utf_listing_features checkboxes margin-top-0">
		  <?php foreach ($services as $service)
		  {
		    echo '<li>  ';
			 
			echo $service->nom.'  -  <small><b>'.$service->prix.' €</b></small>' ;
			if($service->thumb!=''){ echo '<br><a href="'. URL::asset('storage/images/'.$service->thumb).'" data-lightbox="photos"><img src="'. URL::asset('storage/images/'.$service->thumb).'"  style="width:140px;height:100px; margin-bottom:15px;"  /> </a>'; }?>
			
           <!-- <li>Air Conditioned</li>-->

              	 <?php } ?>      
          </ul>
        </div>
        <style>
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
       </style>
		  <?php if($user->video != '' )
		  {   ?> 
	            <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Vidéo</h3>
					<video width="450" height="320" controls>
					<source src="<?php echo  URL::asset('storage/images/'.$user->video);?>" type="video/mp4">
					Votre navigateur ne supporte pas l'affichage de cette video.
					</video>			
			
		  <?php }  ?>
	  		  <?php if($user->codevideo != '' )
		  {   ?>   
	  <section>
		<div id="utf_listing_video" class="utf_listing_section" style="max-width:700px">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Vidéo</h3>
          <div class="video-responsive">
 		  <?php echo $user->codevideo ;?>
 		  </div>
         </div>
	  <?php } ?>      
		</section>
		<?php 
		
		  $faqs =\App\Faq::where('user',$id)->get();
  
		?>
		<div id="utf_listing_faq" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">FAQ</h3>
          <div class="style-2">
		 
			<div class="accordion">
			<?php
			$i=0;
			foreach($faqs as $faq)
			{ $i++;  ?>
			  <h3><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> <?php echo '('.$i.') '.$faq->question;?></h3>
			  <div>
				<p><?php echo $faq->reponse; ?></p>
			  </div>
			<?php 
			} ?>			  				  			  
			</div>
		  </div>
        </div>	
        
        <div id="utf_listing_location" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-60 margin-bottom-40">Emplacement</h3>
          <div id="utf_single_listing_map_block">
            <div id="utf_single_listingmap" data-latitude="{{$user->latitude}}" data-longitude="{{$user->longitude}}" data-map-icon="im im-icon-Marker"></div>
            <a href="#" id="utf_street_view_btn">vue sur la rue</a> 
		  </div>
        </div>

        <div id="utf_listing_reviews" class="utf_listing_section" >
          <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Avis <span>(<?php echo $countrev;?>)</span></h3>
          <div class="clearfix"></div>
		 <?php if($countrev>0){?>
  <div class="reviews-container">
			<div class="row">
				<div class="col-lg-3">
					<div id="review_summary" style="background-color:#0054a6">
						<strong><?php echo $moy;?></strong>
						<em>Note Moyenne</em>
						<small>Sur <?php echo $countrev;?> Avis</small>
				</div>
 				</div>
				<style>
				.progress-bar{background-color:#0054a6!important;}
				</style>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Qualité</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_qualite )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_qualite )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_qualite ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Service</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_service )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_service )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_service ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Prix</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_prix )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_prix )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_prix ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Espace</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_espace )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_espace )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_espace ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Emplacement</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_emplacement )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_emplacement )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_emplacement ;?></strong></small></div>
					</div>
					
					
				</div>
			</div>
		  </div>
		  <?php } ?>
          <div class="comments utf_listing_reviews">
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
			  
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="<?php echo intval($review->note);?>"></div>
				  <!--<a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>-->
                  <div class="utf_by_comment"><?php  echo $name.' '.$lastname ; ?> <span class="date"><i class="fa fa-clock-o"></i><?php $datec= date('d/m/Y H:i', strtotime($review->created_at )); echo $datec ; ?></span> </div>
                  <p><?php echo $review->commentaire; ?></p>                                    
				</div>
              </li>
			<?php } ?>
            </ul>
          </div>
 
        </div>
		<style>
		input:disabled{opacity:0.5;}
		</style>
		<form action="{{ route('reviews.add') }}" method="post"  >
					  {{ csrf_field() }}    
		 <div id="utf_add_review" class="utf_add_review-box">
          <h3 class="utf_listing_headline_part margin-bottom-20">Ajouter un Avis</h3>
       <!--   <span class="utf_leave_rating_title">Your email address will not be published.</span>-->
          <div class="row" id="reviews">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="clearfix"></div>
              <div class="utf_leave_rating margin-bottom-30">
                <input type="radio" name="rating" id="rating-1" value="5" onclick="document.getElementById('note').value='5';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-1" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-2" value="4" onclick="document.getElementById('note').value='4';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-2" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-3" value="3" onclick="document.getElementById('note').value='3';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-3" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-4" value="2" onclick="document.getElementById('note').value='2';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-4" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-5" value="1" onclick="document.getElementById('note').value='1';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-5" class="fa fa-star"></label>
              </div>
			  <input type="hidden" id="prestataire" name="prestataire" value="<?php echo $user->id;?>">
			  <input type="hidden" id="note" name="note">
              <div class="clearfix"></div>
            </div>
		  <div class="row"  >
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
			<label>Qualité</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_qualite" name="note_qualite" ></input>
			</div>	
			<div class="col-md-2">
			<label>Service</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_service" name="note_service" ></input>			
			</div>
			<div class="col-md-2">
			<label>Prix</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_prix" name="note_prix" ></input>
			</div>
			<div class="col-md-2">
			<label>Espace</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_espace" name="note_espace" ></input>
			</div>
			<div class="col-md-2">
			<label>Emplacement</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_emplacement" name="note_emplacement" ></input>
			</div>		
			<div class="col-md-1">
			</div>
          </div>

			
          <!--  <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="add-review-photos margin-bottom-30">
                <div class="photoUpload"> <span>Upload Photo <i class="sl sl-icon-arrow-up-circle"></i></span>
                  <input type="file" class="upload" />
                </div>
              </div>
            </div>-->
          </div>
 		<?php if (isset($User)){?>  <input type="hidden" id="client" name="client" value="<?php echo $User->id;?>" ><?php } ?>
            <fieldset>
              <div class="row">
            <!--    <div class="col-md-4">
                  <label>Name:</label>
                  <input type="text" placeholder="Name" value=""/>
                </div>
                <div class="col-md-4">
                  <label>Email:</label>
                  <input type="text" placeholder="Email" value=""/>
                </div>
                <div class="col-md-4">
                  <label>Subject:</label>
                  <input type="text" placeholder="Subject" value=""/>
                </div>-->
              </div>
              <div>
                <label>Commentaire:</label>
                <textarea cols="40" placeholder="Votre Commentaire..." rows="3" name="commentaire" id="commentaire" required></textarea>
              </div>
            </fieldset><br>
            <input disabled class="button" id="sendavis" type="submit" value="Envoyer"></input>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
      <style>
	.unavailable-badge{  
    background-color: #f1592a;
    border-radius: 4px;
    color: #fff;
    text-align: center;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 400;
    cursor: help;
    position: relative;
    transition: 0.3s;
    display: block;
	}
	
      </style>
      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
			
		
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Contact Info</h3>
          <div class="utf_hosted_by_user_title"> <a href="#" class="utf_hosted_by_avatar_listing"><img src="<?php echo  URL::asset('storage/images/'.$user->logo);?>" alt="" style="width:105px; height:105px"></a>
           <h4 style="margin: 15px 10px 10px;"><a href="#">{{$user->responsable}}</a><span> </span>
              <span><i class="sl sl-icon-location"></i> {{$user->ville}}</span>
            </h4>
           <br>
           </div>
		  <ul class="utf_social_icon rounded margin-top-10">
            <li><a class="facebook" href="{{$user->fb}}" target="_blank" ><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="{{$user->twitter}}" target="_blank" ><i class="icon-twitter"></i></a></li>
             <li><a class="linkedin" href="{{$user->linkedin}}" target="_blank" ><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="{{$user->instagram}}" target="_blank" ><i class="icon-instagram"></i></a></li>            
          </ul>
          <ul class="utf_listing_detail_sidebar">
            <li><i class="sl sl-icon-map"></i> {{$user->adresse}}</li>
            <li><i class="sl sl-icon-phone"></i> {{$user->tel}}</li>
          <!--  <li><i class="sl sl-icon-globe"></i> <a href="#">www.example.com</a></li>-->
            <li><i class="fa fa-envelope-o"></i> <a href="mailto:info@example.com">{{$user->email}}</a></li>
          </ul>		  
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-folder-alt"></i> Catégories</h3>
          <ul class="utf_listing_detail_sidebar">
		<?php  foreach($categories_user as $cat){   $categorie =\App\Categorie::find( $cat->categorie);  
 				if(isset($categorie)){	echo '   <li><i class="fa fa-angle-double-right"></i> '.$categorie->nom .'</li>'; }
					}
					?>
                     </ul>
        </div>
        <div class="utf_box_widget opening-hours margin-top-35">
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
			<?php if ($user->mrecredi_o !='' && $user->mrecredi_f  !='' ){
				echo  $user->mrecredi_o.' - '.$user->mrecredi_f; }else{echo 'Fermé';} ?>
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
	<!--	<div class="opening-hours margin-top-35">
			<div class="utf_coupon_widget" style="background-image: url(images/coupon-bg-1.jpg);">
				<div class="utf_coupon_overlay"></div>
				<a href="#" class="utf_coupon_top">
					<h3>Book Now & Get 50% Discount</h3>
					<div class="utf_coupon_expires_date">Date of Expires 05/08/2019</div>	
					<div class="utf_coupon_used"><strong>How to use?</strong> Just show us this coupon on a screen</div>	
				</a>
				<div class="utf_coupon_bottom">
					<p>Coupon Code</p>
					<div class="utf_coupon_code">DL76T</div>
				</div>
			</div>
		</div>	
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-info"></i> Additional Information</h3>
          <ul>
            <li>Take Out: <span>Yes</span></li>
            <li>Delivery: <span>Yes</span></li>
            <li>Neutral Restrooms: <span>Yes</span></li>
            <li>Has Pool Table: <span>Yes</span></li>
            <li>Gender Neutral Restrooms: <span>Yes</span></li>
            <li>Waiter Service: <span>Yes</span></li>
          </ul>
        </div>
		-->
		<div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-envelope-open"></i> Contacter le prestataire</h3>
          <form id="contactform">
		      {{ csrf_field() }}    

			<input name="to" type="hidden"  value="{{$user->email}}" id="to">                
            <div class="row">              
              <div class="col-md-12">                
                  <input name="emetteur" type="text" placeholder="Nom" required   id="emetteur">                
              </div>
			  </div>            
              <div class="row">              
              <div class="col-md-12">                
                  <input name="email" type="email" placeholder="Email"   id="email" >                
              </div> 
              </div>
			  
			  <div class="row">              
			  <div class="col-md-12">                
                  <input name="tel" type="text" placeholder="Tel"    id="tel">                
              </div>
              </div>
			  
			   <div class="row">              
			  <div class="col-md-12">
				  <textarea name="message" cols="40" rows="2" id="contenu" style="display:block" placeholder="Votre Message"   ></textarea>
			  </div>
			  </div>
			 <br>
            <button type="button" class="submit button" id="sendmail" value="Envoyer Message" onclick=""  style="" >Envoyer le message</button>
          </form>
        </div>
	 
  <!--      <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Contactez Nous</h3>
          <p>Excepteur sint occaecat non proident, sunt in culpa officia deserunt mollit anim id est laborum.</p>
          <ul class="utf_social_icon rounded">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
          </ul>
          <a class="utf_progress_button button fullwidth_block margin-top-5" href="contact.html">Contact Us</a> 
		</div>
        <div class="utf_box_widget listing-share margin-top-35 margin-bottom-40 no-border">
          <h3><i class="sl sl-icon-pin"></i> Bookmark Listing</h3>
		  <span>1275 People Bookmarked Listings</span>
          <button class="like-button"><span class="like-icon"></span> Login to Bookmark Listing</button>          
          <ul class="utf_social_icon rounded margin-top-35">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
          </ul>
          <div class="clearfix"></div>
        </div>
		--> 
		<div class="utf_box_widget opening-hours review-avg-wrapper margin-top-35">
          <h3><i class="sl sl-icon-star"></i>  Moyenne des Avis </h3>
          <div class="box-inner">
			  <div class="rating-avg-wrapper text-theme clearfix">
				<div class="rating-avg"><?php echo $moy;?></div>
				<div class="rating-after">
				  <div class="rating-mode">/5 Average</div>
				  
				</div>
			  </div>
			  <div class="ratings-avg-wrapper">
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Qualité</div>
				  <div class="rating-value text-theme"><?php echo $moy_qualite;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Service</div>
				  <div class="rating-value text-theme"><?php echo $moy_service;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Prix</div>
				  <div class="rating-value text-theme"><?php echo $moy_prix;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Espace</div>
				  <div class="rating-value text-theme"><?php echo $moy_espace;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Emplacement</div>
				  <div class="rating-value text-theme"><?php echo $moy_emplacement;?></div>
				</div>
			  </div>
			</div>
        </div>
      </div>
    </div>
  </div>
  <!--
  <section class="fullwidth_block padding-top-20 padding-bottom-50">
    <div class="container">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-25">Similar Listings</h3>
        </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="simple_slick_carousel_block utf_dots_nav"> 
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-01.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span> <span class="featured_tag">Featured</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Chontaduro Barcelona</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>											
					  </div>					  
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-02.jpg" alt=""> <span class="tag"><i class="im im-icon-Electric-Guitar"></i> Events</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
						</div>
						<h3>The Lounge & Bar</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-03.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>							
						</div>
						<h3>Westfield Sydney</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-04.jpg" alt=""> <span class="tag"><i class="im im-icon-Dumbbell"></i> Fitness</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Ruby Beauty Center</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-05.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span> <span class="featured_tag">Featured</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
						</div>
						<h3>UK Fitness Club</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				   </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-06.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Fairmont Pacific Rim</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>											
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>
				</div>
			  </div>
		  </div>
	   </div>
    </div>
  </section>
  
  <section class="utf_cta_area_item utf_cta_area2_block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="utf_subscribe_block clearfix">
                    <div class="col-md-8 col-sm-7">
                        <div class="section-heading">
                            <h2 class="utf_sec_title_item utf_sec_title_item2">Subscribe to Newsletter!</h2>
                            <p class="utf_sec_meta">
                                Subscribe to get latest updates and information.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <div class="contact-form-action">
                            <form method="post">
                                <span class="la la-envelope-o"></span>
                                <input class="form-control" type="email" placeholder="Enter your email" required="">
                                <button class="utf_theme_btn" type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
	</section>
  
 -->
 <?php if (isset($User)){?> 
 <script>
 			
			$('#addfavoris').click(function( ){
                
			 
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('reviews.addfavoris') }}",
                        method:"POST",
                        data:{prestataire:<?php echo $user->id;?>,client:<?php echo $User->id;?>  , _token:_token},
                        success:function(data){
 
				     if(parseInt(data)==0) { 
					 $('#mesfavoris').html('Retirer de favoris');
					 }
					 else{
					  $('#mesfavoris').html('Ajouter aux favoris');
					 }
 
                        }
                    });
               
            });
	 
	 			$('#reserver').click(function( ){
                
			 
                    var _token = $('input[name="_token"]').val();
                    var remarques = $('#remarques').val();
                    var adultes = $('#adultes').val();
                    var enfants = $('#enfants').val();
                    var date = $('#date-picker').val();
                    var heure = $('#heure').val();
                    var service = $('#service').val();
                    var rappel = $('#rappel').val();
					
                    $.ajax({
                        url:"{{ route('reservations.add') }}",
                        method:"POST",
                        data:{prestataire:<?php echo $user->id;?>,client:<?php echo $User->id;?>,remarques:remarques ,date:date ,service:service, adultes:adultes, enfants:enfants, heure:heure, rappel:rappel   , _token:_token},
                        success:function(data){
 
						location.href= "{{ route('reservations') }}";
                        }
                    });
               
            });
			
			
	 			$('#sendmail').click(function( ){
 		             var _token = $('input[name="_token"]').val();
 
                    var emetteur = $('#emetteur').val();
                    var email = $('#email').val();
                    var tel = $('#tel').val();
                    var contenu = $('#contenu').val();
                    var to = $('#to').val();
                  /*  var tel = document.getElementById('tel').value;
                    var email = document.getElementById('email').value;
                    var emetteur = document.getElementById('emetteur').value;
                    var contenu = document.getElementById('contenu').value;*/
                     $.ajax({
                        url:"{{ route('reservations.sendmessage') }}",
                        method:"POST",
                        data:{prestataire:<?php echo $user->id;?>,emetteur:emetteur , email:email, contenu:contenu, tel:tel ,to:to, _token:_token},
                        success:function(data){
 
					$.notify({
					// options
					message: 'Envoyé avec succès' 
					},{
					// settings
					type: 'success',
					delay: 3000,
					timer: 1000,					
					});	
					
					document.getElementById("contactform").reset();

                        }
                    });
		
                    });
			
 </script>
 <?php }?> 
<!-- Maps --> 
<!-- https://maps.googleapis.com/maps/api/js?key=AIzaSyDARlwNl95VXqSs8FfoocG-gz7wG8j37hs&libraries=places&callback=initialize -->
<!-- <script src="https://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDARlwNl95VXqSs8FfoocG-gz7wG8j37hs&sensor=false&amp;language=en"></script>
<script  src="{{ URL::asset('public/scripts/infobox.min.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/markerclusterer.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/maps.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/quantityButtons.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/moment.min.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/daterangepicker.js')}}"   ></script> 
<script src="//bootstrap-notify.remabledesigns.com/js/bootstrap-notify.min.js"></script>


<script>
$(function() {
	var nowDate = new Date();
	var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
 
	$('#date-picker').daterangepicker({
		"opens": "left",
		singleDatePicker: true,
	locale: {
      format: 'DD/MM/YYYY'
    } ,
     minDate: today,

	/*	isInvalidDate: function(date) {
		var disabled_start = moment('09/02/2018', 'MM/DD/YYYY');
		var disabled_end = moment('09/06/2018', 'MM/DD/YYYY');
		return date.isAfter(disabled_start) && date.isBefore(disabled_end);
		}*/
	});
});

$('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});
$('#date-picker').on('hide.daterangepicker', function(ev, picker) {
	$('.daterangepicker').removeClass('calendar-visible');
	$('.daterangepicker').addClass('calendar-hidden');
});

function close_panel_dropdown() {
$('.panel-dropdown').removeClass("active");
	$('.fs-inner-container.content').removeClass("faded-out");
}
$('.panel-dropdown a').on('click', function(e) {
	if ($(this).parent().is(".active")) {
		close_panel_dropdown();
	} else {
		close_panel_dropdown();
		$(this).parent().addClass('active');
		$('.fs-inner-container.content').addClass("faded-out");
	}
	e.preventDefault();
});
$('.panel-buttons button').on('click', function(e) {
	$('.panel-dropdown').removeClass('active');
	$('.fs-inner-container.content').removeClass("faded-out");
});
var mouse_is_inside = false;
$('.panel-dropdown').hover(function() {
	mouse_is_inside = true;
}, function() {
	mouse_is_inside = false;
});
$("body").mouseup(function() {
	if (!mouse_is_inside) close_panel_dropdown();
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{  URL::asset('public/css/slider_carre/carousel.js') }}" type="text/javascript"></script> 
<script>
/*$( document ).ready(function() {
  var x = document.getElementsByClassName("slick-list draggable");
  x.style.padding = "0px 0%";
  
});*/
</script>
  @endsection('content')
