@extends('layouts.frontlayout')
 
 @section('content')
 
  <!--------------------------listings  ---------->
  <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
    <div class="container">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-45"> Nos Prestataires <span>Explorez nos prestataires et trouvez votre besoin</span> </h3>
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
				  <div class="col-md-4 utf_carousel_item" style="min-width:400px">
				  <div class="utf_listing_item-container ">
					<a  href="{{route('viewlisting',['id'=> $listing->id] )}}">
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
		<?php }  //end if periodde essai ou payement reglée  ?>
		 <?php }  //foreach $listings  ?>
				  
				  
<!--				  <div class="col-md-4 utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container ">
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
				  
				  <div class="col-md-4 utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container ">
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
				  
				  <div class="col-md-4 utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container ">
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
				  
				  <div class="col-md-4 utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container ">
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
				  
				  <div class="col-md-4 utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container ">
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
				  -->
				</div>
			  </div>
		  </div>
	   </div>
    </div>
  </section>
 
  <?php if (isset($User)){?> 
 <script>
 			
			function addfavoris(prestataire){
                
					    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('reviews.addfavoris') }}",
                        method:"POST",
                        data:{prestataire:prestataire,client:<?php echo $User->id;?>  , _token:_token},
                        success:function(data){
 
				     if(parseInt(data)==0) { 
					 $(this).addClass('liked');
					 }
					 else{
					  $(this).removeClass('liked');
					 }
 
                        }
                    });
               
            } 
	  
			
 </script>
 <?php }?> 
 
  @endsection('content')
