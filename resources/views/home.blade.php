@extends('layouts.frontlayout')
 

 
 @section('content')

@if ( Session::has('msgs') )
@if ( Session::get('msgs')=="E1" )
<div class="notification notice closeable">
      <p><span>Notification!</span> Merci de bien vouloir vous connecter avant de cliquer sur le lien.</p>
      <a class="close" href="#"></a> 
      </div>
@endif 
@if ( Session::get('msgs')=="E2" )
 <div class="notification warning closeable">
      <p><span>Attention!</span> Vous n'avez pas le droit d'accéder à cette page.</p>
      <a class="close" href="#"></a> 
      </div>
@endif 
<?php Session::forget('msgs'); ?>
 @endif 
  @include('layouts.slider')
<style>
  section.pricing {
  /*background: #007bff;*/
  background: #f9f9f9;
  /*background: linear-gradient(to right, #0062E6, #33AEFF);*/
}

.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
</style>
 <!--
  <div class="container">
	<div class="row">
      <div class="col-md-12">
        <h3 class="headline_part centered margin-top-75"> Most Popular Categories<span>Browse the most desirable categories</span></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="container_categories_box margin-top-5 margin-bottom-30"> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Hotel"></i>
			<h4>Hotels</h4>
			<span>22</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Hamburger"></i>
			<h4>Eat & Drink</h4>
			<span>15</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Shop-2"></i>
			<h4>Shops</h4>
			<span>05</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Cocktail"></i>
			<h4>Nightlife</h4>
			<span>12</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Electric-Guitar"></i>
			<h4>Events</h4>
			<span>08</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Dumbbell"></i>
			<h4>Fitness</h4>
			<span>18</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Home-2"></i>
			<h4>Real Estate</h4>
			<span>14</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Chef-Hat"></i>
			<h4>Restaurant</h4>
			<span>22</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Couple-Sign"></i>
			<h4>Dance Floor</h4>
			<span>20</span>
          </a> 
          <a href="listings_list_with_sidebar.html" class="utf_category_small_box_part"> <i class="im im-icon-Old-Cassette"></i>
			<h4>Cinema</h4>
			<span>07</span>
          </a> 
		</div>
		<div class="col-md-12 centered_content"> <a href="#" class="button border margin-top-20">View More</a> </div>
      </div>
    </div>
  </div>
 -->

 
 <!-- <section class="fullwidth_block margin-top-65 "  data-background-color="#f9f9f9">
 <div class="parallax" data-background="public/images/inscription_gratuite_pendant_6_mois.png"> 
    <div class="utf_text_content white-font">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <h2 style="font-family:'Lucida Handwriting',cursive">Offre de lancement <br> Inscription gratuite pendant 1 mois <br></h2>
            <p style="font-size:150%;font-family:'Lucida Handwriting',cursive"> Pour les 100 premiers prestataires de services </p>
            
			</div>
        </div>
      </div>
    </div>   
  </div> 
</section> -->
<!-- <br><br><br><br><br><br> -->
<!--<div class="row" >
<div class="col-lg-12 col-sm-12">
<img src="public/images/clavier.png" alt="" style="width:100%; height:375px; z-index:-9; top:-10px; ">
</div>
</div>-->

<div class="parallax margin-top-65" data-background="public/images/inscription_coiffure.jpg" style="background-image: url(&quot;public/images/inscription_coiffure.jpg&quot;); background-attachment: fixed; background-position: 50% -40.8324px;" style="height: 580px;"><div class="parallax-overlay"></div> 
    <div class="utf_text_content white-font" style="padding:120px 0px; height: 580px;">
      <div class="container" style="top: 0px;">
        <div class="row">
          <div class="col-lg-12 col-sm-12">

            <!-- <h2 style="font-family:'Lucida Handwriting',cursive">Offre de lancement <br> Inscription gratuite pendant 1 mois <br></h2>
            <p style="font-size:150%;font-family:'Lucida Handwriting',cursive"> Pour les 100 premiers prestataires de services </p> -->

            <!-- <h2 >Offre de lancement <br> Inscription gratuite pendant 1 mois <br></h2>
            <p style="font-size:150%;"> Pour les 100 premiers prestataires de services </p> -->
            <h2>Prestataire de services profitez de notre offre de lancement</h2>
            <h3>Inscrivez-vous et testez gratuitement notre site pendant 15 jours.</h3>
            <p style="font-size:150%;">  </p>
           

           <!--  <a href="#dialog_signin_part" style="background-color:#006ED2"class="button margin-top-25">Commencez !</a> -->
           <br>
           
             @guest<a href="#dialog_signin_part" style="background-color:#006ED2 ; color:white" class="button border sign-in popup-with-zoom-anim"  onclick="$('#litab2').trigger('click');">Je profite maintenant !</a> @endguest</div>
        </div>
      </div>
    </div>   
  </div>
 <!--  <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70"  data-background-color="#f9f9f9">
    <div class="container" style ="background-image: url('public/images/nscription_gratuite_pendant_6_mois.png');">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-45">Nos Prestataires <span>Explorez nos prestataires et trouvez votre besoin</span> </h3>
        </div>

        </div>
        </div>
  </section> -->
  
<br><br>
<div class="row">
  <div class="col-md-12">
          <h2 class="headline_part centered margin-bottom-20">Comment ça marche<span></span></h2>
  </div>
</div>
<br>
<section class="pricing py-5">
  <div class="container">
    <div class="row">
      <!-- Free Tier -->
      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
          	<br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2" ><i class="fa  fa-search fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><p style="font-size:130%;padding-bottom: 50px">
               Recherchez une prestation de service parmi nos différentes catégories populaires
            </p></center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2"><i class="fa fa-check fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><p style="font-size:130%;padding-bottom: 25px">
               Comparez les avis et les notes des professionels près de chez vous  
            </p><br>
            <br>    </center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
         
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span style="color:#006ED2" ><i class="fa fa-calendar fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><p style="font-size:130%;padding-bottom: 23px">
               Sélectionnez les professionnels avec qui vous souhaitez prendre rendez-vous
            </p></center> <br>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
         </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <br>
            <!-- <h5 class="card-title text-muted text-uppercase text-center">Free</h5> -->
            <center><span  style="color:#006ED2"><i class="fa icon-material-outline-credit-card fa-5x"></i></span></center>
            <!-- <h6 class="card-price text-center">$0<span class="period">/month</span></h6> -->
            <br>
            <br>
            <center><p style="font-size:130%;">
               Payez la prestation de service en ligne avec toute sécurité
            </p></center>
            <center><p style="color:grey">
               Payez soit par carte bleu ou via paypal
            </p></center>
            <!-- <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a> -->
          </div>
        </div>
      </div>


   </div>
      </div>
 </section>
  <!--------------------------listings  ----------)------------------------------------------------------->
  <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
    <div class="container">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-45">Nos Prestataires <span>Explorez nos prestataires et trouvez votre besoin</span> </h3>
        </div>
		
		<div class="row">
			<div class="col-md-12">
 				<div class=" row utf_dots_nav"> 
				 <?php  $User= auth()->user();  ?>
				<?php
				$listings=\App\User::where('user_type','prestataire')->get();
         $format = "Y-m-d H:i:s";
            $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
            $date_15j=\DateTime::createFromFormat($format, $date_15j);
          
				foreach ($listings as $listing)
				{
          $date_inscription=  $listing->date_inscription;
            $date_inscription=\DateTime::createFromFormat($format, $date_inscription);            
            $nbjours = $date_inscription->diff($date_15j);
            $nbjours =intval($nbjours->format('%R%a'));
             $date_exp='';
            if($listing->expire)
            {
              $date_exp=\DateTime::createFromFormat($format,$listing->expire);
            }
        
        if ( $nbjours<=15 || ($nbjours> 15 && $listing->expire &&  $date_exp >= $date_15j))
        {
                    $categories_user = \DB::table('categories_user')->where('user',$listing->id)->get();
					$services =\App\Service::where('user',$listing->id)->get();
					
  $reviews= \App\Review::where('prestataire',$listing->id)->get();
        $countrev= count($reviews);

		  $moy=$moy_qualite=$moy_service=$moy_prix=$moy_emplacement=$moy_espace=0;
		$total=0;  
		if($countrev>0){
		
		foreach( $reviews as $review)
		{
			$total=$total+($review->note);
	  
		}
		
		$moy=$total/$countrev; 
		}		
				?>
				  <div class="col-md-4 utf_carousel_item" style="min-width:350px">
				  <div class="utf_listing_item-container ">
					{{--<a  href="{{route('viewlisting',['id'=> $listing->id] )}}">--}}
            <a  href="{{$listing->generate_slug()}}">
					<div class="utf_listing_item"> <img src="<?php echo  URL::asset('storage/images/'.$listing->couverture);?>" alt="" style="max-width:450px">
				<?php $top=15; $i=0;?>
				<?php foreach($categories_user as $cat){ 
				$categorie =\App\Categorie::find( $cat->categorie); 
				
				if($categorie !=null){
				if($i<5){
				if($categorie->parent==null){ 	
			    $i++;	?>
				<span class="tag" style="top:<?php echo $top;?>px!important"><?php echo  $categorie->nom; ?></span>   
				<?php $top=$top+30; 
				} 
				}
				}
				
				}
				?>
					<!-- <?php //if ($listing->featured ==1) {;?><span style=" " class="featured_tag pull-left">Featured</span><?php // } ?>-->
					 <!-- <span class="utf_open_now">Open Now</span>-->
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
						<!--	<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>		-->					
						<?php if ($listing->approved ==1) {;?>	<span class="utp_approve_item"><i class="utf_approve_listing"></i></span><?php }?>
						</div>
						<h3>{{$listing->titre}}</h3>
						<span><i class="sl sl-icon-location"></i> {{$listing->adresse}}</span>
						<span><i class="sl sl-icon-phone"></i> {{$listing->tel}}</span>											
					  </div>					  
					</div>
					</a>
				<?php if ($countrev >0){?> 	
				<div class="utf_star_rating_section" data-rating="<?php echo $moy;?>"> 
						<div class="utf_counter_star_rating"><?php echo $moy;?></div>
						<?php }else{ ?>
					<div class="utf_star_rating_section" style="height:55px" > 		
							
						<?php } ?>
						<!--<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>-->
					<?php if (isset($User)){?> 	

			<?php if($User->user_type=='client'){  ?>  
			<?php $countf= DB::table('favoris')->where('prestataire',$listing->id)->where('client',$User->id)->count(); if($countf==0) {?>	
			 <span id="fav-<?php echo $listing->id;?>" onclick="addfavoris(<?php echo $listing->id;?>)" class="addfavoris like-icon"></span>  
			<?php }else{?>
			 <span id="fav-<?php echo $listing->id;?>"  onclick="addfavoris(<?php echo $listing->id;?>)" class="addfavoris like-icon liked"></span>   
			<?php } ?>
			 <?php } ?>
			 
					<?php }?>
					</div>
					</div> 
				  </div>
		 <?php }}  //foreach $listings  ?>
				  
				  
				</div>
			  </div>
		  </div>
	   </div>
	   </div>
    </div>
  </section>
   <!-- <a href="listings_grid_full_width.html" class="flip-banner parallax" data-background="{{  URL::asset('public/images/slider-bg-02.jpg')}}" data-color="#000" data-color-opacity="0.85" data-img-width="2500" data-img-height="1666">
	  <div class="flip-banner-content">
		<h2 class="flip-visible">Browse Listings Attractions List</h2>    
	  </div>
  </a>

  <section class="utf_testimonial_part fullwidth_block padding-top-75 padding-bottom-75"> 
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h3 class="headline_part centered">What Say Our Customers <span class="margin-top-15">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since...</span> </h3>
        </div>
      </div>
    </div>
    <div class="fullwidth_carousel_container_block margin-top-20">
      <div class="utf_testimonial_carousel testimonials"> 
        <div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{{  URL::asset('public/images/happy-client-01.jpg') }}"  alt="">
            <h4>Denwen Evil <span>Web Developer</span></h4>
          </div>
        </div>
        <div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{{  URL::asset('public/images/happy-client-02.jpg') }}"  alt="">
            <h4>Adam Alloriam <span>Web Developer</span></h4>
          </div>
        </div>
        <div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{{  URL::asset('public/images/happy-client-03.jpg') }}"  alt="">
            <h4>Illa Millia <span>Project Manager</span></h4>
          </div>
        </div>
		<div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{{  URL::asset('public/images/happy-client-01.jpg') }}"  alt="">
            <h4>Denwen Evil <span>Web Developer</span></h4>
          </div>
        </div>
      </div>
    </div>
  </section>   
  -->
  <!--
  <div class="container padding-bottom-70">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline_part centered margin-bottom-35 margin-top-70">Most Popular Cities/Towns <span>Discover best things to do restaurants, shopping, hotels, cafes and places<br>around the world by categories.</span></h3>
      </div>
      <div class="col-md-3"> 
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{{  URL::asset('public/images/popular-location-01.jpg')}}">
			<div class="utf_img_content_box visible">
			  <h4>Nightlife </h4>
			  <span>18 Listings</span> 
			</div>
         </a> 
	  </div>
      <div class="col-md-3"> 
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{{  URL::asset('public/images/popular-location-02.jpg')}}">
			<div class="utf_img_content_box visible">
			  <h4>Shops</h4>
			  <span>24 Listings</span> 
			</div>
         </a> 
	  </div>
      <div class="col-md-6"> 
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{{  URL::asset('public/images/popular-location-03.jpg')}}">
			<div class="utf_img_content_box visible">
			  <h4>Restaurant</h4>
			  <span>17 Listings</span> 
			</div>
         </a> 
	  </div>
      <div class="col-md-6"> 
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{{  URL::asset('public/images/popular-location-04.jpg')}}">
			<div class="utf_img_content_box visible">
			  <h4>Outdoor Activities</h4>
			  <span>12 Listings</span> 
			</div>
         </a> 
	  </div>
      <div class="col-md-3"> 
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{{  URL::asset('public/images/popular-location-05.jpg')}}">
			<div class="utf_img_content_box visible">
			  <h4>Hotels</h4>
			  <span>14 Listings</span> 
			</div>
         </a> 
	  </div>
      <div class="col-md-3"> 
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{{  URL::asset('public/images/popular-location-06.jpg')}}">
			<div class="utf_img_content_box visible">
			  <h4>New York</h4>
			  <span>9 Listings</span> 
			</div>
         </a>
	  </div>
	  <div class="col-md-12 centered_content"> <a href="#" class="button border margin-top-20">View More Categories</a> </div>
    </div>
  </div>
  -->
   <!--
  <section class="fullwidth_block margin-bottom-0 padding-top-30 padding-bottom-65" data-background-color="linear-gradient(to bottom, #f9f9f9 0%, rgba(255, 255, 255, 1))">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="headline_part centered margin-bottom-40 margin-top-30">Our Company Logos</h3>
			</div>
			<div class="col-md-12">
				<div class="companie-logo-slick-carousel utf_dots_nav margin-bottom-10">
					<div class="item">
 					</div>
					<div class="item">
						<img src="{{  URL::asset('public/images/brand_logo_02.png') }}"  alt="">
					</div>
					<div class="item">
						<img src="{{  URL::asset('public/images/brand_logo_03.png') }}"  alt="">
					</div>
					<div class="item">
						<img src="{{  URL::asset('public/images/brand_logo_04.png') }}"  alt="">
					</div>
					<div class="item">
						<img src="{{  URL::asset('public/images/brand_logo_05.png') }}"  alt="">
					</div>		
					<div class="item">
						<img src="{{  URL::asset('public/images/brand_logo_06.png') }}"  alt="">
					</div>	
					<div class="item">
						<img src="{{  URL::asset('public/images/brand_logo_07.png') }}"  alt="">
					</div>					
				</div>
			</div>
		</div>
	</div>
  </section>
  -->
  <style>
 /*.utf_carousel_item{max-width:300px;} */
  </style>
  <!--
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
