  
 <?php     $user = auth()->user();

// $User =\App\User::find($user->id);
  $user_type =$user->user_type;
 ?>

  <a href="#" class="utf_dashboard_nav_responsive"><i class="fa fa-reorder"></i> Tableau de bord</a>
    <div class="utf_dashboard_navigation js-scrollbar">
      <div class="utf_dashboard_navigation_inner_block">
        <ul>
     <!--     <li class=" "><a href="{{ route('dashboard') }}"><i class="sl sl-icon-layers"></i> Tableau de bord</a></li>    -->   
           <li class="<?php if ($view_name == 'reservations-index'){echo 'active';} ?>  "><a href="{{ route('reservations') }}"><i class="sl sl-icon-book-open"></i> Réservations </a></li>       
 <?php if($user_type=='client'){ ?> 
	   <li class="<?php if ($view_name == 'users-profile'){echo 'active';} ?>  "><a href="{{ route('profile' , ['id'=>$user->id] ) }}"><i class="sl sl-icon-user"></i> Mon Profil </a></li>
 <?php } ?>	

 <?php if($user_type=='admin'){ ?> 
 <li class="<?php if ($view_name == 'users-index'){echo 'active';} ?> "><a href="{{ route('users') }}"><i class="sl sl-icon-people"></i> Clients </a></li>       
          <li class="<?php if ($view_name == 'users-prestatires'){echo 'active';} ?>  "><a href="{{ route('prestatires') }}"><i class="sl sl-icon-briefcase"></i> Prestataires </a></li> 
          <li class="<?php if ($view_name == 'paiements-index'){echo 'active';} ?>  "><a href="#"><i class="sl sl-icon-wallet"></i> Paiements </a></li>       
		  <li class="<?php if ($view_name == 'categories-index'){echo 'active';} ?>  "><a href="{{ route('categories') }}"><i class="sl sl-icon-tag"></i> Catégories </a></li>       
		  <li class="<?php if ($view_name == 'abonnements-index'){echo 'active';} ?>  "><a href="#"><i class="sl sl-icon-folder-alt"></i> Abonnements </a></li>  
		 <li class="<?php if ($view_name == 'parametres'){echo 'active';} ?>  "><a href="{{ route('dashboard') }}"><i class="sl sl-icon-equalizer"></i> Paramètres </a></li>       

 <?php } ?>	

 <?php if( $user_type=='client'  ){ ?> 
		  <li class="<?php if ($view_name == 'reviews-index'){echo 'active';} ?>  "><a href="{{ route('favoris')}}"><i class="sl sl-icon-heart"></i> Mes Favoris </a></li>
 <?php } ?>	
 <?php if( $user_type=='prestataire'  ){ ?> 		  
		  <li class="<?php if ($view_name == 'users-listing'){echo 'active';} ?>  "><a href="{{ route('listing', ['id'=>$user->id]) }}"><i class="sl sl-icon-briefcase"></i> Mon Entreprise </a></li>       
		  <li class="<?php if ($view_name == 'notes-index'){echo 'active';} ?>  "><a href="{{ route('reviews')}}"><i class="sl sl-icon-star"></i> Avis </a></li>       
 <?php } ?>	

  <li><a  href="{{ route('logout') }}" ><i class="sl sl-icon-power"></i> Déconnexion</a></li>
		  
		  		<!--  <li><a href="dashboard_add_listing.html"><i class="sl sl-icon-plus"></i> Add Listing</a></li>	          
		  <li>
			<a href="#"><i class="sl sl-icon-layers"></i> My Listings</a>
			<ul>
				<li><a href="dashboard_my_listing.html">Active <span class="nav-tag green">10</span></a></li>
				<li><a href="dashboard_my_listing.html">Pending <span class="nav-tag yellow">4</span></a></li>
				<li><a href="dashboard_my_listing.html">Expired <span class="nav-tag red">8</span></a></li>
			</ul>	
		  </li>		 		 
		  <li><a href="dashboard_bookings.html"><i class="sl sl-icon-docs"></i> Bookings</a></li>		  
		  <li><a href="dashboard_messages.html"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
		  <li><a href="dashboard_wallet.html"><i class="sl sl-icon-wallet"></i> Wallet</a></li>		            
		  <li>
			<a href="#"><i class="sl sl-icon-star"></i> Reviews</a>
			<ul>
				<li><a href="dashboard_visitor_review.html">Visitor Reviews <span class="nav-tag green">4</span></a></li>
				<li><a href="dashboard_submitted_review.html">Submitted Reviews <span class="nav-tag yellow">5</span></a></li>					
			</ul>	
		  </li>		  
		  <li><a href="dashboard_bookmark.html"><i class="sl sl-icon-heart"></i> Bookmark</a></li>                                    		 
		  <li><a href="dashboard_my_profile.html"><i class="sl sl-icon-user"></i> My Profile</a></li>
		  <li><a href="dashboard_change_password.html"><i class="sl sl-icon-key"></i> Change Password</a></li>-->
        </ul>
      </div>
    </div> 