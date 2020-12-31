<?php
 $user = auth()->user();
 $parametres=DB::table('parametres')->where('id', 1)->first();
$plogo= $parametres->logo;
?> <header id="header_part" class="fixed fullwidth_block dashboard"> 
    <div id="header" class="not-sticky">
      <div class="container"> 
        <div class="utf_left_side"> 
          <div id="logo">  <a href="{{ route('home') }}" class="dashboard-logo"><img src="<?php echo  URL::asset('storage/images/'.$plogo);?>" style="background-color:white" alt=""></a> </div>
          <div class="mmenu-trigger">
			<button class="hamburger utfbutton_collapse" type="button">
				<span class="utf_inner_button_box">
					<span class="utf_inner_section"></span>
				</span>
			</button>
		  </div>
          <nav id="navigation" class="style_one">
             <ul id="responsive">
             <!-- <li><a href="#">Accueil</a>
 
              </li>	-->		  
              <li><a href="{{route('listings')}}">Prestataires</a>
 
              </li>
               
            </ul> 
          </nav>
          <div class="clearfix"></div>
        </div>
        <div class="utf_right_side"> 
          <div class="header_widget"> 
		 	<div class="dashboard_header_button_item has-noti js-item-menu">
				<i class="sl sl-icon-bell"></i>
				<div class="dashboard_notifi_dropdown js-dropdown">
					<div class="dashboard_notifi_title" style="padding:10px 10px 10px 10px">
						<center><b>Dernières Notifications</b></center>
					</div>
					<!-- <div class="dashboard_notifi_item" >
						<div class="bg-c1 red">
							<i class="fa fa-check"></i>
						</div>
						<div class="content">
							<p>Your Listing <b>Burger House (MG Road)</b> Has Been Approved!</p>
							<span class="date">2 hours ago</span>
						</div>
					</div> -->
					<?php
					 $alertes = \App\Alerte::where('user',$user->id)->orderBy('id','desc')->limit(3)->get();

					foreach($alertes as $alerte) { ?>
					<div class="dashboard_notifi_item"  style="min-width:350px">
						<div class="bg-c1 green">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="content">
							<p><?php echo $alerte->titre ;?></p>
							<span class="date"><small><?php echo   date('d/m/Y H:i', strtotime($alerte->created_at ))  ;?></small></span>
						</div>
					</div>
					<?php }?>
					<div class="dashboard_notify_bottom text-center pad-tb-20">
						<a href="{{route('alertes')}}">Voir toutes les notifications</a>
					</div>
				</div>
			</div> 
 <?php    

 $User =\App\User::find($user->id);
 $user_type =$User->user_type;
 ?>
            <div class="utf_user_menu">
              <div class="utf_user_name"><span><img src="{{ URL::asset('public/images/avatar.png')}}" alt=""></span>Bonjour, {{$user->username}}!</div>
              <ul>
                <li><a  href="{{ route('dashboard') }}"><i class="sl sl-icon-layers"></i> Tableau de bord</a></li>
				 <?php if($user_type=='admin' || $user_type=='client'  ){ ?> 
                <li><a  href="{{ route('profile' , ['id'=>$user->id] ) }}"><i class="sl sl-icon-user"></i> Mon profil</a></li>
				 <?php } if($user_type=='admin' || $user_type=='prestataire'  ){ ?> 		  	
				<li><a  href="{{ route('listing', ['id'=>$user->id]) }}"><i class="sl sl-icon-briefcase"></i> Mon entreprise</a></li>
				<?php } ?>
		<!--		<li><a href="dashboard_messages.html"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
				<li><a href="dashboard_bookings.html"><i class="sl sl-icon-docs"></i> Réservations</a></li>-->
                <li><a  href="{{ route('logout') }}"><i class="sl sl-icon-power"></i> Déconnexion</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="clearfix"></div>
  