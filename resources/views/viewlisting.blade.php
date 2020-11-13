@extends('layouts.frontlayout')
 
 @section('content')
  <?php 
  $images = \App\Image::where('user',$user->id)->get();
  $nbimages =count($images );
  if( $nbimages>0){
?>	  
	  <div class="clearfix"></div>
  <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0"> 
	<?php foreach($images as $image){?>
		<a href="<?php echo  URL::asset('storage/images/'.$image->thumb);?>" data-background-image="<?php echo  URL::asset('storage/images/'.$image->thumb);?>" class="item utf_gallery"></a> 
    <?php } ?>
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
      
  <div class="container">
    <div class="row utf_sticky_main_wrapper">
      <div class="col-lg-8 col-md-8">
        <div id="titlebar" class="utf_listing_titlebar">
          <div class="utf_listing_titlebar_title">
           <h2>{{$user->titre}} 
				
		   </h2>
             <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> {{$user->ville}}</a> </span>			
			<span class="call_now"><i class="sl sl-icon-phone"></i> {{$user->tel}}</span>
            <div class="utf_star_rating_section" data-rating="4.5">
              <div class="utf_counter_star_rating">(4.5) / (14 Reviews)</div>
            </div>
		 <h2>	<?php	$categories_user = \DB::table('categories_user')->where('user',$user->id)->get();
					$services =\App\Service::where('user',$user->id)->get();
					foreach($categories_user as $cat){   $categorie =\App\Categorie::find( $cat->categorie);  
				if($categorie->parent==null){ 	echo ' <span class="listing-tag">'.$categorie->nom.'</span>';}

					}
		  
		  ?> </h2>
		    <ul class="listing_item_social"><!-- <li><a class="link" href="#"><i class="fa fa-bookmark"></i> Ajouter au favoris</a></li>-->
			  <li><a class="link"  href="#"><i class="fa fa-star"></i> Ajoute un avis</a></li>              
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
        
        <div id="utf_listing_amenities" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Services</h3>
          <ul class="utf_listing_features checkboxes margin-top-0">
		  <?php foreach ($services as $service)
		  {
			  echo '<li>'.$service->nom.'  -  <small><b>'.$service->prix.' €</b></small>' ;  ?>
           <!-- <li>Air Conditioned</li>-->
	 <?php } ?>      
          </ul>
        </div>
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
		<div id="utf_listing_video" class="utf_listing_section" style="max-width:400px">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Vidéo</h3>
 		  <?php echo $user->codevideo ;?>
         </div>
	  <?php } ?>      
		</section>
		<div id="utf_listing_faq" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">FAQ</h3>
          <div class="style-2">
			<div class="accordion">
			  <h3><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (1) How to Open an Account?</h3>
			  <div>
				<p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy text of the printing and type setting industry.</p>
			  </div>
			  <h3><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (2) How to Add Listing?</h3>
			  <div>
				<p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy text of the printing and type setting industry.</p>
			  </div>
			  <h3><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> (3) What is Featured Listing?</h3>
			  <div>
				<p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum is simply dummy text of the printing and type setting industry.</p>
			  </div>			  			  				  			  
			</div>
		  </div>
        </div>	
        
        <div id="utf_listing_location" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-60 margin-bottom-40">Location</h3>
          <div id="utf_single_listing_map_block">
            <div id="utf_single_listingmap" data-latitude="36.778259" data-longitude="-119.417931" data-map-icon="im im-icon-Hamburger"></div>
            <a href="#" id="utf_street_view_btn">Street View</a> 
		  </div>
        </div>
        <div id="utf_listing_reviews" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Reviews <span>(08)</span></h3>
          <div class="clearfix"></div>
		  <div class="reviews-container">
			<div class="row">
				<div class="col-lg-3">
					<div id="review_summary">
						<strong>4.5</strong>
						<em>Superb Reviews</em>
						<small>Out of 15 Reviews</small>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Quality</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>77</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Space</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>15</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Price</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>18</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Service</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>10</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Location</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>05</strong></small></div>
					</div>
				</div>
			</div>
		  </div>
          <div class="comments utf_listing_reviews">
            <ul>
              <li>
                <div class="avatar"><img src="images/client-avatar1.jpg" alt="" /></div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="5"></div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2019 - 8:52 am</span> </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                                    
				</div>
              </li>
              <li>
                <div class="avatar"><img src="images/client-avatar2.jpg" alt="" /> </div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4"></div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2019 - 8:52 am</span> </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                  
				</div>
              </li>
			  <li>
                <div class="avatar"><img src="images/client-avatar3.jpg" alt="" /> </div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4"></div>                  
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2019 - 8:52 am</span> </div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                  
				</div>
              </li>
              <li>
                <div class="avatar"><img src="images/client-avatar1.jpg" alt="" /></div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4.5"></div>                  
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2019 - 8:52 am</span> </div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>
                  <div class="review-images utf_gallery_container"> 
				    <a href="images/review-image-01.jpg" class="utf_gallery"><img src="images/review-image-01.jpg" alt=""></a> 
					<a href="images/review-image-02.jpg" class="utf_gallery"><img src="images/review-image-02.jpg" alt=""></a> 
					<a href="images/review-image-03.jpg" class="utf_gallery"><img src="images/review-image-03.jpg" alt=""></a> 
					<a href="images/review-image-01.jpg" class="utf_gallery"><img src="images/review-image-01.jpg" alt=""></a> 
					<a href="images/review-image-02.jpg" class="utf_gallery"><img src="images/review-image-02.jpg" alt=""></a> 
					<a href="images/review-image-03.jpg" class="utf_gallery"><img src="images/review-image-03.jpg" alt=""></a> 
				  </div>                  
				</div>
              </li>
			  <li>
                <div class="avatar"><img src="images/client-avatar3.jpg" alt="" /> </div>
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="4"></div>                  
                  <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2019 / 8:52 am</span> </div>
				  <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat.</p>                  
				</div>
              </li>
            </ul>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
              <div class="utf_pagination_container_part margin-top-30">
                <nav class="pagination">
                  <ul>
                    <li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
                    <li><a href="#" class="current-page">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div id="utf_add_review" class="utf_add_review-box">
          <h3 class="utf_listing_headline_part margin-bottom-20">Add Your Review</h3>
          <span class="utf_leave_rating_title">Your email address will not be published.</span>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="clearfix"></div>
              <div class="utf_leave_rating margin-bottom-30">
                <input type="radio" name="rating" id="rating-1" value="1"/>
                <label for="rating-1" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-2" value="2"/>
                <label for="rating-2" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-3" value="3"/>
                <label for="rating-3" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-4" value="4"/>
                <label for="rating-4" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-5" value="5"/>
                <label for="rating-5" class="fa fa-star"></label>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="add-review-photos margin-bottom-30">
                <div class="photoUpload"> <span>Upload Photo <i class="sl sl-icon-arrow-up-circle"></i></span>
                  <input type="file" class="upload" />
                </div>
              </div>
            </div>
          </div>
          <form id="utf_add_comment" class="utf_add_comment">
            <fieldset>
              <div class="row">
                <div class="col-md-4">
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
                </div>
              </div>
              <div>
                <label>Review:</label>
                <textarea cols="40" placeholder="Your Message..." rows="3"></textarea>
              </div>
            </fieldset>
            <button class="button">Submit Review</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
      
      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
        <div class="verified-badge with-tip margin-bottom-30" data-tip-content="Listing has been verified and belongs business owner or manager."> <i class="sl sl-icon-check"></i> Now Available</div>
        <div class="utf_box_widget booking_widget_box">
          <h3><i class="fa fa-calendar"></i> Réserver
			<!--<div class="price">
				<span>220$<small>person</small></span>				
			</div>-->
		  </h3>
		  <div class="row with-forms margin-top-0">
			<div class="col-lg-12 col-md-12">
				<select class="utf_chosen_select_single" id="service" placeholder="Sélectionner"  >
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
              <input type="text" id="date-picker" placeholder="Date" readonly="readonly">
			  <i class="fa fa-calendar"></i>
            </div>            
          </div>
		  <div class="row with-forms">
			<div class="col-lg-12">
				<div class="panel-dropdown">
					<a href="javascript:void(0)">Personnes <span class="qtyTotal" name="qtyTotal">1</span></a>
					<div class="panel-dropdown-content">
						<div class="qtyButtons">
							<div class="qtyTitle">Adultes</div>
							<input type="text" name="qtyInput" value="1">
						</div>
						<div class="qtyButtons">
							<div class="qtyTitle">Enfants</div>
							<input type="text" name="qtyInput" value="0">
						</div>
					</div>
				</div>
			</div>
		  </div>	
          <a href="listing_booking.html" class="utf_progress_button button fullwidth_block margin-top-5">Réserver</a>
		  <button class="like-button add_to_wishlist"><span class="like-icon"></span> Ajouter au favoris</button>
          <div class="clearfix"></div>
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Contact Info</h3>
          <div class="utf_hosted_by_user_title"> <a href="#" class="utf_hosted_by_avatar_listing"><img src="<?php echo  URL::asset('storage/images/'.$user->logo);?>" alt=""></a>
            <h4><a href="#">{{$user->responsable}}</a><span> </span>
              <span><i class="sl sl-icon-location"></i> {{$user->ville}}</span>
            </h4>
          </div>
		  <ul class="utf_social_icon rounded margin-top-10">
            <li><a class="facebook" href="{{$user->fb}}"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="{{$user->twitter}}"><i class="icon-twitter"></i></a></li>
             <li><a class="linkedin" href="{{$user->linkedin}}"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="{{$user->instagram}}"><i class="icon-instagram"></i></a></li>            
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
 					echo '   <li><i class="fa fa-angle-double-right"></i> '.$categorie->nom .'</li>'; 
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
          <h3><i class="sl sl-icon-envelope-open"></i> Contacter</h3>
          <form id="contactform">
            <div class="row">              
              <div class="col-md-12">                
                  <input name="name" type="text" placeholder="Nom" required="">                
              </div>
              <div class="col-md-12">                
                  <input name="email" type="email" placeholder="Email" required="">                
              </div>          
			  <div class="col-md-12">                
                  <input name="phone" type="text" placeholder="Tel" required="">                
              </div>		
			  <div class="col-md-12">
				  <textarea name="comments" cols="40" rows="2" id="message" placeholder="Votre Message" required=""></textarea>
			  </div>
            </div>            
            <input type="submit" class="submit button" id="submit" value="Envoyer Message">
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
          <h3><i class="sl sl-icon-star"></i>  Rating Average </h3>
          <div class="box-inner">
			  <div class="rating-avg-wrapper text-theme clearfix">
				<div class="rating-avg">4.8</div>
				<div class="rating-after">
				  <div class="rating-mode">/5 Average</div>
				  
				</div>
			  </div>
			  <div class="ratings-avg-wrapper">
				<div class="ratings-avg-item">
				  <div class="rating-label">Quality</div>
				  <div class="rating-value text-theme">5.0</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Location</div>
				  <div class="rating-value text-theme">4.5</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Space</div>
				  <div class="rating-value text-theme">3.5</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Service</div>
				  <div class="rating-value text-theme">4.0</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Price</div>
				  <div class="rating-value text-theme">5.0</div>
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
 
  @endsection('content')
