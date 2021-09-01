@extends('layouts.frontv2layout')
<style type="text/css">
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
<!-- Slider
================================================== -->
<div class="listing-slider mfp-gallery-container margin-bottom-0">
    <?php $i=0; foreach($images as $image){ $i++;?>
    <a href="<?php echo  URL::asset('storage/images/'.$image->thumb);?>" data-background-image="<?php echo  URL::asset('storage/images/'.$image->thumb);?>" class="item mfp-gallery" title="{{$user->titre}}"></a>
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
                    <li><a href="#listing-pricing-list">Services</a></li>
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


            <!-- Food Menu -->
            <div id="listing-pricing-list" class="listing-section">
                <h3 class="listing-desc-headline margin-top-70 margin-bottom-30">Pricing</h3>

                <div class="show-more">
                    <div class="pricing-list-container">
                        
                        <!-- Food List -->
                        <h4>Burgers</h4>
                        <ul>
                            <li>
                                <h5>Classic Burger</h5>
                                <p>Beef, salad, mayonnaise, spicey relish, cheese</p>
                                <span>$6</span>
                            </li>
                            <li>
                                <h5>Cheddar Burger</h5>
                                <p>Cheddar cheese, lettuce, tomato, onion, dill pickles</p>
                                <span>$6</span>
                            </li>
                            <li>
                                <h5>Veggie Burger</h5>
                                <p>Panko crumbed and fried, grilled peppers and mushroom</p>
                                <span>$6</span>
                            </li>
                            <li>
                                <h5>Chicken Burger</h5>
                                <p>Cheese, chicken fillet, avocado, bacon, tomatoes, basil</p>
                                <span>$6</span>
                            </li>
                        </ul>

                        <!-- Food List -->
                        <h4>Drinks</h4>
                        <ul>
                            <li>
                                <h5>Frozen Shake</h5>
                                <span>$4</span>
                            </li>
                            <li>
                                <h5>Orange Juice</h5>
                                <span>$4</span>
                            </li>
                            <li>
                                <h5>Beer</h5>
                                <span>$4</span>
                            </li>
                            <li>
                                <h5>Water</h5>
                                <span>Free</span>
                            </li>
                        </ul>

                    </div>
                </div>
                <a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a>
            </div>
            <!-- Food Menu / End -->

        
            <!-- Location -->
            <div id="listing-location" class="listing-section">
                <h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Location</h3>

                <div id="singleListingMap-container">
                    <div id="singleListingMap" data-latitude="40.70437865245596" data-longitude="-73.98674011230469" data-map-icon="im im-icon-Hamburger"></div>
                    <a href="#" id="streetView">Street View</a>
                </div>
            </div>
                
            <!-- Reviews -->
            <div id="listing-reviews" class="listing-section">
                <h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(12)</span></h3>

                <!-- Rating Overview -->
                <div class="rating-overview">
                    <div class="rating-overview-box">
                        <span class="rating-overview-box-total">4.2</span>
                        <span class="rating-overview-box-percent">out of 5.0</span>
                        <div class="star-rating" data-rating="5"></div>
                    </div>

                    <div class="rating-bars">
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Service <i class="tip" data-tip-content="Quality of customer service and attitude to work with you"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="4.2">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>4.2</strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Value for Money <i class="tip" data-tip-content="Overall experience received for the amount spent"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="4.8">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>4.8</strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Location <i class="tip" data-tip-content="Visibility, commute or nearby parking spots"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="3.7">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>3.7</strong>
                                </span>
                            </div>
                            <div class="rating-bars-item">
                                <span class="rating-bars-name">Cleanliness <i class="tip" data-tip-content="The physical condition of the business"></i></span>
                                <span class="rating-bars-inner">
                                    <span class="rating-bars-rating" data-rating="4.0">
                                        <span class="rating-bars-rating-inner"></span>
                                    </span>
                                    <strong>4.0</strong>
                                </span>
                            </div>
                    </div>
                </div>
                <!-- Rating Overview / End -->


                <div class="clearfix"></div>

                <!-- Reviews -->
                <section class="comments listing-reviews">
                    <ul>
                        <li>
                            <div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
                            <div class="comment-content"><div class="arrow-comment"></div>
                                <div class="comment-by">Kathy Brown <i class="tip" data-tip-content="Person who left this review actually was a customer"></i> <span class="date">June 2019</span>
                                    <div class="star-rating" data-rating="5"></div>
                                </div>
                                <p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>
                                
                                <div class="review-images mfp-gallery-container">
                                    <a href="images/review-image-01.jpg" class="mfp-gallery"><img src="images/review-image-01.jpg" alt=""></a>
                                </div>
                                <a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>12</span></a>
                            </div>
                        </li>

                        <li>
                            <div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
                            <div class="comment-content"><div class="arrow-comment"></div>
                                <div class="comment-by">John Doe<span class="date">May 2019</span>
                                    <div class="star-rating" data-rating="4"></div>
                                </div>
                                <p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
                                <a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>2</span></a>
                            </div>
                        </li>

                        <li>
                            <div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
                            <div class="comment-content"><div class="arrow-comment"></div>
                                <div class="comment-by">Kathy Brown<span class="date">June 2019</span>
                                    <div class="star-rating" data-rating="5"></div>
                                </div>
                                <p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>
                                
                                <div class="review-images mfp-gallery-container">
                                    <a href="images/review-image-02.jpg" class="mfp-gallery"><img src="images/review-image-02.jpg" alt=""></a>
                                    <a href="images/review-image-03.jpg" class="mfp-gallery"><img src="images/review-image-03.jpg" alt=""></a>
                                </div>
                                <a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>4</span></a>
                            </div>
                        </li>

                        <li>
                            <div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
                            <div class="comment-content"><div class="arrow-comment"></div>
                                <div class="comment-by">John Doe<span class="date">May 2019</span>
                                    <div class="star-rating" data-rating="5"></div>
                                </div>
                                <p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
                                <a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review</a>
                            </div>

                        </li>
                     </ul>
                </section>

                <!-- Pagination -->
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Pagination -->
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
                <!-- Pagination / End -->
            </div>


            <!-- Add Review Box -->
            <div id="add-review" class="add-review-box">

                <!-- Add Review -->
                <h3 class="listing-desc-headline margin-bottom-10">Add Review</h3>
                <p class="comment-notes">Your email address will not be published.</p>

                <!-- Subratings Container -->
                <div class="sub-ratings-container">

                    <!-- Subrating #1 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Service <i class="tip" data-tip-content="Quality of customer service and attitude to work with you"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <div class="clearfix"></div>
                            <form class="leave-rating">
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
                            </form>
                        </div>
                    </div>

                    <!-- Subrating #2 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Value for Money <i class="tip" data-tip-content="Overall experience received for the amount spent"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <div class="clearfix"></div>
                            <form class="leave-rating">
                                <input type="radio" name="rating" id="rating-11" value="1"/>
                                <label for="rating-11" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-12" value="2"/>
                                <label for="rating-12" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-13" value="3"/>
                                <label for="rating-13" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-14" value="4"/>
                                <label for="rating-14" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-15" value="5"/>
                                <label for="rating-15" class="fa fa-star"></label>
                            </form>
                        </div>
                    </div>

                    <!-- Subrating #3 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Location <i class="tip" data-tip-content="Visibility, commute or nearby parking spots"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <div class="clearfix"></div>
                            <form class="leave-rating">
                                <input type="radio" name="rating" id="rating-21" value="1"/>
                                <label for="rating-21" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-22" value="2"/>
                                <label for="rating-22" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-23" value="3"/>
                                <label for="rating-23" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-24" value="4"/>
                                <label for="rating-24" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-25" value="5"/>
                                <label for="rating-25" class="fa fa-star"></label>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Subrating #4 -->
                    <div class="add-sub-rating">
                        <div class="sub-rating-title">Cleanliness <i class="tip" data-tip-content="The physical condition of the business"></i></div>
                        <div class="sub-rating-stars">
                            <!-- Leave Rating -->
                            <div class="clearfix"></div>
                            <form class="leave-rating">
                                <input type="radio" name="rating" id="rating-31" value="1"/>
                                <label for="rating-31" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-32" value="2"/>
                                <label for="rating-32" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-33" value="3"/>
                                <label for="rating-33" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-34" value="4"/>
                                <label for="rating-34" class="fa fa-star"></label>
                                <input type="radio" name="rating" id="rating-35" value="5"/>
                                <label for="rating-35" class="fa fa-star"></label>
                            </form>
                        </div>
                    </div>  

                    <!-- Uplaod Photos -->
                    <div class="uploadButton margin-top-15">
                        <input class="uploadButton-input" type="file"  name="attachments[]" accept="image/*, application/pdf" id="upload" multiple/>
                        <label class="uploadButton-button ripple-effect" for="upload">Add Photos</label>
                        <span class="uploadButton-file-name"></span>
                    </div>
                    <!-- Uplaod Photos / End -->

                </div>
                <!-- Subratings Container / End -->

                <!-- Review Comment -->
                <form id="add-comment" class="add-comment">
                    <fieldset>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Name:</label>
                                <input type="text" value=""/>
                            </div>
                                
                            <div class="col-md-6">
                                <label>Email:</label>
                                <input type="text" value=""/>
                            </div>
                        </div>

                        <div>
                            <label>Review:</label>
                            <textarea cols="40" rows="3"></textarea>
                        </div>

                    </fieldset>

                    <button class="button">Submit Review</button>
                    <div class="clearfix"></div>
                </form>

            </div>
            <!-- Add Review Box / End -->


        </div>


        <!-- Sidebar
        ================================================== -->
        <div class="col-lg-4 col-md-4 margin-top-75 sticky">

                
            <!-- Verified Badge -->
            <div class="verified-badge with-tip" data-tip-content="Listing has been verified and belongs the business owner or manager.">
                <i class="sl sl-icon-check"></i> Verified Listing
            </div>

            <!-- Book Now -->
            <div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-35">
                <h3><i class="fa fa-calendar-check-o "></i> Booking</h3>
                <div class="row with-forms  margin-top-0">

                    <!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
                    <div class="col-lg-12">
                        <input type="text" id="date-picker" placeholder="Date" readonly="readonly">
                    </div>

                    <!-- Panel Dropdown -->
                    <div class="col-lg-12">
                        <div class="panel-dropdown time-slots-dropdown">
                            <a href="#">Time Slots</a>
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
                    <!-- Panel Dropdown / End -->

                    <!-- Panel Dropdown -->
                    <div class="col-lg-12">
                        <div class="panel-dropdown">
                            <a href="#">Guests <span class="qtyTotal" name="qtyTotal">1</span></a>
                            <div class="panel-dropdown-content">

                                <!-- Quantity Buttons -->
                                <div class="qtyButtons">
                                    <div class="qtyTitle">Adults</div>
                                    <input type="text" name="qtyInput" value="1">
                                </div>

                                <div class="qtyButtons">
                                    <div class="qtyTitle">Childrens</div>
                                    <input type="text" name="qtyInput" value="0">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Panel Dropdown / End -->

                </div>
                
                <!-- Book Now -->
                <a href="pages-booking.html" class="button book-now fullwidth margin-top-5">Request To Book</a>
            </div>
            <!-- Book Now / End -->


            <!-- Coupon Widget -->
            <div class="coupon-widget" style="background-image: url(http://localhost/listeo_html/images/single-listing-01.jpg);">
                <a href="#" class="coupon-top">
                    <span class="coupon-link-icon"></span>
                    <h3>Order 1 burger and get 50% off on second!</h3>
                    <div class="coupon-valid-untill">Expires 25/10/2019</div>
                    <div class="coupon-how-to-use"><strong>How to use?</strong> Just show us this coupon on a screen of your smartphone!</div>
                </a>
                <div class="coupon-bottom">
                    <div class="coupon-scissors-icon"></div>
                    <div class="coupon-code">L1ST30</div>
                </div>
            </div>

        
            <!-- Opening Hours -->
            <div class="boxed-widget opening-hours margin-top-35">
                <div class="listing-badge now-open">Now Open</div>
                <h3><i class="sl sl-icon-clock"></i> Opening Hours</h3>
                <ul>
                    <li>Monday <span>9 AM - 5 PM</span></li>
                    <li>Tuesday <span>9 AM - 5 PM</span></li>
                    <li>Wednesday <span>9 AM - 5 PM</span></li>
                    <li>Thursday <span>9 AM - 5 PM</span></li>
                    <li>Friday <span>9 AM - 5 PM</span></li>
                    <li>Saturday <span>9 AM - 3 PM</span></li>
                    <li>Sunday <span>Closed</span></li>
                </ul>
            </div>
            <!-- Opening Hours / End -->


            <!-- Contact -->
            <div class="boxed-widget margin-top-35">
                <div class="hosted-by-title">
                    <h4><span>Hosted by</span> <a href="pages-user-profile.html">Tom Perrin</a></h4>
                    <a href="pages-user-profile.html" class="hosted-by-avatar"><img src="images/dashboard-avatar.jpg" alt=""></a>
                </div>
                <ul class="listing-details-sidebar">
                    <li><i class="sl sl-icon-phone"></i> (123) 123-456</li>
                    <!-- <li><i class="sl sl-icon-globe"></i> <a href="#">http://example.com</a></li> -->
                    <li><i class="fa fa-envelope-o"></i> <a href="#">tom@example.com</a></li>
                </ul>

                <ul class="listing-details-sidebar social-profiles">
                    <li><a href="#" class="facebook-profile"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                    <li><a href="#" class="twitter-profile"><i class="fa fa-twitter"></i> Twitter</a></li>
                    <!-- <li><a href="#" class="gplus-profile"><i class="fa fa-google-plus"></i> Google Plus</a></li> -->
                </ul>

                <!-- Reply to review popup -->
                <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                    <div class="small-dialog-header">
                        <h3>Send Message</h3>
                    </div>
                    <div class="message-reply margin-top-0">
                        <textarea cols="40" rows="3" placeholder="Your message to Tom"></textarea>
                        <button class="button">Send Message</button>
                    </div>
                </div>

                <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>
            </div>
            <!-- Contact / End-->


            <!-- Share / Like -->
            <div class="listing-share margin-top-40 margin-bottom-40 no-border">
                <button class="like-button"><span class="like-icon"></span> Bookmark this listing</button> 
                <span>159 people bookmarked this place</span>

                    <!-- Share Buttons -->
                    <ul class="share-buttons margin-top-40 margin-bottom-0">
                        <li><a class="fb-share" href="#"><i class="fa fa-facebook"></i> Share</a></li>
                        <li><a class="twitter-share" href="#"><i class="fa fa-twitter"></i> Tweet</a></li>
                        <li><a class="gplus-share" href="#"><i class="fa fa-google-plus"></i> Share</a></li>
                        <!-- <li><a class="pinterest-share" href="#"><i class="fa fa-pinterest-p"></i> Pin</a></li> -->
                    </ul>
                    <div class="clearfix"></div>
            </div>

        </div>
        <!-- Sidebar / End -->

    </div>
</div>



  @endsection