@extends('layouts.frontlayout')
 
 @section('content')

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
  <!--
  <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
    <div class="container">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-45"> Most Visited Places <span>Explore the greates places in the city</span> </h3>
        </div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="simple_slick_carousel_block utf_dots_nav"> 
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="{{  URL::asset('public/images/utf_listing_item-01.jpg') }}" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span> <span class="featured_tag">Featured</span>
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
					<div class="utf_listing_item"> <img src="{{  URL::asset('public/images/utf_listing_item-02.jpg') }}"  alt=""> <span class="tag"><i class="im im-icon-Electric-Guitar"></i> Events</span>
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
					<div class="utf_listing_item"> <img src="{{  URL::asset('public/images/utf_listing_item-03.jpg') }}"  alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
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
					<div class="utf_listing_item"> <img src="{{  URL::asset('public/images/utf_listing_item-04.jpg') }}"  alt=""> <span class="tag"><i class="im im-icon-Dumbbell"></i> Fitness</span>
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
					<div class="utf_listing_item"> <img src="{{  URL::asset('public/images/utf_listing_item-05.jpg') }}"  alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span> <span class="featured_tag">Featured</span>
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
					<div class="utf_listing_item"> <img src="{{  URL::asset('public/images/utf_listing_item-06.jpg') }}"  alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span>
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
  -->
  <a href="listings_grid_full_width.html" class="flip-banner parallax" data-background="{{  URL::asset('public/images/slider-bg-02.jpg')}}" data-color="#000" data-color-opacity="0.85" data-img-width="2500" data-img-height="1666">
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
  
  <section class="fullwidth_block margin-bottom-0 padding-top-30 padding-bottom-65" data-background-color="linear-gradient(to bottom, #f9f9f9 0%, rgba(255, 255, 255, 1))">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="headline_part centered margin-bottom-40 margin-top-30">Our Company Logos</h3>
			</div>
			<div class="col-md-12">
				<div class="companie-logo-slick-carousel utf_dots_nav margin-bottom-10">
					<div class="item">
					<!--	<img src="{{  URL::asset('public/images/brand_logo_01.png') }}"  alt="">-->
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
